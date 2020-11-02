<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\SetsExceptionParameters;

class UserLockedOutException extends \Exception
{
    use SetsExceptionParameters;
}
