<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class MibDebtDataRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected string $tin,
        protected string $senderPinfl = '12121212121212'
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/mib-debtor-exec-inn-request';
    }

    protected function defaultBody(): array
    {
        return [
            'inn'         => $this->tin,
            'senderPinfl' => $this->senderPinfl,
        ];
    }
}
