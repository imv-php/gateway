<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class CompanyExtraInfo extends Data
{
    public function __construct(
        public readonly ?string $companyExtraInfoId = null,
        public readonly ?int $avgNumberEmployees = null,
        public readonly ?string $monthlyNumberEmployees = null,
    ) {}
}
