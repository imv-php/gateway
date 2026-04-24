<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ConvictionCheckRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(protected string $queryId) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/conviction/check';
    }

    protected function defaultBody(): array
    {
        return [
            'id_query' => $this->queryId,
        ];
    }
}
