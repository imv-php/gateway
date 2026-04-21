<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxContact extends Data
{
    public function __construct(
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
    ) {}
}
