<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class HetByCadNumberRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(protected string $cadastralNumber) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/het-customer-info';
    }

    protected function defaultBody(): array
    {
        return [
            'kadastrCode'  => $this->cadastralNumber,
            'customerType' => 'P',
        ];
    }
}
