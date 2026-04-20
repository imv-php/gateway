<?php

namespace Imv\Gateway\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AuthRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(protected ?string $refresh_token = null) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/auth/token';
    }

    public function defaultBody(): array
    {
        return array_merge([
            'grant_type' => is_null($this->refresh_token) ? 'password' : 'refresh_token',
            'refresh_token' => $this->refresh_token,
        ], is_null($this->refresh_token) ? [
            'username' => config('gateway.username'),
            'password' => config('gateway.password'),
        ] : []);
    }
}
