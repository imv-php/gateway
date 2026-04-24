<?php

namespace Imv\Gateway\Data\EGov;

use Spatie\LaravelData\Data;

class WorkplacePosition extends Data
{
    public function __construct(
        public readonly ?string $begin_date = null,
        public readonly ?int $dep_id = null,
        public readonly ?string $dep_name = null,
        public readonly ?string $dep_name_ru = null,
        public readonly ?string $doc_begin_num = null,
        public readonly ?string $kodp_pn = null,
        public readonly ?string $org = null,
        public readonly ?string $org_id = null,
        public readonly ?string $org_tin = null,
        public readonly ?string $position = null,
        public readonly ?int $position_id = null,
        public readonly ?string $position_ru = null,
        public readonly ?string $rate = null,
    ) {}
}
