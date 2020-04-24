<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\EasyFlex\Response;
use TheCodeConnectors\EasyFlex\Tests\Mock\SoapClient;

class ResponseTest extends TestCase
{
    protected $soapClient;

    /**
     * @throws \SoapFault
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->soapClient = new SoapClient(__DIR__ . '/wsdl/wsdl.tpsp', ['cache_wsdl' => WSDL_CACHE_NONE]);
    }

    public function test_it_returns_the_raw_soap_response(): void
    {
        $this->soapClient->setMockedResponse(file_get_contents(__DIR__ . '/responses/login.xml'));

        $soapReponse = $this->soapClient->__getLastResponse();
        $response    = new Response($soapReponse);

        $this->assertEquals($soapReponse, $response->raw());
    }

    public function test_it_returns_the_soap_response_as_array(): void
    {
        $this->soapClient->setMockedResponse(file_get_contents(__DIR__ . '/responses/declaraties-perioden.xml'));

        $soapReponse = $this->soapClient->__getLastResponse();
        $response    = new Response($soapReponse);
        $array       = $response->toArray();

        $this->assertTrue(is_array($array));
        $this->assertTrue(isset($array[0]['fields']));
    }

    public function test_it_extracts_the_session_from_a_login_response(): void
    {
        $this->soapClient->setMockedResponse(file_get_contents(__DIR__ . '/responses/login.xml'));

        $soapReponse = $this->soapClient->__getLastResponse();
        $response    = new Response($soapReponse);

        $this->assertEquals('veryrandomsessionstring', $response->session());
    }

    public function test_it_extracts_the_session_from_a_data_response(): void
    {
        $this->soapClient->setMockedResponse(file_get_contents(__DIR__ . '/responses/declaraties-perioden.xml'));

        $soapReponse = $this->soapClient->__getLastResponse();
        $response    = new Response($soapReponse);

        $this->assertEquals('veryrandomsessionstring', $response->session());
    }

}
