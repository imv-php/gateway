<?php

namespace Imv\Gateway\Data\Passport;

use Spatie\LaravelData\Data;

class PassportInfo extends Data
{
    public function __construct(
        public readonly ?string $pinfl = null,
        public readonly ?string $birthDate = null,
        public readonly ?int $birthCountryId = null,
        public readonly ?int $citizenshipId = null,
        public readonly ?int $genderCode = null,
        public readonly ?int $liveStatus = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $middleName = null,
        public readonly ?string $birthPlace = null,
        public readonly ?string $birthCountry = null,
        public readonly ?string $citizenship = null,
        public readonly ?string $nationality = null,
        public readonly ?PassportDocument $document = null,
        public readonly mixed $address = null,
        public readonly mixed $photo = null,
        public readonly ?string $photoHashId = null,
    ) {}
}
