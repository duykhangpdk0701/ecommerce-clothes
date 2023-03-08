<?php

namespace App\Services;

use App\Models\Item;
use App\Models\ItemColor;
use App\Models\ItemStock;
use App\Models\ItemPersonType;
use App\Models\ItemStockStatus;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\ItemCategory\ItemCategoryRepositoryInterface;
use App\Repositories\ItemPersonType\ItemPersonTypeRepositoryInterface;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class ItemService
 * @package App\Services
 */
class ItemService
{
    private $itemRepository,
        $brandRepository,
        $itemCategoryRepository,
        $itemVariantRepository,
        $itemPersonTypeRepository,
        $itemStockRepository;
    private const STOCK_IN_COUNT_DEFAULT_VALUE = 0;
    private const STOCK_OUT_COUNT_DEFAULT_VALUE = 0;

    /**
     * Number of items should be grouped by categories
     */
    const ITEM_BY_CATEGORY_PER_PAGE = 10;

    public function __construct(
        ItemRepositoryInterface           $itemRepository,
        BrandRepositoryInterface          $brandRepository,
        ItemCategoryRepositoryInterface   $itemCategoryRepository,
        ItemVariantRepositoryInterface    $itemVariantRepository,
        ItemPersonTypeRepositoryInterface $itemPersonTypeRepository,
        ItemStockRepositoryInterface      $itemStockRepository,
    )
    {
        $this->itemRepository = $itemRepository;
        $this->brandRepository = $brandRepository;
        $this->itemCategoryRepository = $itemCategoryRepository;
        $this->itemVariantRepository = $itemVariantRepository;
        $this->itemPersonTypeRepository = $itemPersonTypeRepository;
        $this->itemStockRepository = $itemStockRepository;
    }

    /**
     * @throws Exception
     */
    public function create($data)
    {
        try {
            DB::beginTransaction();

            $item = $this->itemRepository->create($data);

            foreach ($data['item_sizes'] as $key => $size) {
                foreach ($data['item_colors'] as $key => $color) {
                    $itemVariant = $this->itemVariantRepository->create([
                        'sku' => $item->sku,
                        'size_id' => $size,
                        'color_id' => $color,
                        'item_id' => $item->id
                    ]);
                }
            }

            $item
                ->categories()
                ->sync($data['item_categories']);

            $item
                ->colors()
                ->sync($data['item_colors']);

            $item
                ->sizes()
                ->sync($data['item_sizes']);

            $item
                ->addMediaFromRequest('thumbnail_image')
                ->toMediaCollection(ITEM_MEDIA_COLLECTION_THUMBNAIL);

            $item
                ->addMultipleMediaFromRequest(['detail_images'])->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection(ITEM_MEDIA_COLLECTION_DETAIL);
                });

            DB::commit();

            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update the item resource
     *
     * @param Request $request
     * @param Item $item
     * @return string|collection
     */
    public function update($request, $item)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            if ($data['sku'] != $item->sku) {
                foreach ($item->itemVariants as $itemVariant) {
                    $this->itemVariantRepository->update($itemVariant, [
                        'sku' => $data['sku']
                    ]);
                }
            }

            $this->itemRepository->update($item, $data);

            $item
                ->categories()
                ->sync($data['item_categories']);

            if ($request->file('thumbnail_image')) {
                $item
                    ->addMediaFromRequest('thumbnail_image')
                    ->toMediaCollection(ITEM_MEDIA_COLLECTION_THUMBNAIL);
            }

