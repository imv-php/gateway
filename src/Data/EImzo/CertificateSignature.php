<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class CertificateSignature extends Data
{
    public function __construct(
        public readonly ?string $signAlgName = null,
        public readonly ?string $signature = null,
    ) {}
}
