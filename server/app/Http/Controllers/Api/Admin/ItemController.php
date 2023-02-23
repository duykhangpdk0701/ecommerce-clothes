<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Resources\api\ItemResource;
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
     * Get a list of brands.
     *
     * This endpoint lets you get a list of brands
     * @authencicated
     *
     *
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemRepository->all();
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
    public function store (StoreItemRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemService->create($request->validated());


        if ($result) {
            return response()->json(new JsonResponse(new ItemResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.item.item_store')), ResponseAlias::HTTP_NOT_FOUND);
    }
}
