<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class InvalidPasswordException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("password is not valid. It must contain 1 number and one letter and one special character, cannot contain spaces, and must be between 6 and 32 characters long");
    }
}
