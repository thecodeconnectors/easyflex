<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Contact extends EasyFlex
{
    const STATUS_ACTIVE = 26880;
    const STATUS_PASSIVE = 26881;

    /**
     * @return mixed|\TheCodeConnectors\EasyFlex\EasyFlex\Client
     */
    public function get()
    {
        return $this->client()->contacts($this->parameters);
    }
}
