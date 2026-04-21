<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class EImzoSigner extends Data
{
    public function __construct(
        public readonly ?string $serialNumber = null,
        public readonly ?string $X500Name = null,
        public readonly ?array $subjectName = null, // Using array due to numeric keys like '1.2.860.3.16.1.2'
        public readonly ?string $validFrom = null,
        public readonly ?string $validTo = null,
    ) {}
}
