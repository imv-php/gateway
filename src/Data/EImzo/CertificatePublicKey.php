<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class CertificatePublicKey extends Data
{
    public function __construct(
        public readonly ?string $keyAlgName = null,
        public readonly ?string $publicKey = null,
    ) {}
}
