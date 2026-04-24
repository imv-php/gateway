<?php

namespace Imv\Gateway\Data\EGov;

use Spatie\LaravelData\Data;

class WorkplaceResponse extends Data
{
    public function __construct(
        public readonly mixed $error = null,
        public readonly ?int $id = null,
        public readonly ?string $jsonrpc = null,
        public readonly ?WorkplaceResult $result = null,
    ) {}
}
