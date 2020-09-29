<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex;

use SoapFault;
use SoapClient;
use TheCodeConnectors\EasyFlex\EasyFlex\Errors\Messages;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\AuthenticatesUsers;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesRelationData;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesEmployeeData;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesGlobalEasyFlexData;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\MissingLicenseException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\MissingSessionException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidParameterException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException;

/**
 * Class Client
 */
class Client
{
    use AuthenticatesUsers, HandlesGlobalEasyFlexData, HandlesRelationData, HandlesEmployeeData;

    /**
     * @var string
     */
    public const EMPLOYEE = 'flexwerker';

    /**
     * @var string
     */
    public const RELATION = 'relatie';

    /**
     * @var string
     */
    protected $wsdl = 'https://www.easyflex.net/webservice/tools/wsdl.tpsp';

    /**
     * @var \SoapClient
     */
    protected $soapClient;

    /**
     * @var string
     */
    protected $license = '';

    /**
     * @var string
     */
    protected $session = '';

    /**
     * @var string
     */
    protected $request;

    /**
     * @var \TheCodeConnectors\EasyFlex\EasyFlex\Response
     */
    protected $response;

    /**
     * @param string           $license
     * @param \SoapClient|null $soapClient
     */
    public function __construct($license = '', SoapClient $soapClient = null)
    {
        $this->license    = $license;
        $this->soapClient = $soapClient;
        $this->response   = new Response();
    }

    /**
     * @param string $wsdl
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Client
     */
    public function setWsdl(string $wsdl): Client
    {
        $this->wsdl = $wsdl;

        return $this;
    }

    /**
     * @return string
     */
    public function getWsdl(): string
    {
        return $this->wsdl;
    }

    /**
     * @param string $license
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Client
     */
    public function setLicense(string $license): Client
    {
        $this->license = $license;

        return $this;
    }

    /**
     * @return string
     */
    public function getLicense(): string
    {
        return $this->license;
    }

    /**
     * @return string
     */
    public function getSession(): string
    {
        return $this->response->session();
    }

    /**
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param       $method
     * @param array $parameters
     * @param array $fields
     *
     * @return $this
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function call($method, $parameters = [], $fields = []): self
    {
        // init the old school soap client
        $client = $this->soapClient();

        try {

            // construct the complete payload we need to send
            $payload = [$method => $this->constructPayload($parameters, $fields)];

            // call the soap service and set the response
            $this->response = new Response($client->__soapCall($method, $payload), $this);

            // if we get a new session from the response, store it to the cient
            $this->session = $this->response->session() ?: $this->session;

            // set the soap request we passed for easier debugging
            $this->request = $client->__getLastRequest();

        } catch (SoapFault $fault) {

            // we tried, but failed
            // set the soap request we passed for easier debugging
            $this->request = $client->__getLastRequest();

            // try to throw a meaningfull exception instead of
            // only an arbitrary code with aDutch message
            $this->handleSoapFault($fault);
        }

        // pass back the client so we can use it again with the new session key
        return $this;
    }

    /**
     * @return \SoapClient|\TheCodeConnectors\EasyFlex\Tests\Mock\SoapClient
     * @throws \SoapFault
     */
    public function soapClient()
    {
        if ( ! $this->soapClient) {
            $this->soapClient = new SoapClient($this->getWsdl()); // , ['trace' => 1]
        }

        return $this->soapClient;
    }

    /**
     * @param array $parameters
     * @param array $fields
     *
     * @return array
     */
    public function constructPayload($parameters = [], $fields = []): array
    {
        $payload = [
            'license'    => $this->license,
            'parameters' => array_filter($parameters),
            'fields'     => $fields ? array_fill_keys($fields, '') : null,
        ];

        if ($this->session) {
            // only add the session if we have one,
            // otherwise we get a invalid session error, when authenticating
            $payload['session'] = $this->session;
        }

        return $payload;
    }

    /**
     * @param \SoapFault $fault
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    protected function handleSoapFault(SoapFault $fault): void
    {
        $this->checkServiceOffline($fault);
        $this->checkLicenseError($fault);
        $this->checkSessionError($fault);
        $this->checkInvalidParameter($fault);

        $code    = $fault->faultstring;
        $message = (isset($fault->detail, $fault->detail->message)) ? $fault->detail->message : '';
        $detail  = (isset($fault->detail, $fault->detail->detail)) ? $fault->detail->detail : '';

        // weird message when user need to change
        // their password is hidden in $detail
        $this->checkChangePasswordRequirement($detail);

        if ($exception = Messages::custom_exception($code)) {
            // then we might have a custom exception
            // for one of the Easyflex errorcodes
            throw new $exception($code, $message, $detail);
        }

        // we were not able to present a usefull message,
        // so pass throw whatever we got from Easyflex.
        throw new EasyFlexException($code, $message, $detail ?? $code);
    }

    /**
     * @param \SoapFault $fault
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    protected function checkServiceOffline(SoapFault $fault): void
    {
        if (strpos($fault->faultstring, "Start tag expected") !== false) {
            throw new WebserviceOfflineException("The webservice is offline");
        }
    }

    /**
     * @param \SoapFault $fault
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\MissingLicenseException
     */
    public function checkLicenseError(SoapFault $fault): void
    {
        if (strpos($fault->faultstring, " object has no 'license' property") !== false) {
            throw new MissingLicenseException((string)$fault->faultstring);
        }
    }

    /**
     * @param \SoapFault $fault
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\MissingLicenseException
     */
    public function checkSessionError(SoapFault $fault): void
    {
        if (strpos($fault->faultstring, " object has no 'session' property") !== false) {
            throw new MissingSessionException((string)$fault->faultstring);
        }
    }

    /**
     * @param \SoapFault $fault
     * @param array      $parameters
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidParameterException
     */
    protected function checkInvalidParameter(SoapFault $fault, $parameters = []): void
    {
        if (strpos($fault->faultstring, '39043') !== false) {
            throw new InvalidParameterException($fault->detail->detail);
        }
    }

    /**
     * @param $detail
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     */
    protected function checkChangePasswordRequirement($detail): void
    {
        if ($detail === 'change password') {
            throw new RequireChangePasswordException();
        }
    }
}
