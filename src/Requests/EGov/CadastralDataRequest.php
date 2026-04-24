<?php

namespace Imv\Gateway\Requests\EGov;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CadastralDataRequest extends Request implements HasBody
{
    use HasJsonBody;

    public const IVS_TIN = '201059101';

    public function __construct(protected string $cadastralNumber) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/org-cadastr-num';
    }

    protected function defaultBody(): array
    {
        return [
            'id'      => rand(10, 99),
            'purpose' => 'for gateway',
            'tin'     => self::IVS_TIN,
            'cad_num' => $this->cadastralNumber,
        ];
    }
}
