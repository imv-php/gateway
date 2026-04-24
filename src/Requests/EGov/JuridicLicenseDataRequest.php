<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class JuridicLicenseDataRequest extends Request
{
    public function __construct(protected string $tin) {}

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/get-external-license-registrations-by-filter';
    }

    protected function defaultQuery(): array
    {
        return [
            'tin' => $this->tin,
        ];
    }
}
