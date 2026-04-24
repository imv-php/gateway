<?php

namespace Imv\Gateway;

use Imv\Gateway\Auth\GatewayAuthenticator;
use Imv\Gateway\Connectors\GatewayConnector;
use Imv\Gateway\Data\EGov\OrganCarList;
use Imv\Gateway\Data\EGov\WorkplaceResponse;
use Imv\Gateway\Data\EImzo\EImzoTimestamp;
use Imv\Gateway\Data\EImzo\VerifyAttached;
use Imv\Gateway\Data\OrganInfo;
use Imv\Gateway\Data\Passport\PassportInfo;
use Imv\Gateway\Data\Tax\TaxOrganInfo;
use Imv\Gateway\Exceptions\GatewayException;
use Imv\Gateway\Requests\EGov\CadastralDataRequest;
use Imv\Gateway\Requests\EGov\ColdWaterRequest;
use Imv\Gateway\Requests\EGov\ConvictionCheckRequest;
use Imv\Gateway\Requests\EGov\ConvictionSearchRequest;
use Imv\Gateway\Requests\EGov\DebtInfoJuridicRequest;
use Imv\Gateway\Requests\EGov\EntrepreneurRatingDataRequest;
use Imv\Gateway\Requests\EGov\FamilyReestrRequest;
use Imv\Gateway\Requests\EGov\GasRequest;
use Imv\Gateway\Requests\EGov\HetByCadNumberRequest;
use Imv\Gateway\Requests\EGov\HetBySoatoRequest;
use Imv\Gateway\Requests\EGov\HotWaterRequest;
use Imv\Gateway\Requests\EGov\JuridicLicenseDataRequest;
use Imv\Gateway\Requests\EGov\MentalIllnessDataRequest;
use Imv\Gateway\Requests\EGov\MibDebtDataRequest;
use Imv\Gateway\Requests\EGov\MibEstateBanRequest;
use Imv\Gateway\Requests\EGov\NarcologistDataRequest;
use Imv\Gateway\Requests\EGov\OrgBuildingsListRequest;
use Imv\Gateway\Requests\EGov\OrganCarListRequest;
use Imv\Gateway\Requests\EGov\SchoolChildrenInfoRequest;
use Imv\Gateway\Requests\EGov\SocialProtectionRequest;
use Imv\Gateway\Requests\EGov\StaffCountRequest;
use Imv\Gateway\Requests\EGov\TrashRequest;
use Imv\Gateway\Requests\EGov\WomenServiceRequest;
use Imv\Gateway\Requests\EGov\WorkplaceRequest;
use Imv\Gateway\Requests\EGov\YattDataRequest;
use Imv\Gateway\Requests\EGov\YouthDaftarRequest;
use Imv\Gateway\Requests\EImzo\MakeAttachedRequest;
use Imv\Gateway\Requests\EImzo\TimestampRequest;
use Imv\Gateway\Requests\EImzo\VerifyAttachedRequest;
use Imv\Gateway\Requests\Finance\FinancialDataRequest;
use Imv\Gateway\Requests\Finance\FinancialReportRequest;
use Imv\Gateway\Requests\OrganDataByTinRequest;
use Imv\Gateway\Requests\OrganInfoRequest;
use Imv\Gateway\Requests\Passport\PassportInfoV1;
use Imv\Gateway\Requests\Tax\TaxOrganInfoRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Request;
use Saloon\Http\Response;

class Gateway
{
    protected GatewayConnector $connector;

