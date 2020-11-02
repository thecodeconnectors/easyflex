<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

trait SetsExceptionParameters
{
    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @param array $parameters
     *
     * @return $this
     */
    public function setParameters(array $parameters = [])
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

}
