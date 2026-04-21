<?php

namespace Imv\Gateway\Requests\EImzo;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Repositories\Body\StringBodyRepository;

class MakeAttachedRequest extends Request implements HasBody
{
    public function __construct(
        protected string $pkcs7b64
    ) {}

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'api/v1/e-imzo/make-attached';
    }

    public function body(): StringBodyRepository
    {
        return new StringBodyRepository($this->pkcs7b64);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'text/plain',
        ];
    }
}
