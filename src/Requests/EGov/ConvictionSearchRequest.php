<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ConvictionSearchRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected string $firstname,
        protected string $lastname,
        protected string $middlename,
        protected string $passport,
        protected ?string $pinfl = null,
        protected ?string $regionId = null
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/convictions/search';
    }

    protected function defaultBody(): array
    {
        return [
            'is_allowed_abroad' => true,
            'consent'           => true,
            'birth_year'        => '',
            'comments'          => 'gateway request',
            'firstname'         => $this->firstname,
            'lastname'          => $this->lastname,
            'middlename'        => $this->middlename,
            'organization_id'   => '04063', // Used by default in previous implementation
            'passport'          => $this->passport,
            'pinfl'             => $this->pinfl,
            'region_id'         => $this->regionId,
        ];
    }
}
