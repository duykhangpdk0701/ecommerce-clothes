<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\api\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Admin User
 *
 * @authenticated
 *
 * APIs for managing User
 */
class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_DELETE)->only("destroy");

        $this->userRepository = $userRepository;
    }

    /**
     * Get a list of user.
     *
     * This endpoint lets you get a list of brands
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->userRepository->all();
        return UserResource::collection($result);
    }

    /**
     * Get brand detail.
     *
     * This endpoint lets you get user detail
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->userRepository->find($id);
        if ($result) {
            return response()->json(new JsonResponse(new UserResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.brand_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Create a new Brand
     *
     * This endpoint lets you create a user
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->userRepository->create($request->validated());

        if ($result) {
            return response()->json(new JsonResponse(new UserResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.user.user_store')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Update Brand
     *
     * This endpoint lets you update user
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        $result = $this->userRepository->update($user, $request->validated());

        if ($result) {
            return response()->json(new JsonResponse(new UserResource($result)), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Delete User
     *
     * This endpoint lets you delete users
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        $result = $this->userRepository->destroy($user);
        if ($result) {
            return response()->json(new JsonResponse(['message' => __('error.user.user_destroy')]), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.user.user_destroy')), ResponseAlias::HTTP_NOT_FOUND);

    }
}
