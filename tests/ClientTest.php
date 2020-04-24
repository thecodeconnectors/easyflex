<?php

namespace TheCodeConnectors\EasyFlex\Tests;

class ClientTest extends EasyFlexSoapClientTest
{
    public function test_it_sets_the_wsdl(): void
    {
        $this->client->setWsdl('https://www.probablywonthappen.com');

        $this->assertEquals('https://www.probablywonthappen.com', $this->client->getWsdl());
    }

    public function test_it_sets_the_licence(): void
    {
        $this->client->setLicense('123');

        $this->assertEquals('123', $this->client->getLicense());
    }

}
