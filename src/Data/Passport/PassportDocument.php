<?php

namespace Imv\Gateway\Data\Passport;

use Spatie\LaravelData\Data;

class PassportDocument extends Data
{
    public function __construct(
        public readonly ?string $document = null,
        public readonly ?string $givePlace = null,
        public readonly ?int $givePlaceId = null,
        public readonly ?string $beginDate = null,
        public readonly ?string $endDate = null,
        public readonly ?string $type = null,
        public readonly ?int $status = null,
    ) {}
}
