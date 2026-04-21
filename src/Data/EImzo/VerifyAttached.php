<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class VerifyAttached extends Data
{
    public function __construct(
        public readonly ?Pkcs7Info $pkcs7Info = null,
        public readonly ?int $status = null,
        public readonly ?string $message = null,
    ) {}
}
