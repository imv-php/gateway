<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class FounderLegal extends Data
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $tin = null,
        public readonly ?string $shortName = null,
        public readonly ?string $name = null,
        public readonly ?string $registrationDate = null,
        public readonly ?string $registrationNumber = null,
        public readonly ?string $reregistrationDate = null,
        public readonly ?string $businessFund = null,
        public readonly ?string $businessType = null,
        public readonly ?string $kfs = null,
        public readonly ?string $oked = null,
        public readonly ?string $opf = null,
        public readonly ?string $soato = null,
        public readonly ?string $soogu = null,
        public readonly ?string $sooguRegistrator = null,
        public readonly ?string $status = null,
        public readonly ?string $statusUpdated = null,
        public readonly ?string $taxMode = null,
        public readonly ?string $taxpayerType = null,
        public readonly ?string $vatNumber = null,
        public readonly ?string $liquidationDate = null,
        public readonly ?string $liquidationReason = null,
        public readonly ?string $businessStructure = null,
        public readonly ?string $created = null,
        public readonly ?string $updated = null,
        public readonly ?int $regCountry = null,
        public readonly ?int $founderSharePercent = null,
        public readonly ?int $founderShareSum = null,
        public readonly ?string $stateTin = null,
        public readonly ?int $countTotalFounders = null,
        public readonly mixed $director = null,
        public readonly mixed $accountant = null,
        public readonly mixed $businessStructureDetail = null,
        public readonly mixed $statusDetail = null,
        public readonly mixed $sooguDetail = null,
        public readonly mixed $activityTypes = null,
        public readonly mixed $opfDetail = null,
        public readonly mixed $okedDetail = null,
        public readonly mixed $countryDetail = null,
    ) {}
}
