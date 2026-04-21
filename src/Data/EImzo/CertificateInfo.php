<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class CertificateInfo extends Data
{
    public function __construct(
        public readonly ?array $subjectInfo = null,
        public readonly ?array $issuerInfo = null,
        public readonly ?string $serialNumber = null,
        public readonly ?string $subjectName = null,
        public readonly ?string $validFrom = null,
        public readonly ?string $validTo = null,
        public readonly ?string $issuerName = null,
        public readonly ?CertificatePublicKey $publicKey = null,
        public readonly ?CertificateSignature $signature = null,
    ) {}
}
