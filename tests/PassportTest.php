<?php

use Imv\Gateway\Data\Passport\PassportInfo;
use Imv\Gateway\Facades\Gateway;

it('can get passport info', function () {
    $pinfl = '11111111111111';
    $data = Gateway::getPassportInfo($pinfl);

    expect($data)
        ->toBeInstanceOf(PassportInfo::class)
        ->and($data->pinfl)->toBe($pinfl)
        ->and($data->firstName)->toBeString()
        ->and($data->lastName)->toBeString()
        ->and($data->document)->not->toBeNull();
});
