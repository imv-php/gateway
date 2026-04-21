<?php

namespace Imv\Gateway\Data\EImzo;

use Spatie\LaravelData\Data;

class EImzoSubjectName extends Data
{
    public function __construct(
        public readonly ?string $ST = null,
        public readonly ?string $UID = null,
        public readonly ?string $SURNAME = null,
        public readonly ?string $C = null,
        public readonly ?string $T = null,
        public readonly ?string $BusinessCategory = null,
        // Since property names cannot start with a number in PHP,
        // Spatie Data handles mapping from array if needed, but for strictly typed properties
        // we might map them or use an array if exact binding is complex without mapping config.
        // We will use mixed to capture all unstructured fields like '1.2.860.3.16.1.2' if needed,
        // but for now let's just accept the array map from spatie.
    ) {}
}
