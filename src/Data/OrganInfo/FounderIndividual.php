<?php

namespace Imv\Gateway\Data\OrganInfo;

use Spatie\LaravelData\Data;

class FounderIndividual extends Data
{
    public function __construct(
        public readonly ?string $lastName = null,
        public readonly ?string $firstName = null,
        public readonly ?string $middleName = null,
        public readonly ?int $gender = null,
        public readonly ?string $nationality = null,
        public readonly ?string $citizenship = null,
        public readonly ?string $passportSeries = null,
        public readonly ?string $passportNumber = null,
        public readonly ?string $pinfl = null,
        public readonly ?string $tin = null,
        public readonly ?string $birthDate = null,
    ) {}
}
