<?php

namespace Imv\Gateway;

use Imv\Gateway\Auth\GatewayAuthenticator;
use Imv\Gateway\Connectors\GatewayConnector;
use Imv\Gateway\Data\EImzo\EImzoTimestamp;
use Imv\Gateway\Data\EImzo\VerifyAttached;
use Imv\Gateway\Data\OrganInfo;
use Imv\Gateway\Data\Passport\PassportInfo;
use Imv\Gateway\Data\Tax\TaxOrganInfo;
use Imv\Gateway\Exceptions\GatewayException;
use Imv\Gateway\Requests\EImzo\MakeAttachedRequest;
use Imv\Gateway\Requests\EImzo\TimestampRequest;
use Imv\Gateway\Requests\EImzo\VerifyAttachedRequest;
use Imv\Gateway\Requests\OrganDataByTinRequest;
use Imv\Gateway\Requests\OrganInfoRequest;
use Imv\Gateway\Requests\Passport\PassportInfoV1;
use Imv\Gateway\Requests\Tax\TaxOrganInfoRequest;
use Imv\Gateway\Requests\EGov\DebtInfoJuridicRequest;
use Imv\Gateway\Requests\EGov\EntrepreneurRatingDataRequest;
use Imv\Gateway\Requests\EGov\JuridicLicenseDataRequest;
use Imv\Gateway\Requests\EGov\OrgBuildingsListRequest;
use Imv\Gateway\Requests\EGov\OrganCarListRequest;
use Imv\Gateway\Requests\EGov\StaffCountRequest;
use Imv\Gateway\Requests\Finance\FinancialDataRequest;
use Imv\Gateway\Requests\Finance\FinancialReportRequest;
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

    public function getOrganCars(string $tin): Response
    {
        return $this->send(new OrganCarListRequest($tin));
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
