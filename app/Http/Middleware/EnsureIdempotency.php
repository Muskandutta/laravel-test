<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class EnsureIdempotency
{
    /**
     * Handle an incoming request with an Idempotency-Key header.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = trim($request->header('Idempotency-Key') ?? $request->header('X-Idempotency-Key') ?? '');

        // If no Idempotency-Key header is provided, proceed normally
        if ($key === '') {
            return $next($request);
        }

        $cacheKey = "idempotency:{$key}";
        $currentHash = $this->hashPayload($request);

        $cached = Cache::get($cacheKey);

        if ($cached) {
            // Case 1: First request is still running
            if (($cached['status'] ?? '') === 'in_progress') {
                return response()->json([
                    'success' => false,
                    'message' => 'A request with this Idempotency-Key is currently being processed. Please wait and retry.',
                ], 409);
            }

            // Case 2: Same key used with a different payload
            if (($cached['payload_hash'] ?? '') !== $currentHash) {
                return response()->json([
                    'success' => false,
                    'message' => 'Idempotency-Key has already been used with a different request payload.',
                ], 422);
            }

            // Case 3: Completed previous request with identical payload
            return response()->json(
                $cached['response'],
                $cached['status_code'] ?? 200,
                ['X-Idempotent-Replay' => 'true']
            );
        }

        // Mark as in-progress (lock for 2 minutes to handle transient crashes)
        Cache::put($cacheKey, [
            'status'       => 'in_progress',
            'payload_hash' => $currentHash,
        ], now()->addMinutes(2));

        try {
            /** @var Response $response */
            $response = $next($request);

            if ($response->isSuccessful()) {
                // Cache completed successful response for 24 hours
                $content = json_decode($response->getContent(), true) ?? $response->getContent();

                Cache::put($cacheKey, [
                    'status'       => 'completed',
                    'payload_hash' => $currentHash,
                    'response'     => $content,
                    'status_code'  => $response->getStatusCode(),
                ], now()->addHours(24));
            } else {
                // If response failed (validation error, 4xx, 5xx), release the key so client can retry with corrections
                Cache::forget($cacheKey);
            }

            return $response;
        } catch (\Throwable $e) {
            Cache::forget($cacheKey);
            throw $e;
        }
    }

    /**
     * Compute a deterministic SHA-256 hash of the request payload.
     */
    private function hashPayload(Request $request): string
    {
        $payload = $request->all();
        ksort($payload);

        return hash('sha256', json_encode($payload));
    }
}
