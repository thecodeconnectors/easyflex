<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class RequireChangePasswordException extends \Exception
{
    public function __construct(string $message = null)
    {
        parent::__construct($message ?: 'EasyFlex requires password change');
    }
}
