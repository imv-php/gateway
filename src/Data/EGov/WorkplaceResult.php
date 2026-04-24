<?php

namespace Imv\Gateway\Data\EGov;

use Spatie\LaravelData\Data;

class WorkplaceResult extends Data
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $partonimic = null,
        public readonly ?string $pnfl = null,
        /** @var WorkplacePosition[]|null */
        public readonly ?array $positions = null,
        public readonly ?int $result_code = null,
        public readonly ?string $result_message = null,
        public readonly ?string $surname = null,
    ) {}
}
