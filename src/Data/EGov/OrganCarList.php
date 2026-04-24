<?php

namespace Imv\Gateway\Data\EGov;

use Spatie\LaravelData\Data;

class OrganCarList extends Data
{
    public function __construct(
        public readonly ?string $pinpp = null,
        public readonly ?string $organizationInn = null,
        /** @var OrganCarVehicle[]|null */
        public readonly ?array $vehicle = null,
        public readonly ?int $result = null,
        public readonly ?string $owner = null,
        public readonly ?int $ownerType = null,
        public readonly ?string $comment = null,
    ) {}
}
