<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class Address extends Data
{
    public function __construct(
        public readonly ?int $countryCode = null,
        public readonly ?int $sectorCode = null,
        public readonly ?string $villageCode = null,
        public readonly ?string $streetName = null,
        public readonly ?string $house = null,
        public readonly ?string $flat = null,
        public readonly ?int $soato = null,
        public readonly ?string $cadastreNumber = null,
        public readonly ?string $postcode = null,
    ) {}
}
