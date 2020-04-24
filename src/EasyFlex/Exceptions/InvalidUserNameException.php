<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class InvalidUserNameException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("Username is not valid. It can not start with ef_, cannot contain spaces, and must be between 6 and 32 characters long");
    }
}
