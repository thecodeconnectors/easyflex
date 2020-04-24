<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use \SoapClient;
use TheCodeConnectors\EasyFlex\EasyFlex\Client;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex;

/**
 * Trait InteractsWithEasyFlex
 */
trait InteractsWithEasyFlex
{
    /**
     * @var
     */
    protected $client;

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @param \TheCodeConnectors\EasyFlex\EasyFlex\Client $client
     *
     * @return $this
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return $this
     */
    public function setFields(array $fields = [])
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param string $license
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Client
     */
    public function client($license = '')
    {
        if ( ! $this->client) {
            $this->client = new Client($license);
        }

        return $this->client;
    }

    /**
     * @param array $fields
     *
     * @return EasyFlex|static
     */
    public static function select($fields = [])
    {
        $instance = new static;

        $instance->setFields($fields);

        return $instance;
    }

    /**
     * @return array
     */
    public function parameters()
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function fields()
    {
        return $this->fields;
    }

}
