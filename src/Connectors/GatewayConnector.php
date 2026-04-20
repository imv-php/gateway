<?php

namespace Imv\Gateway\Connectors;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\HasTimeout;

class GatewayConnector extends Connector
{
    use AcceptsJson;
    use HasTimeout;

    protected int $connectTimeout;

    protected int $requestTimeout;

    public function __construct()
    {
        $this->connectTimeout = (int) config('gateway.connect_timeout', 15);
        $this->requestTimeout = (int) config('gateway.request_timeout', 30);
    }

    public function resolveBaseUrl(): string
    {
        return config('gateway.base_url');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
}
