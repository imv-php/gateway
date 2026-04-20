<?php

namespace Imv\Gateway\Exceptions;

use Saloon\Http\Response;

class GatewayException extends \RuntimeException
{
    public function __construct(
        string $message,
        public readonly ?Response $response = null,
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    public static function fromResponse(Response $response): self
    {
        try {
            $body = $response->json();
            $message = $body['message'] ?? $body['error'] ?? 'Gateway request failed';
        } catch (\Throwable) {
            $message = $response->body() ?: 'Gateway request failed';
        }

        return new self(
            message: $message,
            response: $response,
            code: $response->status(),
        );
    }
}
