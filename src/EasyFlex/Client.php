<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex;

use SoapFault;
use SoapClient;
use TheCodeConnectors\EasyFlex\EasyFlex\Errors\Messages;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\AuthenticatesUsers;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesRelationData;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesEmployeeData;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\ServiceTemporarilyUnavailableException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\UserLockedOutException;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesGlobalEasyFlexData;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\MissingLicenseException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\MissingSessionException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\SessionExpiredException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidParameterException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\DuplicateUserNameException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException;

class Client
{
    use AuthenticatesUsers, HandlesGlobalEasyFlexData, HandlesRelationData, HandlesEmployeeData;

    public const EMPLOYEE = 'flexwerker';

    public const RELATION = 'relatie';

    protected string $wsdl = 'https://www.easyflex.net/webservice/tools/wsdl.tpsp';

    protected ?SoapClient $soapClient;

    protected string $license;

    protected ?string $session;

    protected ?string $request;

    protected Response $response;

    public function __construct(string $license = '', SoapClient $soapClient = null)
    {
        $this->license = $license;
        $this->soapClient = $soapClient;
        $this->response = new Response();
        $this->session = null;
    }

    public function setWsdl(string $wsdl): Client
    {
        $this->wsdl = $wsdl;

        return $this;
    }

    public function getWsdl(): string
    {
        return $this->wsdl;
    }

    public function setLicense(string $license): Client
    {
        $this->license = $license;

        return $this;
    }

    public function getLicense(): string
    {
        return $this->license;
    }

    public function setSession($session): string
    {
        return $this->session = $session;
    }

    public function getSession(): ?string
    {
        return $this->response->session();
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function call(string $method, array $parameters = [], array $fields = []): self
    {
        $client = $this->soapClient();

        try {

            $payload = [$method => $this->constructPayload($method, $parameters, $fields)];

            $this->response = new Response($client->__soapCall($method, $payload), $this);

            $this->session = $this->response->session() ?: $this->session;

            $this->request = $client->__getLastRequest();

            $this->checkChangePasswordRequirement('', $parameters);

        } catch (SoapFault $fault) {

            // we tried, but failed
            // set the soap request we passed for easier debugging
            $this->request = $client->__getLastRequest();

            // try to throw a meaningfull exception instead of
            // only an arbitrary code with aDutch message
            $this->handleSoapFault($fault, $parameters);
        }

        // pass back the client so we can use it again with the new session key
        return $this;
    }

    public function soapClient(): SoapClient
    {
        if ( ! $this->soapClient) {
            $this->soapClient = new SoapClient($this->getWsdl()); // , ['trace' => 1]
        }

        return $this->soapClient;
    }

    public function constructPayload(string $method, array $parameters = [], array $fields = []): array
    {
        $fields = array_fill_keys($fields, '');

        if ($this->session && $method === 'wm_inloggen_update') {
            // stupid exception of adding the session parameter
            $parameters['session'] = $this->session;
            $fields = array_filter($fields);
        } else {
            foreach ($fields as $k => $v) {
                if ($v === null) {
                    // we can not use array filter here on calls other then wm_inloggen_update
                    // since that will filter out the keys with '',
                    // and we need to pass them
                    unset($fields[$k]);
                }
            }
        }

        $payload = [
            'license'    => $this->license,
            'parameters' => array_filter($parameters),
            'fields'     => $fields ?: null,
        ];

        if ($this->session && $method !== 'wm_inloggen_update') {
            // only add the session if we have one,
            // otherwise we get a invalid session error, when authenticating
            $payload['session'] = $this->session;
        }

        return $payload;
    }

    protected function handleSoapFault(SoapFault $fault, array $parameters = []): void
    {
        $this->checkServiceOffline($fault, $parameters);
        $this->checkServiceTemporarilyUnavailable($fault, $parameters);
        $this->checkLicenseError($fault, $parameters);
        $this->checkSessionError($fault, $parameters);
        $this->checkInvalidParameter($fault, $parameters);
        $this->checkUserLockedOut($fault, $parameters);

        $code = $fault->faultstring;
        $message = (isset($fault->detail, $fault->detail->message)) ? $fault->detail->message : '';
        $detail = (isset($fault->detail, $fault->detail->detail)) ? $fault->detail->detail : '';

        // weird message when user need to change
        // their password is hidden in $detail
        $this->checkChangePasswordRequirement($detail, $parameters);

        if ($exception = Messages::custom_exception($code)) {
            // then we might have a custom exception
            // for one of the Easyflex errorcodes
            throw new $exception($code, $message, $detail);
        }

        // we were not able to present a usefull message,
        // so pass throw whatever we got from Easyflex.
        throw new EasyFlexException($code, $message, $detail ?? $code);
    }

    protected function checkServiceTemporarilyUnavailable(SoapFault $fault, array $parameters = []): void
    {
        $checkError = "Service Temporarily Unavailable";
        if (strpos($fault->faultstring, $checkError) !== false) {
            throw new ServiceTemporarilyUnavailableException($checkError);
        }

        if(isset($fault->detail)) {
            if(strpos($fault->detail->detail ?? '', $checkError) !== false) {
                throw new ServiceTemporarilyUnavailableException($checkError);
            }
            if(strpos($fault->detail->message ?? '', $checkError) !== false) {
                throw new ServiceTemporarilyUnavailableException($checkError);
            }
        }
    }

    protected function checkServiceOffline(SoapFault $fault, array $parameters = []): void
    {
        if (strpos($fault->faultstring, "Start tag expected") !== false) {
            throw new WebserviceOfflineException("The webservice is offline");
        }
    }

    protected function checkLicenseError(SoapFault $fault, array $parameters = []): void
    {
        if (strpos($fault->faultstring, " object has no 'license' property") !== false) {
            throw new MissingLicenseException((string)$fault->faultstring);
        }
    }

    protected function checkSessionError(SoapFault $fault, array $parameters = []): void
    {
        if (strpos($fault->faultstring, '39053') !== false) {
            throw new SessionExpiredException((string)$fault->faultstring);
        }

        if (strpos($fault->faultstring, " object has no 'session' property") !== false) {
            throw new MissingSessionException((string)$fault->faultstring);
        }
    }

    protected function checkInvalidParameter(SoapFault $fault, array $parameters = []): void
    {
        if (strpos($fault->faultstring, '39043') !== false) {
            if ($fault->detail->detail === 'duplicate username') {
                throw new DuplicateUserNameException();
            }

            throw new InvalidParameterException($fault->detail->detail);
        }
    }

    protected function checkUserLockedOut(SoapFault $fault, array $parameters = []): void
    {
        $blockedAccountCodes = [
            39021,
            39022,
            39023,
            39031,
            39032,
            39033,
        ];

        if (in_array($fault->faultstring, $blockedAccountCodes)) {
            $exception = new UserLockedOutException($fault->detail->message);

            $exception->setParameters($parameters);

            throw $exception;
        }
    }

    protected function checkChangePasswordRequirement($detail = '', $parameters = []): void
    {
        if ($detail === 'change password' || strpos($parameters['db_inlognaam'] ?? '', 'EF_') === 0) {
            $exception = new RequireChangePasswordException();

            $exception->setParameters($parameters);
            $exception->setClient($this);

            throw $exception;
        }
    }
}
