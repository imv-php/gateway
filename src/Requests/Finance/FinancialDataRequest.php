<?php

namespace Imv\Gateway\Requests\Finance;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class FinancialDataRequest extends Request implements HasBody
{
    use HasJsonBody;

    public function __construct(
        protected string $quarter,
        protected string $requestDate,
        protected string $tin,
        protected string $year
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/egov/financial-report-form2';
    }

    protected function defaultBody(): array
    {
        return [
            'quarter'      => $this->quarter,
            'request_date' => $this->requestDate,
            'tin'          => $this->tin,
            'year'         => $this->year,
            'request_id'   => 1,
        ];
    }
}
