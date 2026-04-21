<?php

namespace Imv\Gateway\Auth;

use Illuminate\Support\Facades\Cache;
use Imv\Gateway\Connectors\GatewayConnector;
use Imv\Gateway\Data\Auth as AuthData;
use Imv\Gateway\Requests\AuthRequest;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class GatewayAuthenticator implements Authenticator
{
    public function __construct(
        protected int $bufferSeconds = 60,
    ) {}

    public function set(PendingRequest $pendingRequest): void
    {
        $token = $this->resolveToken();
        $pendingRequest->headers()->add('Authorization', 'Bearer '.$token);
    }

    protected function resolveToken(): string
    {
        $cacheKey = config('gateway.cache_key');
        $cached = Cache::get($cacheKey);

        if ($cached) {
            return $cached['access_token'];
        }

        $response = (new GatewayConnector)->send(new AuthRequest);

        $auth = AuthData::from($response->json());

        Cache::put($cacheKey, $auth->toArray(), $auth->expires_in - $this->bufferSeconds);

        return $auth->access_token;
    }
}
