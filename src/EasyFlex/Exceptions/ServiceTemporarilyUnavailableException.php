<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class ServiceTemporarilyUnavailableException extends \Exception
{
    public function __construct(string $message = null)
    {
        parent::__construct($message ?: 'EasyFlex Service Temporarily Unavailable');
    }
}
