<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\EasyFlex\Client;
use TheCodeConnectors\EasyFlex\Tests\Mock\SoapClient;

abstract class EasyFlexSoapClientTest extends TestCase
{
    /**
     * @var \TheCodeConnectors\EasyFlex\EasyFlex\Client
     */
    protected $client;

    /**
     * @throws \SoapFault
     */
    protected function setUp(): void
    {
        parent::setUp();

        $wsdl = __DIR__ . '/../wsdl/wsdl.tpsp';

        $this->client = new Client('', new SoapClient($wsdl, ['cache_wsdl' => WSDL_CACHE_NONE]));
        $this->client->setWsdl($wsdl);
    }
}
