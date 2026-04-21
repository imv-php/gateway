<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxCompany extends Data
{
    public function __construct(
        public readonly ?string $businessFundCurrency = null,
        public readonly ?int $businessFund = null,
        public readonly ?int $businessType = null,
        public readonly ?int $kfs = null,
        public readonly ?string $liquidationDate = null,
        public readonly ?string $liquidationReason = null,
        public readonly ?string $name = null,
        public readonly ?string $oked = null,
        public readonly ?int $opf = null,
        public readonly ?string $registrationDate = null,
        public readonly ?string $registrationNumber = null,
        public readonly ?string $reregistrationDate = null,
        public readonly ?string $shortName = null,
        public readonly ?string $suspensionDate = null,
        public readonly ?string $suspensionReason = null,
        public readonly ?string $soogu = null,
        public readonly ?string $sooguRegistrator = null,
        public readonly ?int $status = null,
        public readonly ?string $statusUpdated = null,
        public readonly ?string $taxStatus = null,
        public readonly ?int $taxpayerType = null,
        public readonly ?string $tin = null,
        public readonly ?string $vatNumber = null,
        public readonly ?int $businessStructure = null,
        public readonly ?string $activityType = null,
        public readonly ?string $individualEntrepreneurType = null,
        public readonly ?string $licenseBeginDate = null,
        public readonly ?string $licenseEndDate = null,
        public readonly ?string $streetName = null,
    ) {}
}
