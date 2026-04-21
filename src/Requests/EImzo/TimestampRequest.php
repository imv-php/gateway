<?php

namespace Imv\Gateway\Requests\EImzo;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Repositories\Body\StringBodyRepository;

class TimestampRequest extends Request implements HasBody
{
    public function __construct(
        protected string $sign
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/e-imzo/timestamp';
    }

    public function body(): StringBodyRepository
    {
        return new StringBodyRepository($this->sign);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'text/plain',
        ];
    }
}
