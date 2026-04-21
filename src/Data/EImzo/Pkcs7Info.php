<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class Pkcs7Info extends Data
{
    public function __construct(
        /** @var Pkcs7Signer[]|null */
        public readonly ?array $signers = null,
        public readonly ?string $documentBase64 = null,
    ) {}
}
