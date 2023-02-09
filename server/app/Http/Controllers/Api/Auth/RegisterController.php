<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterCustomerRequest;
use App\Http\Resources\api\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

/**
 * @group Authentication Endpoints
 *
 * APIs for authenticating user
 */
class RegisterController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Register Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles the registration of new users as well as their
     | validation and creation. By default this controller uses a trait to
     | provide this functionality without requiring any additional code.
     |
     */

    use RegistersUsers;

    private UserRepositoryInterface $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * Register.
     *
     * This endpoint let the user register to the account.
     * @unauthenticated
     *
     * @bodyParam first_name string required The first name of the user. No-example
     * @bodyParam last_name string required The last name of the user. No-example
     * @bodyParam email string required The email of the user. No-example
     * @bodyParam password string required The password of the user. No-example
     * @bodyParam password_confirmation string required The password confirmation of the user. No-example
     * @bodyParam agree_ckb boolean required Agree to the terms.
     *
     * @param RegisterCustomerRequest $data
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    protected function register(RegisterCustomerRequest $data): UserResource|\Illuminate\Http\JsonResponse
    {
        $user = $this->userRepository->registerCustomer($data);
        if ($user) {
            return new UserResource($user);
        }
        return response()->json(new JsonResponse([], __('errors.item_not_found')), Response::HTTP_NOT_FOUND);
    }
}
