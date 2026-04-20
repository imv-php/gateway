<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class District extends Data
{
    public function __construct(
        public readonly ?int $code = null,
        public readonly ?string $name = null,
        public readonly ?string $name_ru = null,
        public readonly ?string $name_uz_cyrl = null,
        public readonly ?string $name_uz_latn = null,
        public readonly string|int|null $administrativeCenterCode = null,
        public readonly ?int $regionCode = null,
        public readonly ?int $region_id = null,
        public readonly ?int $regionId = null,
        public readonly ?int $districtId = null,
        public readonly ?int $districts_id = null,
        public readonly ?string $active = null,
    ) {}
}
