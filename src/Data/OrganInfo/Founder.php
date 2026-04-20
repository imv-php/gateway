<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class Founder extends Data
{
    public function __construct(
        public readonly ?FounderIndividual $founderIndividual = null,
        public readonly ?FounderLegal $founderLegal = null,
        public readonly mixed $founderContact = null,
        public readonly ?FounderAddress $founderAddress = null,
    ) {}
}
