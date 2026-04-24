<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class OrgBuildingsListRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(protected string $tin) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/org-cadastr-list';
    }

    protected function defaultBody(): array
    {
        return [
            'id'      => uniqid(),
            'tin'     => $this->tin,
            'org_tin' => $this->tin,
            'purpose' => 'for gateway request',
        ];
    }
}
