<?php

namespace App\Repositories\QuoteDetail;

use App\Acl\Acl;
use App\Models\ItemCondition;
use App\Models\ItemStock;
use App\Models\ItemVariant;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Repositories\BaseRepository;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepository;
use App\Repositories\Quote\QuoteRepositoryInterface;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * The repository for SysDistrict Model
 */
class QuoteDetailRepository extends BaseRepository implements QuoteDetailRepositoryInterface
{
    protected Model $model;

    /**
     * Item stock condition
     */
    const CONDITION_STATUS = 'New';

    /**
     * Paginate item per page
     */
    const ITEM_PER_PAGE = 10;

    /**
     * @var QuoteRepositoryInterface
     */
    protected QuoteRepositoryInterface $quoteRepository;

    /**
     * QuoteDetailRepository constructor.
     * @param QuoteDetail $model
     * @param QuoteRepositoryInterface $quoteRepository
     * @throws BindingResolutionException
     */
    public function __construct(
        QuoteDetail              $model,
        QuoteRepositoryInterface $quoteRepository
    )
    {
        $this->model = $model;
        $this->quoteRepository = $quoteRepository;
        parent::__construct($model);
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return QuoteDetail::class;
    }

    /**
     * @return Collection|void
     */
    public function all(): Collection
    {
        return $this->model->get();
    }

