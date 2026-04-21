<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class TimeStampSignerId extends Data
{
    public function __construct(
        public readonly ?string $issuer = null,
        public readonly ?string $subjectSerialNumber = null,
    ) {}
}
