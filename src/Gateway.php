<?php

namespace Imv\Gateway;

use Imv\Gateway\Auth\GatewayAuthenticator;
use Imv\Gateway\Connectors\GatewayConnector;
use Imv\Gateway\Data\OrganInfo;
use Imv\Gateway\Data\Passport\PassportInfo;
use Imv\Gateway\Exceptions\GatewayException;
use Imv\Gateway\Requests\OrganDataByTinRequest;
use Imv\Gateway\Requests\OrganInfoRequest;
use Imv\Gateway\Requests\Passport\PassportInfoV1;
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
}
