<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class EntrepreneurRatingDataRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(protected string $tin) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/mahalla-criteries';
    }

    protected function defaultBody(): array
    {
        return [
            'tin' => $this->tin,
        ];
    }
}
