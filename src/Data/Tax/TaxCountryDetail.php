<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxCountryDetail extends Data
{
    public function __construct(
        public readonly ?string $shortName_en = null,
        public readonly ?string $shortName_ru = null,
        public readonly ?string $shortName_uz_cyrl = null,
        public readonly ?string $shortName_uz_latn = null,
        public readonly ?string $fullName_en = null,
        public readonly ?string $fullName_ru = null,
        public readonly ?string $fullName_uz_cyrl = null,
        public readonly ?string $fullName_uz_latn = null,
        public readonly ?string $numericCode = null,
        public readonly ?string $alpha2Code = null,
        public readonly ?string $alpha3Code = null,
    ) {}
}
