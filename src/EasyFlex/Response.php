<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection;

class Response
{
    /**
     * @var array|object|null
     */
    protected $soapResponse;

    /**
     * @var \TheCodeConnectors\EasyFlex\EasyFlex\Client|null
     */
    protected $client;

    /**
     * @param null                                             $soapResponse
     * @param \TheCodeConnectors\EasyFlex\EasyFlex\Client|null $client
     */
    public function __construct($soapResponse = null, Client $client = null)
    {
        $this->soapResponse = $soapResponse;
        $this->client       = $client;
    }

    /**
     * @return object
     */
    public function raw()
    {
        return $this->soapResponse;
    }

    /**
     * @return array
     * @throws \JsonException
     */
    public function toArray()
    {
        return json_decode($this->toJson(), 1, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return false|string
     * @throws \JsonException
     */
    public function toJson()
    {
        return json_encode((array)$this->soapResponse, JSON_THROW_ON_ERROR, 512);
    }

    /**
     * @return mixed
     */
    public function session()
    {
        $response = is_array($this->soapResponse) ? $this->soapResponse[0] : $this->soapResponse;

        if (isset($response->fields, $response->fields->session)) {
            // when we authenticate or update login details we get the session in the fields attribute
            return $response->fields->session;
        }

        // when we get any other response, the session is in the session attribute
        return $response->session ?? null;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        $response = is_array($this->soapResponse) ? $this->soapResponse[0] : $this->soapResponse;

        if (isset($response->fields, $response->fields->item)) {
            return (array)$response->fields->item;
        }

        if (isset($response->fields)) {
            return (array)$response->fields;
        }

        return [];
    }

    /**
     * @param $className
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     */
    public function toModel($className): Models\EasyFlex
    {
        $attributes = $this->attributes();

        return new $className($attributes);
    }

    /**
     * @param $className
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function toCollection($className): EasyFlexCollection
    {
        $items      = [];
        $attributes = $this->attributes();

        if ( ! isset($attributes[0])) {
            // dealing with a single record
            return new EasyFlexCollection([(new $className((array)$attributes))->setClient($this->client)]);
        }

        foreach ($attributes as $item) {
            $items[] = (new $className((array)$item))->setClient($this->client);
        }

        return new EasyFlexCollection($items);
    }

}