    public function __construct()
    {
        $this->connector = new GatewayConnector;
        $this->connector->authenticate(new GatewayAuthenticator);
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    protected function send(Request $request): Response
    {
        $response = $this->connector->send($request);

        if ($response->failed()) {
            throw GatewayException::fromResponse($response);
        }

        if (empty($response->json())) {
            throw new GatewayException('Response is empty');
        }

        return $response;
    }

    public function getOrganInfo(string $tin): Response
    {
        return $this->send(new OrganInfoRequest($tin));
    }

    public function getOrganDataByTin(string $tin): OrganInfo
    {
        $response = $this->send(new OrganDataByTinRequest($tin));
        return OrganInfo::from($response->json());
    }

    public function getPassportInfo(string $pinfl, ?string $birthDate = null, ?string $document = null, bool $isPhoto = false): PassportInfo
    {
        $response = $this->send(new PassportInfoV1($birthDate, $document, $isPhoto, $pinfl));
        return PassportInfo::from($response->json());
    }

    public function getTaxOrganInfo(string $tin): TaxOrganInfo
    {
        $response = $this->send(new TaxOrganInfoRequest($tin));
        return TaxOrganInfo::from($response->json());
    }

    public function getOrganCars(string $tin): OrganCarList
    {
        $response = $this->send(new OrganCarListRequest($tin));
        return OrganCarList::from($response->json());
    }

    public function getOrgBuildingsList(string $tin): Response
    {
        return $this->send(new OrgBuildingsListRequest($tin));
    }

    public function getStaffCount(string $tin): Response
    {
        return $this->send(new StaffCountRequest($tin));
    }

    public function getDebtInfoJuridic(string $tin): Response
    {
        return $this->send(new DebtInfoJuridicRequest($tin));
    }

    public function getEntrepreneurRating(string $tin): Response
    {
        return $this->send(new EntrepreneurRatingDataRequest($tin));
    }

    public function getJuridicLicense(string $tin): Response
    {
        return $this->send(new JuridicLicenseDataRequest($tin));
    }

    public function getFinancialData(string $quarter, string $requestDate, string $tin, string $year): Response
    {
        return $this->send(new FinancialDataRequest($quarter, $requestDate, $tin, $year));
    }

    public function getFinancialReport(string $quarter, string $requestDate, string $tin, string $year): Response
    {
        return $this->send(new FinancialReportRequest($quarter, $requestDate, $tin, $year));
    }

    public function getCadastrData(string $cadastralNumber): Response
    {
        return $this->send(new CadastralDataRequest($cadastralNumber));
    }

    public function getColdWaterData(string $cadastralNumber): Response
    {
        return $this->send(new ColdWaterRequest($cadastralNumber));
    }

    public function getHotWaterData(string $cadastralNumber): Response
    {
        return $this->send(new HotWaterRequest($cadastralNumber));
    }

    public function getGasData(string $cadastralNumber): Response
    {
        return $this->send(new GasRequest($cadastralNumber));
    }

    public function getTrashData(string $cadastralNumber): Response
    {
        return $this->send(new TrashRequest($cadastralNumber));
    }

    public function getHetDataByCadNumber(string $cadastralNumber): Response
    {
        return $this->send(new HetByCadNumberRequest($cadastralNumber));
    }

    public function getHetDataBySoato(string $soato, string $licshet): Response
    {
        return $this->send(new HetBySoatoRequest($soato, $licshet));
    }

    public function getMibEstateBan(string $cadastralNumber, string $pinfl = '12121212121212'): Response
    {
        return $this->send(new MibEstateBanRequest($cadastralNumber, $pinfl));
    }

    public function getWorkplace(string $pinfl): WorkplaceResponse
    {
        $response = $this->send(new WorkplaceRequest($pinfl));
        return WorkplaceResponse::from($response->json());
    }

    public function getMentalIllness(string $pinfl): Response
    {
        return $this->send(new MentalIllnessDataRequest($pinfl));
    }

    public function getNarcologist(string $pinfl): Response
    {
        return $this->send(new NarcologistDataRequest($pinfl));
    }

    public function getSocialProtection(string $pinfl): Response
    {
        return $this->send(new SocialProtectionRequest($pinfl));
    }

    public function getFamilyReestr(string $pinfl): Response
    {
        return $this->send(new FamilyReestrRequest($pinfl));
    }

    public function getYattData(string $pinfl): Response
    {
        return $this->send(new YattDataRequest($pinfl));
    }

    public function getSchoolChildrenInfo(string $pinfl): Response
    {
        return $this->send(new SchoolChildrenInfoRequest($pinfl));
    }

    public function getWomenService(string $pinfl, string $passportSn): Response
    {
        return $this->send(new WomenServiceRequest($pinfl, $passportSn));
    }

    public function getYouthDaftar(string $passportNumber, string $passportSeria, string $pinfl): Response
    {
        return $this->send(new YouthDaftarRequest($passportNumber, $passportSeria, $pinfl));
    }

    public function getMibDebt(string $tin, string $senderPinfl = '12121212121212'): Response
    {
        return $this->send(new MibDebtDataRequest($tin, $senderPinfl));
    }

    public function sendConvictionSearch(string $firstname, string $lastname, string $middlename, string $passport, ?string $pinfl = null, ?string $regionId = null): Response
    {
        return $this->send(new ConvictionSearchRequest($firstname, $lastname, $middlename, $passport, $pinfl, $regionId));
    }

    public function getConvictionCheck(string $queryId): Response
    {
        return $this->send(new ConvictionCheckRequest($queryId));
    }

    public function getEImzoTimestamp(string $sign): EImzoTimestamp
    {
        $response = $this->send(new TimestampRequest($sign));
        return EImzoTimestamp::from($response->json());
    }

    public function makeAttached(string $pkcs7b64): Response
    {
        return $this->send(new MakeAttachedRequest($pkcs7b64));
    }

    public function verifyAttached(string $pkcs7b64): VerifyAttached
    {
        $response = $this->send(new VerifyAttachedRequest($pkcs7b64));
        return VerifyAttached::from($response->json());
    }
}
