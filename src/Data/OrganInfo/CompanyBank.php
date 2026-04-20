<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class CompanyBank extends Data
{
    public function __construct(
        public readonly ?string $mfo = null,
        public readonly ?string $paymentAccount = null,
        public readonly ?int $status = null,
        public readonly ?string $openDate = null,
        public readonly ?string $closeDate = null,
        public readonly ?int $attribute = null,
        public readonly ?string $reasonCode = null,
        public readonly ?string $currencyCode = null,
    ) {}
}
