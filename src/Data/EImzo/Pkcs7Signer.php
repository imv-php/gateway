<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class Pkcs7Signer extends Data
{
    public function __construct(
        public readonly ?TimeStampSignerId $signerId = null,
        public readonly ?string $signingTime = null,
        public readonly ?string $signature = null,
        public readonly ?string $digest = null,
        public readonly ?TimeStampInfo $timeStampInfo = null,
        /** @var CertificateInfo[]|null */
        public readonly ?array $certificate = null,
        public readonly ?string $OCSPResponse = null,
        public readonly ?string $statusUpdatedAt = null,
        public readonly ?string $statusNextUpdateAt = null,
        public readonly ?bool $verified = null,
        public readonly ?bool $certificateVerified = null,
        public readonly ?CertificateInfo $trustedCertificate = null,
        public readonly ?array $policyIdentifiers = null,
        public readonly ?bool $certificateValidAtSigningTime = null,
    ) {}
}
