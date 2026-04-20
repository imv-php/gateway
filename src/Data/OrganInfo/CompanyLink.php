<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class CompanyLink extends Data
{
    public function __construct(
        public readonly ?string $parentTin = null,
        public readonly ?array $childrenTin = null,
        public readonly mixed $childrenDetail = null,
        public readonly ?int $typeReg = null,
        public readonly ?string $created = null,
    ) {}
}
