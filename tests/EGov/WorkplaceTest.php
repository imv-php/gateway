<?php

use Imv\Gateway\Data\EGov\WorkplaceResponse;
use Imv\Gateway\Facades\Gateway;

it('can get workplace info', function () {
    $pinfl = '50809006810034';
    $data = Gateway::getWorkplace($pinfl);

    expect($data)
        ->toBeInstanceOf(WorkplaceResponse::class)
        ->and($data->result->pnfl)->toBe($pinfl)
        ->and($data->result->name)->toBeString()
        ->and($data->result->surname)->toBeString()
        ->and($data->result->positions)->toBeArray();
});
