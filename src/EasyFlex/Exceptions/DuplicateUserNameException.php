<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class DuplicateUserNameException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("Username already exists");
    }
}
