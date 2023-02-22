<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ObjectParamsLoginSocial;
use App\Http\Resources\api\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Authentication Endpoints
 *
 * APIs for authenticating user
 */
class LoginController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */

    use AuthenticatesUsers;

    protected array $providers = ['facebook', 'google', 'apple'];
    private UserRepositoryInterface $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = $userRepository;
    }

    /**
     * Login.
     *
     * This endpoint let the user login to the system and return them with a token for authenticate on authenticated endpoints
     * @unauthenticated
     *
     * @bodyParam email string required. Example: duykhangpdk0701@gmail.com
     * @bodyParam password string required. Example: Pdk@073101
     *
     * @apiResource App\Http\Resources\Api\UserResource
     * @apiResourceModel App\Models\User
     *
     * @param Request $request
     * @return JsonResponse|\Illuminate\Http\JsonResponse|RedirectResponse|ResponseAlias
     *
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse|\Illuminate\Http\JsonResponse|RedirectResponse|ResponseAlias
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     * @return JsonResponse|\Illuminate\Http\JsonResponse|RedirectResponse
     */
    protected function sendLoginResponse(Request $request): JsonResponse|\Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param mixed $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticated(Request $request, mixed $user): \Illuminate\Http\JsonResponse
    {
        $token = $user->createToken('api')->plainTextToken;
        $user->token = $token;

        return response()->json(new JsonResponse(new UserResource($user)), ResponseAlias::HTTP_OK)->header('Authorization', $token);
    }

    /**
     * Logout.
     *
     * Log the user out of the system and provoke the Bearer Key
     * @authenticated
     *
     * @response scenario=Success {"success": "true", "data": [], "error": ""}
     *
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json((new JsonResponse())->success([]), ResponseAlias::HTTP_OK);
    }

    /**
     * Login social callback.
     *
     * This endpoint let the user login to the system by the social media and return them with a token for authenticate on authenticated endpoints
     * @unauthenticated
     *
     * @urlParam driver string required. Example: facebook
     *
     * @bodyParam email string required The email of the user. Example: example@gmail.com
     * @bodyParam id string required The id of the user. Example: 12345678
     * @bodyParam name string required The name of the user. Example: NT Mkey
     * @bodyParam token string required The token of the user. Example: ABCDXYZ...
     * @bodyParam avatar url The avatar of the user. No-example
     *
     * @apiResource App\Http\Resources\Api\UserResource
     * @apiResourceModel App\Models\User
     *
     * @param ObjectParamsLoginSocial $objUser
     * @param $driver
     * @return RedirectResponse|Response|\Illuminate\Http\JsonResponse
     *
     */
    public function handleProviderCallback(ObjectParamsLoginSocial $objUser, $driver): Response|\Illuminate\Http\JsonResponse|RedirectResponse
    {
        $user = $this->userRepository->handleLoginSocialiteApi($objUser, $driver);
        if (!$user || !$this->isProviderAllowed($driver)) {
            return response()->json(new JsonResponse([], 'Lỗi đăng nhập'), ResponseAlias::HTTP_NOT_FOUND);
        }

        return $this->authenticated($objUser, $user);
    }

    private function isProviderAllowed($driver): bool
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
