<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Client;

trait SetsClient
{
    /**
     * @var array
     */
    protected $client = [];

    /**
     * @param \TheCodeConnectors\EasyFlex\EasyFlex\Client $client
     *
     * @return $this
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return array
     */
    public function getClient()
    {
        return $this->client;
    }

}
