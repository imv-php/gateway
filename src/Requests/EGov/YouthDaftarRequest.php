<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class YouthDaftarRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected string $passportNumber,
        protected string $passportSeria,
        protected string $pinfl
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/youth-daftar';
    }

    protected function defaultBody(): array
    {
        return [
            'passport_number' => $this->passportNumber,
            'passport_seria'  => $this->passportSeria,
            'pin'             => $this->pinfl,
            'type'            => 'young',
        ];
    }
}
