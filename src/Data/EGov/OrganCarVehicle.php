<?php

namespace Imv\Gateway\Data\EGov;

use Spatie\LaravelData\Data;

class OrganCarVehicle extends Data
{
    public function __construct(
        public readonly ?int $vehicleId = null,
        public readonly ?string $texpassportSery = null,
        public readonly ?string $texpassportNumber = null,
        public readonly ?string $plateNumber = null,
        public readonly ?string $model = null,
        public readonly ?string $registrationDate = null,
        public readonly ?int $vehicleType = null,
        public readonly ?string $kuzov = null,
        public readonly ?int $seats = null,
        public readonly ?string $dateSchetSpravka = null,
        public readonly ?string $tuningGivenDate = null,
        public readonly ?string $prevPnfl = null,
        public readonly ?string $prevOwner = null,
        public readonly ?int $prevOwnerType = null,
        public readonly ?string $prevPlateNumber = null,
        public readonly ?string $prevTexpasportSery = null,
        public readonly ?string $prevTexpassportNumber = null,
        public readonly mixed $state = null,
        public readonly ?string $vehicleColor = null,
        public readonly ?string $division = null,
        public readonly ?int $year = null,
        public readonly ?string $dodyTypeName = null,
        public readonly ?string $shassi = null,
        public readonly ?int $fullWeight = null,
        public readonly ?int $emptyWeight = null,
        public readonly ?string $motor = null,
        public readonly ?int $fuelType = null,
        public readonly ?int $stands = null,
        public readonly ?string $comments = null,
        public readonly ?int $power = null,
        public readonly ?string $tuningPermit = null,
        public readonly ?string $tuningIssueDate = null,
        public readonly ?string $nextInspectionDate = null,
    ) {}
}
