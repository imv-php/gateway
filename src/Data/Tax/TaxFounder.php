<?php

namespace Imv\Gateway\Data\Tax;

use Spatie\LaravelData\Data;

class TaxFounder extends Data
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly mixed $founderIndividual = null,
        public readonly ?TaxFounderLegal $founderLegal = null,
        public readonly mixed $founderContact = null,
        public readonly ?TaxFounderAddress $founderAddress = null,
        public readonly ?int $budgetPercent = null,
        public readonly ?int $budgetLevelId = null,
    ) {}
}
