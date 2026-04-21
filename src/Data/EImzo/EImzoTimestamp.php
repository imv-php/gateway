<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class EImzoTimestamp extends Data
{
    public function __construct(
        public readonly ?string $pkcs7b64 = null,
        /** @var EImzoSigner[]|null */
        public readonly ?array $timestampedSignerList = null,
        public readonly ?int $status = null,
        public readonly ?string $message = null,
    ) {}
}
