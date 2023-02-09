<?php

namespace App\Services;

use App\Models\ItemStock;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemStockPrice\ItemStockPriceRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class ItemStockService
 * @package App\Services
 */
class ItemStockService
{
    private ItemStockRepositoryInterface $itemStockRepository;
    private ItemVariantRepositoryInterface $itemVariantRepository;
    private ItemStockPriceRepositoryInterface $itemStockPriceRepository;
    private ItemService $itemService;

    const SPLIT_CODE = '-';

    public function __construct(
        ItemStockRepositoryInterface      $itemStockRepository,
        ItemVariantRepositoryInterface    $itemVariantRepository,
        ItemStockPriceRepositoryInterface $itemStockPriceRepository,
        ItemService                       $itemService,
    )
    {
        $this->itemStockRepository = $itemStockRepository;
        $this->itemVariantRepository = $itemVariantRepository;
        $this->itemStockPriceRepository = $itemStockPriceRepository;
        $this->itemService = $itemService;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();

            $itemVariant = $this->itemVariantRepository->find($data['item_variant_id']);

            foreach ($data['inbound_item'] as $key => $inboundItem) {
                $quantity = $inboundItem['quantity'] ?: 1;

                for ($i = 0; $i < $quantity; $i++) {

                    $inboundItem['item_id'] = $itemVariant->item_id;
                    $inboundItem['item_variant_id'] = $data['item_variant_id'];
                    $inboundItem['code'] = $data['item_variant_id'] . self::SPLIT_CODE . uniqid();
                    $inboundItem['sku'] = $this->generateStockSKU($itemVariant->sku);
                    $inboundItem['size_value'] = $itemVariant->size->value;
                    $inboundItem['size_id'] = $itemVariant->size->id;
                    $inboundItem['color_id'] = $itemVariant->color->id;
                    $inboundItem['color_name'] = $itemVariant->color->name;
                    $inboundItem['color_value'] = $itemVariant->color->value;
                    $inboundItem['status'] = ItemStock::STATUS_APPROVED;
                    $inboundItem['created_by'] = auth()->id();

                    $itemStock = $this->itemStockRepository->create($inboundItem);
                    $updatedData['code'] = $this->generateItemsCode($itemStock);
                    $this->itemStockRepository->update($itemStock, $updatedData);
                }
            }

            session()->flash(NOTIFICATION_SUCCESS, __('success.store', ['resource' => 'stock']));

            DB::commit();
            return $itemStock;
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            throw $e;
        }
    }

    /**
     * Update the price of the specified resource
     *
     * Update the price of the resource then create
     * a row to record the price changing in the model.
     *
     * @param \App\Models\ItemStock $model
     * @param Array $data
     * @return Collection
     */
    public function updatePrice($model, $data)
    {
        try {
            DB::beginTransaction();

            $price = Arr::get($data, 'price', '');

            $data['is_sale'] = CONST_DISABLE;
            $data['old_price'] = $model->price;

            $newStockPrice = $model->prices()->create([
                'old_price' => $model->price,
                'price' => $price,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ]);

            if ($newStockPrice->old_price > $newStockPrice->price) {
                $data['is_sale'] = CONST_ENABLE;
            }

            $itemStock = $this->itemStockRepository->update($model, $data);
            DB::commit();

            return $itemStock;
        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash(NOTIFICATION_ERROR, __('error.message', ['message' => $e->getMessage()]));
            return false;
        }
    }

    /**
     * Generate SKU for item
     */
    public function generateStockSKU($variantSku)
    {
        $sku[] = 'TP-' . date('dmYH');
        $sku[] = $variantSku;
        $sku = implode(self::SPLIT_CODE, $sku);
        return $sku;
    }

    /**
     * Generate Code For Stock Item
     */
    public function generateItemsCode($itemStock)
    {
        $code[] = str_pad($itemStock->item_id, 3, '0', STR_PAD_LEFT);
        $code[] = str_pad($itemStock->item_variant_id, 5, '0', STR_PAD_LEFT);
        $code[] = str_pad($itemStock->id, 5, '0', STR_PAD_LEFT);
        $code = implode(self::SPLIT_CODE, $code);
        return $code;
    }

    /**
     * @inheritdoc
     */
    public function updateItemStockIn(array $params = [])
    {
        $itemStock = $this->itemStockRepository->find($params['item_stock_id']);
        $attr = [
            'stock_status_id' => ItemStock::STOCK_IN_STOCK,
            'stock_out_date' => Carbon::now(),
        ];
        $attr = array_merge($params, $attr);
        $result = $this->itemStockRepository->update($itemStock, $attr);
        $this->itemService->updateStock($itemStock->item);

        //update contract.
        $contractItems = $this->contractItemsRepository->getContractItemsByItemsID($itemStock->id);
        if (!empty($contractItems)) {
            $this->contractService->switchStatusSell($contractItems);
            $result = $this->contractService->updateStatus($contractItems->contract);
        }
        return $itemStock;
    }

    /**
     * @inheritdoc
     */
    public function updateItemStockOut(array $attributes = [], array $options = [])
    {
        $itemStock = $this->itemStockRepository->find($attributes['item_stock_id']);
        $attr = [
            'stock_status_id' => ItemStock::STOCK_OUT_OF_STOCK,
            'stock_out_date' => Carbon::now(),
        ];
        $attr = array_merge($options, $attr);
        $itemStock->update($attr);
        $this->itemService->updateStock($itemStock->item);
    }
}
