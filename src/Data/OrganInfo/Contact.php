<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class Contact extends Data
{
    public function __construct(
        public readonly ?string $phone = null,
        public readonly ?string $email = null,
    ) {}
}
