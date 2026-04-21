<?php

namespace Imv\Gateway\Data\Tax;

use Imv\Gateway\Data\OrganInfo\CompanyExtraInfo;
use Spatie\LaravelData\Data;

class TaxOrganInfo extends Data
{
    public function __construct(
        public readonly ?TaxCompany $company = null,
        public readonly mixed $extraActivityTypes = null,
        public readonly ?array $companyBanks = null,
        public readonly ?TaxAddress $companyBillingAddress = null,
        public readonly ?array $companyShippingAddress = null,
        public readonly ?CompanyExtraInfo $companyExtraInfo = null,
        public readonly ?TaxDirector $director = null,
        public readonly ?TaxAddress $directorAddress = null,
        public readonly ?TaxContact $directorContact = null,
        public readonly ?TaxAccountant $accountant = null,
        public readonly ?TaxAddress $accountantAddress = null,
        public readonly ?TaxContact $accountantContact = null,
        /** @var TaxFounder[]|null */
        public readonly ?array $founders = null,
    ) {}
}
