<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SchoolChildrenInfoRequest extends Request
{
    public function __construct(protected string $pinfl) {}

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/uzedu/school-children-info';
    }

    protected function defaultQuery(): array
    {
        return [
            'pinfl' => $this->pinfl,
            'lang'  => 'uz',
        ];
    }
}
