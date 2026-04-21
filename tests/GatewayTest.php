<?php

use Imv\Gateway\Data\OrganInfo;
use Imv\Gateway\Data\Passport\PassportInfo;
use Imv\Gateway\Data\Tax\TaxOrganInfo;
use Imv\Gateway\Exceptions\GatewayException;
use Imv\Gateway\Facades\Gateway;

it('can get organ info', function () {
    expect(Gateway::getOrganDataByTin('301538182')) // correct tin
        ->toBeInstanceOf(OrganInfo::class)
        ->and(fn () => Gateway::getOrganDataByTin('201122917')) // wrong tin
        ->toThrow(GatewayException::class)
        ->and(fn () => Gateway::getOrganDataByTin('invalid_tin')) // invalid tin
        ->toThrow(GatewayException::class);
});

it('can get passport info', function () {
    $pinfl = '50809006810034';
    $data = Gateway::getPassportInfo($pinfl);

    expect($data)
        ->toBeInstanceOf(PassportInfo::class)
        ->and($data->pinfl)->toBe($pinfl)
        ->and($data->firstName)->toBeString()
        ->and($data->lastName)->toBeString()
        ->and($data->document)->not->toBeNull();
});

it('can get tax organ info', function () {
    $tin = '309079092';
    $data = Gateway::getTaxOrganInfo($tin);

    expect($data)
        ->toBeInstanceOf(TaxOrganInfo::class)
        ->and($data->company->tin)->toBeString()
        ->and($data->company->name)->toBeString()
        ->and($data->founders)->toBeArray();
});
