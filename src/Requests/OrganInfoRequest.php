<?php

namespace Imv\Gateway\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class OrganInfoRequest extends Request
{
    public function __construct(protected string $tin) {}

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'api/v1/tax/org';
    }

    protected function defaultQuery(): array
    {
        return [
            'tin' => $this->tin,
        ];
    }
}
