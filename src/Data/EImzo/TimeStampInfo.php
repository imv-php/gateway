<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class TimeStampInfo extends Data
{
    public function __construct(
        /** @var CertificateInfo[]|null */
        public readonly ?array $certificate = null,
        public readonly ?string $OCSPResponse = null,
        public readonly ?string $statusUpdatedAt = null,
        public readonly ?string $statusNextUpdateAt = null,
        public readonly ?bool $digestVerified = null,
        public readonly ?bool $certificateVerified = null,
        public readonly ?CertificateInfo $trustedCertificate = null,
        public readonly ?bool $certificateValidAtSigningTime = null,
        public readonly ?TimeStampSignerId $signerId = null,
        public readonly ?string $tsaPolicy = null,
        public readonly ?string $time = null,
        public readonly ?string $hashAlgorithm = null,
        public readonly ?string $serialNumber = null,
        public readonly ?string $tsa = null,
        public readonly ?string $messageImprintAlgOID = null,
        public readonly ?string $messageImprintDigest = null,
        public readonly ?bool $verified = null,
    ) {}
}
