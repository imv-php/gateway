<?php

namespace Imv\Gateway\Requests\Passport;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class PassportInfoV1 extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected ?string $birthDate = null,
        protected ?string $document = null,
        protected ?bool $isPhoto = null,
        protected ?string $pinfl = null,
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/passport/by-pinfl-v1';
    }

    protected function defaultBody(): array
    {
        return [
            'birthDate' => $this->birthDate,
            'document' => $this->document,
            'isPhoto' => $this->isPhoto,
            'pinfl' => $this->pinfl,
        ];
    }
}
