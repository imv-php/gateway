<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class Region extends Data
{
    public function __construct(
        public readonly ?int $code = null,
        public readonly ?string $name = null,
        public readonly ?string $name_ru = null,
        public readonly ?string $name_uz_cyrl = null,
        public readonly ?string $name_uz_latn = null,
        public readonly ?string $administrativeCenterCode = null,
    ) {}
}
