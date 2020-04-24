<?php

namespace TheCodeConnectors\EasyFlex\Tests\Mock;

use \SoapFault;
use \SoapClient as Client;

class SoapClient extends Client
{
    /**
     * @var string|array|object|\SoapFault
     */
    protected $response;

    /**
     * @param string|\SoapFault $response the xml response or the SoapFault error
     *
     * @return $this
     */
    public function setMockedResponse($response)
    {
        $this->response = $this->xmlToObject($response);

        return $this;
    }

    /**
     * @param string $function_name
     * @param array  $arguments
     * @param null   $options
     * @param null   $input_headers
     * @param null   $output_headers
     *
     * @return mixed|\SimpleXMLElement[]|string
     * @throws \SoapFault
     */
    public function __soapCall($function_name, $arguments, $options = null, $input_headers = null, &$output_headers = null)
    {
        return $this->__getLastResponse();
    }

    /**
     * @return \SimpleXMLElement[]|null
     * @throws \SoapFault
     */
    public function __getLastResponse()
    {
        if ($this->response instanceof SoapFault) {
            throw $this->response;
        }

        return $this->response;
    }

    /**
     * @param $response
     *
     * @return \SimpleXMLElement[]
     */
    protected function xmlToObject($response)
    {
        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);

        $xml      = new \SimpleXMLElement($response);
        return $xml->xpath('//SOAP-ENV:Body/*[1]'); // gets the first child
    }

}
