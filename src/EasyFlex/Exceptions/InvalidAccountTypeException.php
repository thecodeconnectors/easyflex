<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

class InvalidAccountTypeException extends \InvalidArgumentException
{
    /**
     * @param $accountType
     */
    public function __construct($accountType)
    {
        parent::__construct("$accountType is not a valid type, use only 'flexwerker' or 'relatie");
    }

}
