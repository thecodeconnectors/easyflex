<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class WebserviceOfflineException extends \Exception
{
    public function __construct(string $message = null)
    {
        parent::__construct($message ?: 'EasyFlex webservice offline');
    }
}
