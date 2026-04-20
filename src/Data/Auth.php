<?php

namespace Imv\Gateway\Data;

use Spatie\LaravelData\Data;

class Auth extends Data
{
    public function __construct(
        public string $access_token,
        public string $refresh_token,
        public int $expires_in,
    ) {}
}
