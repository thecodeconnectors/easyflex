<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class InvalidParameterException extends \InvalidArgumentException
{

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage() . " : " . http_build_query($this->parameters);
    }

}
