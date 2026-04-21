<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxAddress extends Data
{
    public function __construct(
        public readonly ?int $countryCode = null,
        public readonly ?int $soatoCode = null,
        public readonly ?string $village = null,
        public readonly ?string $postcode = null,
        public readonly ?int $sectorCode = null,
        public readonly ?string $streetName = null,
    ) {}
}
