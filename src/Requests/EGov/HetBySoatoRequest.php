<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class HetBySoatoRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected string $soato,
        protected string $licshet
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/res-personal-account';
    }

    protected function defaultBody(): array
    {
        return [
            'soato'   => $this->soato,
            'licshet' => $this->licshet,
        ];
    }
}
