<?php

namespace Imv\Gateway\Data;

use Imv\Gateway\Data\OrganInfo\Accountant;
use Imv\Gateway\Data\OrganInfo\Address;
use Imv\Gateway\Data\OrganInfo\Company;
use Imv\Gateway\Data\OrganInfo\CompanyExtraInfo;
use Imv\Gateway\Data\OrganInfo\CompanyLink;
use Imv\Gateway\Data\OrganInfo\Contact;
use Imv\Gateway\Data\OrganInfo\Director;
use Imv\Gateway\Data\OrganInfo\Founder;
use Spatie\LaravelData\Data;

class OrganInfo extends Data
{
    public function __construct(
        public readonly ?Company $company = null,
        public readonly ?Address $companyBillingAddress = null,
        public readonly ?array $companyShippingAddresses = null,
        public readonly ?CompanyExtraInfo $companyExtraInfo = null,
        public readonly ?Director $director = null,
        public readonly ?Address $directorAddress = null,
        public readonly ?Contact $directorContact = null,
        public readonly ?Accountant $accountant = null,
        public readonly ?Address $accountantAddress = null,
        public readonly ?Contact $accountantContact = null,
        public readonly mixed $companyContact = null,
        public readonly mixed $argos = null,
        public readonly ?array $companyBanks = null,
        /** @var Founder[]|null */
        public readonly ?array $founders = null,
        public readonly ?CompanyLink $companyLink = null,
        public readonly ?array $companyBranches = null,
    ) {}
}