    /**
     * @param $quoteId
     * @param $data
     * @param int $quantity
     * @return mixed|void
     *
     * /**
     */
    public function createWithQuote($quoteId, $data, int $quantity = QUANTITY_ADD_CART_DEFAULT)
    {
        try {
            DB::beginTransaction();

            $quote = $this->quoteRepository->find($quoteId);
            $itemsExist = isset($quote->quoteDetails->items) && $quote->quoteDetails->items ? json_decode($quote->quoteDetails->items) : [];
            $itemsArr = Arr::collapse([$itemsExist, [$data->id]]);
            $fillData = [
                'quote_id' => $quoteId,
                'item_id' => $data->item_id,
                'size_id' => $data->size_id,
                'size_value' => (string)$data->size_value,
                'color_id' => $data->color_id,
                'color_name' => (string)$data->color_name,
                'color_value' => (string)$data->color_value,
                'price' => $data->price,
                'item_variant_id' => $data->itemVariant->id,
                'quantity' => $quantity,
            ];

            if (
                auth()->check()
                && auth()->user()->hasAnyRole(Acl::ROLE_STAFF, Acl::ROLE_ADMIN, Acl::ROLE_SUPER_ADMIN)
                && request()->input('is_admin')
            ) {
                $fillData['items'] = json_encode($itemsArr) ?? '';
            }

            $result = $this->model->create($fillData);

            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    /**
     * @param $quoteId
     * @param $item
     * @return false
     */
    public function updateWithQuote($quoteId, $item, $quantity = QUANTITY_ADD_CART_DEFAULT)
    {
        try {
            DB::beginTransaction();
            $quoteDetail = $this->findDetailWithItem($quoteId, $item->item->id, $item);

            $countItemStocks = ItemStock::where('item_variant_id', $item->item_variant_id)
                ->where('price', $item->price)
                ->where('stock_status_id', CONST_STOCK_IN_STOCK)->count();

            if ($quantity > $countItemStocks) {
                return false;
            }

            $data = [];

            $itemsExist = array();

            $itemsExist = !empty($quoteDetail->items) && $quoteDetail->item_variant_id === $item->item_variant_id ? json_decode($quoteDetail->items) : [];
            $itemsArr = Arr::collapse([$itemsExist, [$item->id]]);

            if (in_array($item->id, $itemsExist)) {
                return false;
            }

            if (
                $quoteDetail
                && !empty($itemsExist)
                && $quoteDetail->price === $item->price
                && request()->input('is_admin')
            ) {
                if ($quoteDetail->item_variant_id !== $item->item_variant_id) {
                    $result = $this->createWithQuote($quoteId, $item, $quantity);

                    return $result;
                }


                $data = [
                    'quantity' => count($itemsArr),
                    'items' => json_encode($itemsArr)
                ];

                $result = $this->update($quoteDetail, $data);
                DB::commit();
                return $result;
            }

            if (
                $quoteDetail
                && $quoteDetail->item_id === $item->item_id
                && $quoteDetail->price === $item->price
                && $quoteDetail->item_variant_id === $item->item_variant_id
            ) {
                $data = [
                    'quantity' => $quoteDetail->quantity + $quantity
                ];

                if ($quoteDetail->quantity < $countItemStocks && $data['quantity'] < $countItemStocks) {
                    $result = $this->update($quoteDetail, $data);

                    DB::commit();
                    return $result;
                }

                return false;
            }

            $result = $this->createWithQuote($quoteId, $item, $quantity);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param null $searchParams
     * @param $quoteId
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor($quoteId, $searchParams = null): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);

        $query = $this->model->query();

        return $query->whereNotNull('items')->where('quote_id', $quoteId)->paginate(Arr::get($searchParams, 'per_page', $limit));
    }

    /**
     * @param $model
     * @param mixed $data
     * @return null|void
     */
    public function update($model, $data): bool
    {
        try {
            DB::beginTransaction();
            $result = $model->update($data);;

            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    /**
     * @param $model
     * @return bool|void
     */
    public function destroy($model): bool
    {
        try {
            DB::beginTransaction();
            Log::info($model);
            $result = $this->find($model)->delete();

            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function findWithItemAndSize($id)
    {
        return $this->model->with(['itemStock', 'size'])->find($id);
    }

    /**
     * @param $quoteId
     * @return mixed
     */
    public function getWithItemAndSize($quoteId)
    {
        return $this->model->where('quote_id', $quoteId)->with(['size'])->get();
    }

    /**
     * @param $quoteId
     * @param $itemId
     * @param $itemStockPrice
     * @return mixed
     */
    public function findDetailWithItem($quoteId, $itemId, $itemStockPrice)
    {
        return $this->model->where('quote_id', $quoteId)
            ->where('price', $itemStockPrice->price)
            ->where('item_id', $itemId)
            ->where('item_variant_id', $itemStockPrice->itemVariant->id)
            ->first();
    }

    /**
     * Minus shopping cart
     * @param $quoteId
     * @param $quoteDetail
     * @return mixed
     */
    public function minusItems($quoteId, $quoteDetail)
    {
        try {
            DB::beginTransaction();

            $itemsExist = !empty($quoteDetail->items) ? json_decode($quoteDetail->items) : [];
            unset($itemsExist[count($itemsExist) - 1]);

            if (count($itemsExist) < 1) {
                $result = $this->destroy($quoteDetail->id);
                $this->quoteRepository->deleteAfterOutOfCart($quoteId, $quoteDetail->price);

                DB::commit();

                return $result;
            }

            $dataQuoteDetail = [
                'quantity' => count($itemsExist),
                'items' => json_encode($itemsExist)
            ];

            $quoteDetail->update($dataQuoteDetail);

            $result = $this->quoteRepository->deleteAfterOutOfCart($quoteId, $quoteDetail->price);

            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $quoteId
     * @param $quoteDetail
     * @return false
     */
    public function plusItem($quoteId, $quoteDetail)
    {
        try {
            DB::beginTransaction();

            $items = json_decode($quoteDetail->items);

            if (empty($items)) {
                $data = [
                    'quantity' => $quoteDetail->quantity + 1
                ];

                $quoteDetail->update($data);
            }

            //get the first item stock to compare variant with the variant of new item stock added
            $stock = ItemStock::find($items[0]);

            $itemStock = $quoteDetail->item->stocks()->where('item_variant_id', $stock->item_variant_id)
                ->where('price', $quoteDetail->price)
                ->where('stock_status_id', CONST_STOCK_IN_STOCK)
                ->whereNotIn('id', $items)->first();

            if (!$itemStock) {
                DB::commit();

                return false;
            }

            array_push($items, $itemStock->id);

            $quoteDetail->update([
                'items' => json_encode($items),
                'quantity' => $quoteDetail->quantity + 1
            ]);

            $result = $this->quoteRepository->updateWithStock($quoteId, $itemStock);

            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $quoteId
     * @return Builder[]|Collection
     */
    public function getWithQuoteId($quoteId)
    {
        return $this->model->where('quote_id', $quoteId)->get();
    }

    /**
     * @param $quoteId
     * @return Builder[]|Collection
     */
    public function getItemWithQuoteId($quoteId)
    {
        return $this->model
            ->where('quote_id', $quoteId)->get();
    }

    /**
     * @param $quoteDetailId
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function findItemWithQuote($quoteDetailId)
    {
        return $this->model->with('quote')->find($quoteDetailId);
    }

    /**
     * @param $quoteId
     * @param $coupon
     * @return mixed
     */
    public function countCouponInQuote($quoteId, $coupon)
    {
        return $this->model->where('quote_id', $quoteId)->where('coupon_code', $coupon)->count();
    }
}
