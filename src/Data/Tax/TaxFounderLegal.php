<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxFounderLegal extends Data
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $tin = null,
        public readonly ?string $shortName = null,
        public readonly ?string $name = null,
        public readonly ?string $registrationDate = null,
        public readonly ?string $registrationNumber = null,
        public readonly ?string $reregistrationDate = null,
        public readonly ?int $businessFund = null,
        public readonly ?int $businessType = null,
        public readonly ?int $kfs = null,
        public readonly ?string $oked = null,
        public readonly ?int $opf = null,
        public readonly ?int $soato = null,
        public readonly ?string $soogu = null,
        public readonly ?string $sooguRegistrator = null,
        public readonly ?int $status = null,
        public readonly ?string $statusUpdated = null,
        public readonly ?int $taxMode = null,
        public readonly ?int $taxpayerType = null,
        public readonly ?string $vatNumber = null,
        public readonly ?string $liquidationDate = null,
        public readonly ?string $liquidationReason = null,
        public readonly ?int $businessStructure = null,
        public readonly ?string $created = null,
        public readonly ?string $updated = null,
        public readonly ?int $regCountry = null,
        public readonly ?int $founderSharePercent = null,
        public readonly ?int $founderShareSum = null,
        public readonly ?string $stateTin = null,
        public readonly ?int $countTotalFounders = null,
        public readonly ?TaxDirector $director = null,
        public readonly ?TaxAccountant $accountant = null,
        public readonly ?TaxBusinessStructureDetail $businessStructureDetail = null,
        public readonly ?TaxStatusDetail $statusDetail = null,
        public readonly ?TaxSooguDetail $sooguDetail = null,
        /** @var TaxActivityType[]|null */
        public readonly ?array $activityTypes = null,
        public readonly ?TaxOpfDetail $opfDetail = null,
        public readonly ?TaxOkedDetail $okedDetail = null,
        public readonly ?TaxCountryDetail $countryDetail = null,
    ) {}
}
