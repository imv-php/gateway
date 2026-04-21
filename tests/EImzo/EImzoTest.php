<?php

use Imv\Gateway\Data\EImzo\EImzoTimestamp;
use Imv\Gateway\Data\EImzo\VerifyAttachedResponse;
use Imv\Gateway\Facades\Gateway;

class SharedData
{
    public string $pkcs7b64;
}

$sharedData = new SharedData;

it('can get e-imzo timestamp and verify pkcs7b64', function () use ($sharedData) {
    $data = Gateway::getEImzoTimestamp('');
    $sharedData->pkcs7b64 = $data->pkcs7b64;

    expect($data)
        ->toBeInstanceOf(EImzoTimestamp::class)
        ->and($data->pkcs7b64)->toBeString()
        ->and($data->status)->toBe(1);
});

it('can verify attached', function () use ($sharedData) {

    $data = Gateway::verifyAttached($sharedData->pkcs7b64);

    expect($data)
        ->toBeInstanceOf(VerifyAttachedResponse::class);
});
