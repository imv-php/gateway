<?php

use Imv\Gateway\Data\OrganInfo;
use Imv\Gateway\Exceptions\GatewayException;
use Imv\Gateway\Facades\Gateway;

it('can get organ info', function () {
    expect(Gateway::getOrganDataByTin('301538182')) //correct tin
        ->toBeInstanceOf(OrganInfo::class)
        ->and(fn() => Gateway::getOrganDataByTin('201122917')) //wrong tin
        ->toThrow(GatewayException::class)
        ->and(fn() => Gateway::getOrganDataByTin('invalid_tin')) //invalid tin
        ->toThrow(GatewayException::class);

});
