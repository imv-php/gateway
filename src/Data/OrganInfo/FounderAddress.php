<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class FounderAddress extends Data
{
    public function __construct(
        public readonly ?string         $id = null,
        public readonly ?int            $countryCode = null,
        public readonly ?Region         $region = null,
        public readonly ?District       $district = null,
        public readonly string|int|null $village = null,
        public readonly ?string         $streetName = null,
        public readonly ?string         $house = null,
        public readonly ?string         $flat = null,
        public readonly ?int            $soatoCode = null,
        public readonly ?string         $postcode = null,
    ) {}
}
