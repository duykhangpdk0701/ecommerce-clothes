<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangeUserPasswordRequest;
use App\Http\Requests\User\UploadAvatarApiRequest;
use App\Http\Resources\api\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use App\Rules\PhoneNumber;
use App\Responses\JsonResponse;
use App\Rules\AlphaSpaces;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @group Authentication Endpoints
     *
     * Get the user detail
     * @authenticated
     *
     * Get the current user detail information.
     *
     * @apiResource App\Http\Resources\Api\UserResource
     * @apiResourceModel App\Models\User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(): \Illuminate\Http\JsonResponse
    {
        return response()->json(new JsonResponse(new UserResource(auth()->user())), ResponseAlias::HTTP_OK);
    }

    /**
     * @group User Endpoints
     *
     * Update the user profile of the current customer
     * @authenticated
     *
     * @bodyParam first_name string required The first name of the user. No-example
     * @bodyParam last_name string required The last name of the user. No-example
     * @bodyParam phone string The phone of the user. No-example
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeProfile(Request $request)
    {
        $data = $request->validate([
            'first_name' => [
                'required',
                'string',
                'max:20',
                new AlphaSpaces
            ],
            'last_name' => [
                'required',
                'string',
                'max:20',
                new AlphaSpaces
            ],
            'phone' => [
                'sometimes',
                'required',
                'numeric',
                'unique:user_profile,phone,' . auth()->user()->userProfile->id,
                new PhoneNumber
            ]
        ]);
        $result = $this->userRepository->update(auth()->user(), $data);
        if ($result) {
            return response()->json(new JsonResponse(new UserResource(auth()->user())), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.user_change_profile.update')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * @group User Endpoints
     *
     * Update the password of the current customer
     * @authenticated
     *
     * @bodyParam current_password string required The current password of the user. No-example
     * @bodyParam password string required The email of the user. No-example
     * @bodyParam password_confirmation string required The password confirmation of the user. No-example
     *
     * @param ChangeUserPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangeUserPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $result = $this->userRepository->resetPassword(auth()->user(), $data);
        if ($result) {
            return response()->json(new JsonResponse(new UserResource(auth()->user())), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.user_change_profile.update')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * @group User Endpoints
     *
     * Upload avatar of the current customer
     * @authenticated
     *
     * @bodyParam avatar file required The image avatar of the current customer.
     *
     * @param UploadAvatarApiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAvatar(UploadAvatarApiRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $result = $this->userRepository->update(auth()->user(), $data);
        if ($result) {
            return response()->json(new JsonResponse(new UserResource(auth()->user())), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.user_change_profile.update')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