            DB::commit();

            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Add size to item and create variants
     * @throws Exception
     */
    public function addSize($data, $item)
    {
        // dd($data['item_sizes']);
        try {
            DB::beginTransaction();

            if (!$data['item_sizes'] && !$data['item_colors']) {
                session()->flash(NOTIFICATION_ERROR, 'Please choose options');
                return;
            } elseif ($data['item_sizes'] && !$data['item_colors']) {
                foreach ($data['item_sizes'] as $key => $size) {
                    foreach ($item->colors as $color) {
                        $itemVariant = $this->itemVariantRepository->create([
                            'sku' => $item->sku,
                            'item_id' => $item->id,
                            'size_id' => $size,
                            'color_id' => $color->id
                        ]);
                    }
                }

                $item
                    ->sizes()
                    ->attach($data['item_sizes']);
            } elseif (!$data['item_sizes'] && $data['item_colors']) {
                foreach ($data['item_colors'] as $key => $color) {
                    foreach ($item->sizes as $size) {
                        $itemVariant = $this->itemVariantRepository->create([
                            'sku' => $item->sku,
                            'item_id' => $item->id,
                            'size_id' => $size->id,
                            'color_id' => $color->id
                        ]);
                    }
                }

                $item
                    ->colors()
                    ->attach($data['item_colors']);
            } else {
                foreach ($data['item_sizes'] as $key => $size) {
                    foreach ($data['item_colors'] as $key => $color) {
                        $itemVariant = $this->itemVariantRepository->create([
                            'sku' => $item->sku,
                            'item_id' => $item->id,
                            'size_id' => $size,
                            'color_id' => $color
                        ]);
                    }
                }

                if (!empty($item->sizes)) {
                    foreach ($data['item_colors'] as $key => $color) {
                        foreach ($item->sizes as $size) {
                            $itemVariant = $this->itemVariantRepository->create([
                                'sku' => $item->sku,
                                'item_id' => $item->id,
                                'size_id' => $size->id,
                                'color_id' => $color
                            ]);
                        }
                    }
                }

                if (!empty($item->colors)) {
                    foreach ($data['item_sizes'] as $key => $size) {
                        foreach ($item->colors as $color) {
                            $itemVariant = $this->itemVariantRepository->create([
                                'sku' => $item->sku,
                                'item_id' => $item->id,
                                'size_id' => $size,
                                'color_id' => $color->id
                            ]);
                        }
                    }
                }

                $item
                    ->colors()
                    ->attach($data['item_colors']);

                $item
                    ->sizes()
                    ->attach($data['item_sizes']);
            }

            DB::commit();

            session()->flash(NOTIFICATION_SUCCESS, __('success.item.add_size', ['itemName' => $item->name]));
            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove option from item and remove variants
     */
    public function removeSize($data, $item)
    {
        try {
            DB::beginTransaction();

            if (!empty($data['size_id'])) {
                $itemVariants = $item->itemVariants->where('size_id', $data['size_id']);

                foreach ($itemVariants as $key => $value) {
                    $itemVariant = $this->itemVariantRepository->destroy($value);
                }

                $item
                    ->sizes()
                    ->detach($data['size_id']);
            } elseif (!empty($data['color_id'])) {
                $itemVariants = $item->itemVariants->where('color_id', $data['color_id']);

                foreach ($itemVariants as $key => $value) {
                    $itemVariant = $this->itemVariantRepository->destroy($value);
                }

                $item
                    ->colors()
                    ->detach($data['color_id']);
            } else {
                return false;
            }

            DB::commit();

            session()->flash(NOTIFICATION_SUCCESS, 'Delete option is successfully');
            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash(NOTIFICATION_ERROR, __('error.item.' . current($e->errorInfo)));
        }
    }

    /**
     * Toggle if the item is featured item
     *
     * @param App\Models\Item $item
     * @return void
     */
    public function toggleFeatured($item)
    {
        $data['is_featured'] = !$item->is_featured;
        $result = $this->itemRepository->update($item, $data);
        return $result;
    }

    /**
     * Toggle if the item is active or inactive
     *
     * @param App\Models\Item $item
     * @param array $data
     *
     * @return bool
     */
    public function toggleStatus($item, $data = [])
    {
        if (!$data) {
            $data['status'] = !$item->status;
        }
        $result = $this->itemRepository->update($item, $data);
        return $result;
    }

    /**
     * Toggle the media type of the item
     *
     * @param $item
     * @return mixed
     */
    public function toggleMediaType($item): mixed
    {
        $data['media_type'] = $item->media_type == ITEM_MEDIA_TYPE_NORMAL ? ITEM_MEDIA_TYPE_ZOOM : ITEM_MEDIA_TYPE_NORMAL;
        return $this->itemRepository->update($item, $data);
    }

    /**
     * Group the item by the parent categories
     *
     * @return array
     */
    public function groupItemsByParentCategories(): array
    {
        $parentCategories = [];

        $categories = $this->itemCategoryRepository->serverFilterFor([
            'is_show' => 'true'
        ]);

        foreach ($categories as $key => $category) {
            $parentCategories[$key]['category'] = $category;
            $parentCategories[$key]['items'] = $this->itemRepository->serverPaginationFilteringFor([
                'item_category_id' => $category->id,
                'limit' => self::ITEM_BY_CATEGORY_PER_PAGE,
                'is_active' => CONST_ENABLE,
                'stock_limit' => CONST_STOCK_IN_STOCK,
                'order_by' => Item::ORDER_MOST_POPULAR
            ]);
        }

        return $parentCategories;
    }

    public function addMedia($item)
    {
        return $item
            ->addMultipleMediaFromRequest(['detail_images'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection(ITEM_MEDIA_COLLECTION_DETAIL);
            });
    }

    public function findPersonType($id)
    {
        return $this->itemPersonTypeRepository->find($id)->load('itemSizes');
    }

    public function findPersonTypeByCode($code)
    {
        return $this->itemPersonTypeRepository->findByCode($code);
    }

    /**
     * Get paginated items with filters
     *
     * @param $searchParams
     * @return LengthAwarePaginator
     */
    public function getAllItems($searchParams): LengthAwarePaginator
    {
        return $this->itemRepository->serverPaginationFilteringFor($searchParams);
    }

    public function serverFilterForBrand($searchParams)
    {
        return $this->brandRepository->serverFilterFor($searchParams);
    }

    public function getAllBrand()
    {
        return $this->brandRepository->all();
    }

    public function findBrand($id)
    {
        return $this->brandRepository->find($id);
    }

    public function findBrandBySlug($slug)
    {
        return $this->brandRepository->findBySlug($slug);
    }

    public function serverFilterForCategory($searchParams)
    {
        return $this->itemCategoryRepository->serverFilterFor($searchParams);
    }

    public function findCategoryBySlug($slug)
    {
        return $this->itemCategoryRepository->findBySlug($slug);
    }

    public function getAllCategories()
    {
        return $this->itemCategoryRepository->all();
    }

    public function getAllParentCategories()
    {
        return $this->itemCategoryRepository->allParentWithChildren();
    }

    public function getAllPersonTypes()
    {
        return ItemPersonType::all();
    }

    public function getAllStockStatuses()
    {
        return ItemStockStatus::all();
    }

    public function getAllColors()
    {
        return ItemColor::all();
    }

    /**
     * Update items stock count
     * @param array $ids
     */
    public function updateStockByIds($ids = [])
    {
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $item = $this->itemRepository->find($id);
                $this->updateStock($item);
            }
        }
    }

    /**
     * Update item stock count
     * @param $item
     */
    public function updateStock($item)
    {
        $stock_in = $this->itemStockRepository->getItemStock(['item_id' => $item->id, 'stock_status_id' => ItemStock::STOCK_IN_STOCK])->count();
        $stock_in_count = $stock_in ? $stock_in : self::STOCK_IN_COUNT_DEFAULT_VALUE;
        $stock_out = $this->itemStockRepository->getItemStock(['item_id' => $item->id, 'stock_status_id' => ItemStock::STOCK_OUT_OF_STOCK])->count();
        $stock_out_count = $stock_out ? $stock_out : self::STOCK_OUT_COUNT_DEFAULT_VALUE;

        $item->stock_in = $stock_in_count;
        $item->stock_out = $stock_out_count;
        $item->save();
    }
}
