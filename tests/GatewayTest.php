<?php

use Imv\Gateway\Data\OrganInfo;
use Imv\Gateway\Data\Passport\PassportInfo;
use Imv\Gateway\Data\Tax\TaxOrganInfo;
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
    $mockClient = new \Saloon\Http\Faking\MockClient([
        \Imv\Gateway\Requests\EGov\OrganCarListRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\OrgBuildingsListRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\StaffCountRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\DebtInfoJuridicRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\EntrepreneurRatingDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\JuridicLicenseDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\Finance\FinancialDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\Finance\FinancialReportRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\CadastralDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\ColdWaterRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\HotWaterRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\GasRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\TrashRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\HetByCadNumberRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\HetBySoatoRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\MibEstateBanRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\WorkplaceRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\MentalIllnessDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\NarcologistDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\SocialProtectionRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\FamilyReestrRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\YattDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\SchoolChildrenInfoRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\WomenServiceRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\YouthDaftarRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\MibDebtDataRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\ConvictionSearchRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
        \Imv\Gateway\Requests\EGov\ConvictionCheckRequest::class => \Saloon\Http\Faking\MockResponse::make(['success' => true], 200),
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
        ->and($gateway->getFinancialReport('1', '2023-01-01', '123', '2023')->json())->toBe(['success' => true])
        ->and($gateway->getCadastrData('cad')->json())->toBe(['success' => true])
        ->and($gateway->getColdWaterData('cad')->json())->toBe(['success' => true])
        ->and($gateway->getHotWaterData('cad')->json())->toBe(['success' => true])
        ->and($gateway->getGasData('cad')->json())->toBe(['success' => true])
        ->and($gateway->getTrashData('cad')->json())->toBe(['success' => true])
        ->and($gateway->getHetDataByCadNumber('cad')->json())->toBe(['success' => true])
        ->and($gateway->getHetDataBySoato('1', '2')->json())->toBe(['success' => true])
        ->and($gateway->getMibEstateBan('cad')->json())->toBe(['success' => true])
        ->and($gateway->getWorkplace('pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getMentalIllness('pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getNarcologist('pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getSocialProtection('pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getFamilyReestr('pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getYattData('pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getSchoolChildrenInfo('pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getWomenService('pinfl', 'sn')->json())->toBe(['success' => true])
        ->and($gateway->getYouthDaftar('num', 'seria', 'pinfl')->json())->toBe(['success' => true])
        ->and($gateway->getMibDebt('tin')->json())->toBe(['success' => true])
        ->and($gateway->sendConvictionSearch('fn', 'ln', 'mn', 'pass')->json())->toBe(['success' => true])
        ->and($gateway->getConvictionCheck('queryId')->json())->toBe(['success' => true]);
});
