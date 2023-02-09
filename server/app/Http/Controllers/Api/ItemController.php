<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ItemResource;
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Item
 *
 * APIs for managing item
 */
class ItemController extends Controller
{
    protected ItemRepositoryInterface $itemRepository;
    protected ItemStockRepositoryInterface $itemStockRepository;
    protected ItemVariantRepositoryInterface $itemVariantRepository;

    public function __construct(
        ItemRepositoryInterface        $itemRepository,
        ItemStockRepositoryInterface   $itemStockRepository,
        ItemVariantRepositoryInterface $itemVariantRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->itemStockRepository = $itemStockRepository;
        $this->itemVariantRepository = $itemVariantRepository;
    }

    /**
     * Get a list of items.
     *
     * This endpoint lets you get a list of items and filtering them
     * @unauthenticated
     *
     *
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     * @queryParam page integer The number of page for pagination. Example: 1
     * @queryParam search string The keyword for the title of the items. No-example
     * @queryParam item_size_ids integer[] Array of ids from size ids. No-example
     * @queryParam item_color_ids integer[] Array of ids from color ids. No-example
     * @queryParam brand_id integer The id of the brand to filter. No-example
     * @queryParam item_category_id integer The id of the category to filter. No-example
     * @queryParam item_person_type_id integer The id of the gender to filter. No-example
     * @queryParam min_price integer The minimum price of the product to filter. 1000000
     * @queryParam max_price integer The maximum price of the product to filter. No-example
     * @queryParam is_sale boolean True or False to get the list of items with sales. No-example
     *
     * @queryParam order_by
     * <p>integer 1 to 5 for ordering</p>
     * <p>For 1: trending</p>
     * <p>For 2: new products</p>
     * <p>For 3: old products</p>
     * <p>For 4: most popular</p>
     * <p>For 5: latest listing</p>
     * <p>For 6: featured items</p>
     * <p>For 7: price high to low</p>
     * <p>For 8: price low to high</p>. No-example
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemRepository->serverPaginationFilteringForApi($request->all());
        return ItemResource::collection($result);
    }

    /**
     * Get the specific item by its slug.
     *
     * This endpoint lets you get the specific item by using its slug
     * @unauthenticated
     *
     * @urlParam slug string required The slug of the item.
     *
     * @apiResource App\Http\Resources\Api\ItemResource
     * @apiResourceModel App\Models\Item
     *
     * @param $slug
     * @return ItemResource|\Illuminate\Http\JsonResponse
     */
    public function show($slug): ItemResource|\Illuminate\Http\JsonResponse
    {
        $result = $this->itemRepository->findBySlug($slug);
        if ($result) {
            if ($result) {
                $result->load([
                    'brand', 'activeCategories', 'sizes' => function ($query) use ($result) {
                        $query->with('itemVariants', function ($query) use ($result) {
                            $query->active();
                            $query->where('item_id', $result->id);
                            $query->with('itemStocks', function ($query) {
                                $query->inStock();
                                $query->orderBy('price');
                            });
                        });
                        $query->with('itemStocks', function ($query) use ($result) {
                            $query->inStock();
                            $query->where('item_id', $result->id);
                            $query->orderBy('price');
                        });
                    },
                    'colors' => function ($query) use ($result) {
                        $query->with('itemVariants', function ($query) use ($result) {
                            $query->active();
                            $query->where('item_id', $result->id);
                            $query->with('itemStocks', function ($query) {
                                $query->inStock();
                                $query->orderBy('price');
                            });
                        });
                        $query->with('itemStocks', function ($query) use ($result) {
                            $query->inStock();
                            $query->where('item_id', $result->id);
                            $query->orderBy('price');
                        });
                    }, 'stocks' => function ($query) {
                        $query->inStock();
                        $query->orderBy('price');
                    }, 'itemVariants' => function ($query) {
                        $query->active();
                        $query->with(['latestSale', 'itemStocks' => function ($query) {
                            $query->inStock()
                                ->oldest()
                                ->orderBy('price', 'asc');
                        }, 'size', 'color']);
                        $query->whereHas('itemStocks', function ($query) {
                            $query->inStock();
                        });
                    }
                ]);
            }
            return new ItemResource($result);
        }
        return response()->json(new JsonResponse([], __('errors.item_not_found')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Get the price ranges.
     *
     * This endpoint lets you get the min and max price for the price ranges
     * @unauthenticated
     *
     * @response
     */
    public function getPriceRange(): \Illuminate\Http\JsonResponse
    {
        $data['min_price'] = $this->itemStockRepository->getMinInStockPrice();
        $data['max_price'] = $this->itemStockRepository->getMaxInStockPrice();
        return response()->json(new JsonResponse($data));
    }
}
