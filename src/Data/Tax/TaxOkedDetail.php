<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxOkedDetail extends Data
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?string $name_ru = null,
        public readonly ?string $name_uz_cyrl = null,
        public readonly ?string $name_uz_latn = null,
        public readonly ?string $section = null,
        public readonly ?string $name_short_ru = null,
        public readonly ?string $name_short_uz_cyrl = null,
        public readonly ?string $name_short_uz_latn = null,
        public readonly ?string $pkm275 = null,
        public readonly ?int $employee_limit_mf = null,
        public readonly ?int $employee_limit_lf = null,
    ) {}
}
