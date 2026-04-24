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
    
    $mockClient = new \Saloon\Http\Faking\MockClient([
        \Imv\Gateway\Requests\Tax\TaxOrganInfoRequest::class => \Saloon\Http\Faking\MockResponse::make([
            'company' => ['tin' => '309079092', 'name' => 'Test LLC'],
            'founders' => []
        ], 200),
    ]);

    $connector = new \Imv\Gateway\Connectors\GatewayConnector();
    $connector->withMockClient($mockClient);

    $gateway = app(\Imv\Gateway\Gateway::class);
    $reflection = new ReflectionClass($gateway);
    $property = $reflection->getProperty('connector');
    $property->setAccessible(true);
    $property->setValue($gateway, $connector);

    $data = $gateway->getTaxOrganInfo($tin);

    expect($data)
        ->toBeInstanceOf(TaxOrganInfo::class)
        ->and($data->company->tin)->toBeString()
        ->and($data->company->name)->toBeString()
        ->and($data->founders)->toBeArray();
});

it('can call egov and finance endpoints', function () {
    // We expect these to throw an exception if they fail auth or hit 404, etc.
    // For now we'll just check if the methods exist and return Response objects when mocked.
    $mockClient = new \Saloon\Http\Faking\MockClient([
        \Imv\Gateway\Requests\EGov\OrganCarListRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\OrgBuildingsListRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\StaffCountRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\DebtInfoJuridicRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\EntrepreneurRatingDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\JuridicLicenseDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\Finance\FinancialDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\Finance\FinancialReportRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
    ]);

    $connector = new \Imv\Gateway\Connectors\GatewayConnector();
    $connector->withMockClient($mockClient);

    $gateway = app(\Imv\Gateway\Gateway::class);
    $reflection = new ReflectionClass($gateway);
    $property = $reflection->getProperty('connector');
    $property->setAccessible(true);
    $property->setValue($gateway, $connector);

    expect($gateway->getOrganCars('123')->json())->toBe(['success' => true])
        ->and($gateway->getOrgBuildingsList('123')->json())->toBe(['success' => true])
        ->and($gateway->getStaffCount('123')->json())->toBe(['success' => true])
        ->and($gateway->getDebtInfoJuridic('123')->json())->toBe(['success' => true])
        ->and($gateway->getEntrepreneurRating('123')->json())->toBe(['success' => true])
        ->and($gateway->getJuridicLicense('123')->json())->toBe(['success' => true])
        ->and($gateway->getFinancialData('1', '2023-01-01', '123', '2023')->json())->toBe(['success' => true])
        ->and($gateway->getFinancialReport('1', '2023-01-01', '123', '2023')->json())->toBe(['success' => true]);
});

