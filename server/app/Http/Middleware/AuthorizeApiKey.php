<?php

namespace App\Http\Middleware;

use App\Responses\JsonResponse;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthorizeApiKey
{
    private $apiKey;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $this->apiKey = request()->header('API-KEY');

        if ($this->apiKey === null) {
            if ($request->wantsJson()) {
                return response()->json(new JsonResponse([], 'Unauthorized', ResponseAlias::HTTP_UNAUTHORIZED));
            }
        }

        if (!$this->isValidApiKey($this->apiKey)) {
            // If the request wants JSON (AJAX doesn't always want JSON)
            if ($request->wantsJson()) {
                return response()->json(new JsonResponse([], 'Unauthorized'), ResponseAlias::HTTP_UNAUTHORIZED);
            }
        }

        if (!request()->expectsJson()) {
            return response()->json(new JsonResponse([], 'Unauthorized'), ResponseAlias::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }

    /**
     * Validate the api key to the env api key
     *
     * @param String | null $apiKey
     * @return boolean
     */
    private function isValidApiKey(string|null $apiKey): bool
    {
        if ($apiKey !== config('app.api_key')) {
            return false;
        }
        return true;
    }
}
