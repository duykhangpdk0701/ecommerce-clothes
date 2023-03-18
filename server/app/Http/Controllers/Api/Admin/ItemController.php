<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Resources\api\ItemResource;
use App\Models\Item;
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Responses\JsonResponse;
use App\Services\ItemService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


/**
 * @group Admin Item
 *
 * @authenticated
 *
 * APIs for managing item
 */
class ItemController extends Controller
{
    protected ItemService $itemService;
    protected ItemRepositoryInterface $itemRepository;
    protected UserRepositoryInterface $userRepository;

    public function __construct(ItemService $itemService, ItemRepositoryInterface $itemRepository, UserRepositoryInterface $userRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_LIST)->only(['index', "show"]);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_ADD)->only(['create', "store"]);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_EDIT)->only(['edit', "update"]);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_DELETE)->only("destroy");

        $this->itemService = $itemService;
        $this->itemRepository = $itemRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get a list item.
     *
     * This endpoint lets you get a list of brands
     * @authencicated
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
        $result = $this->itemRepository->serverPaginationFilteringFor($request->all());
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
     * Create a new Item
     *
     * This endpoint lets you create a item
     *
     * @param StoreItemRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function store(StoreItemRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemService->create($request->validated());


        if ($result) {
            return response()->json(new JsonResponse(new ItemResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.item.item_store')), ResponseAlias::HTTP_NOT_FOUND);
    }


    /**
     * Update the specified resource is featured in storage.
     *
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFeatured(Item $item): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemService->toggleFeatured($item);
        if (!$result) {
            return response()->json(new JsonResponse($result), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(new JsonResponse(['message' => __('success.item.changed_featured')]), ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource status in storage.
     *
     * @param Item $item
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(Item $item, Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemService->toggleStatus($item, $request->only('status'));
        if (!$result) {
            return response()->json(new JsonResponse($result), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(new JsonResponse(['message' => __('success.item.changed_status')]), ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specific resource media type in storage
     *
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleMediaType(Item $item): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemService->toggleMediaType($item);
        if (!$result) {
            return response()->json(new JsonResponse($result), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(new JsonResponse(['message' => __('success.item.changed_media_type')]), ResponseAlias::HTTP_OK);
    }

}
