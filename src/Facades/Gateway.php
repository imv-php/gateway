<?php

namespace Imv\Gateway\Facades;

use Illuminate\Support\Facades\Facade;
use Saloon\Http\Response;

/**
 * @method static Response getOrganInfo(string $tin)
 * @method static Response getOrganDataByTin(string $tin)
 * @method static Response getOrganCars(string $tin)
 * @method static Response getOrgBuildingsList(string $tin)
 * @method static Response getStaffCount(string $tin)
 * @method static Response getDebtInfoJuridic(string $tin)
 * @method static Response getEntrepreneurRating(string $tin)
 * @method static Response getJuridicLicense(string $tin)
 * @method static Response getFinancialData(string $quarter, string $requestDate, string $tin, string $year)
 * @method static Response getFinancialReport(string $quarter, string $requestDate, string $tin, string $year)
 * @method static Response getCadastrData(string $cadastralNumber)
 * @method static Response getColdWaterData(string $cadastralNumber)
 * @method static Response getHotWaterData(string $cadastralNumber)
 * @method static Response getGasData(string $cadastralNumber)
 * @method static Response getTrashData(string $cadastralNumber)
 * @method static Response getHetDataByCadNumber(string $cadastralNumber)
 * @method static Response getHetDataBySoato(string $soato, string $licshet)
 * @method static Response getMibEstateBan(string $cadastralNumber)
 * @method static Response getUserData(string $pinfl, bool $isPhoto = false, ?string $birthDate = null)
 * @method static Response getWorkplace(string $pinfl)
 * @method static Response getMentalIllness(string $pinfl)
 * @method static Response getNarcologist(string $pinfl)
 * @method static Response getSocialProtection(string $pinfl)
 * @method static Response getFamilyReestr(string $pinfl)
 * @method static Response getYattData(string $pinfl)
 * @method static Response getSchoolChildrenInfo(string $pinfl)
 * @method static Response getWomenService(string $pinfl, string $passportSn)
 * @method static Response getYouthDaftar(string $passportNumber, string $passportSeria, string $pinfl)
 * @method static Response getMibDebt(string $tin)
 * @method static Response sendConvictionSearch(string $firstname, string $lastname, string $middlename, string $passport, ?string $pinfl = null, ?string $regionId = null)
 * @method static Response getConvictionCheck(string $queryId)
 * @method static Response timestamp(string $sign)
 * @method static Response makeAttached(string $pkcs7b64)
 *
 * @see \Imv\Gateway\Gateway
 */
class Gateway extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Imv\Gateway\Gateway::class;
    }
}
