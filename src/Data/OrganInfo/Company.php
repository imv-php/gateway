<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class Company extends Data
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $shortName = null,
        public readonly ?int $opf = null,
        public readonly ?int $kfs = null,
        public readonly ?string $tin = null,
        public readonly ?string $oked = null,
        public readonly ?string $soogu = null,
        public readonly ?string $sooguRegistrator = null,
        public readonly ?string $registrationDate = null,
        public readonly ?string $registrationNumber = null,
        public readonly ?string $reregistrationDate = null,
        public readonly ?int $status = null,
        public readonly ?string $statusUpdated = null,
        public readonly ?string $taxStatus = null,
        public readonly ?string $liquidationDate = null,
        public readonly ?string $liquidationReason = null,
        public readonly ?string $suspensionDate = null,
        public readonly ?string $suspensionReason = null,
        public readonly ?int $taxMode = null,
        public readonly ?string $vatNumber = null,
        public readonly ?string $vatRegistrationDate = null,
        public readonly ?int $taxpayerType = null,
        public readonly ?int $businessType = null,
        public readonly ?int $businessFund = null,
        public readonly ?int $businessStructure = null,
        public readonly ?string $businessFundCurrency = null,
        public readonly ?string $createdSysDate = null,
        public readonly ?string $updatedSysDate = null,
        public readonly ?string $taxModeBeginDate = null,
        public readonly ?string $taxModeEndDate = null,
        public readonly mixed $activityTypes = null,
    ) {}
}
