<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class WomenServiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected string $pinfl,
        protected string $passportSn
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'egov/check-women-service';
    }

    protected function defaultBody(): array
    {
        return [
            'pinfl'       => $this->pinfl,
            'passport_sn' => $this->passportSn,
        ];
    }
}
