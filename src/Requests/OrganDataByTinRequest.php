<?php

namespace Imv\Gateway\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class OrganDataByTinRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected string $tin) {}

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/bd-juridic';
    }

    public function defaultBody(): array
    {
        return [
            'tin' => $this->tin,
        ];
    }
}
