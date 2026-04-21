<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxFounderAddress extends Data
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?int $countryCode = null,
        public readonly ?TaxRegion $region = null,
        public readonly ?TaxDistrict $district = null,
        public readonly ?int $sectorCode = null,
        public readonly ?string $village = null,
        public readonly ?string $streetName = null,
        public readonly ?string $house = null,
        public readonly ?string $flat = null,
        public readonly ?int $soatoCode = null,
        public readonly ?string $postcode = null,
        public readonly mixed $taxDetails = null,
    ) {}
}
