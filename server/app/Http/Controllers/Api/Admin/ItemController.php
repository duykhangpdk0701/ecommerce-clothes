<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
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
 * @group Admin Item
 *
 * @authenticated
 *
 * APIs for managing item
 */
class ItemController extends Controller
{
    protected ItemRepositoryInterface $itemRepository;
    protected ItemStockRepositoryInterface $itemStockRepository;
    protected ItemVariantRepositoryInterface $itemVariantRepository;

    public function __construct(ItemRepositoryInterface $itemRepository, ItemStockRepositoryInterface $itemStockRepository, ItemVariantRepositoryInterface $itemVariantRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_LIST)->only(['index', "show"]);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_ADD)->only(['create', "store"]);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_EDIT)->only(['edit', "update"]);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_DELETE)->only("destroy");

        $this->itemRepository = $itemRepository;
        $this->itemStockRepository = $itemStockRepository;
        $this->itemVariantRepository = $itemVariantRepository;
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
}
