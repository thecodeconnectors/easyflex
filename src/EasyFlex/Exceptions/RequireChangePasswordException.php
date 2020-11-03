<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\SetsClient;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\SetsExceptionParameters;

class RequireChangePasswordException extends \Exception
{
    use SetsExceptionParameters, SetsClient;

    /**
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct($message ?: 'EasyFlex requires password change');
    }
}
