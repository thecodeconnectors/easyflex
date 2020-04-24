<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Exceptions;

use TheCodeConnectors\EasyFlex\EasyFlex\Errors\Error;

/**
 * Class EasyFlexException
 */
class EasyFlexException extends \Exception
{
    /**
     * @var Error
     */
    protected $easyFlexError;

    /**
     * @param string      $code
     * @param string|null $message
     * @param string|null $details
     */
    public function __construct(string $code, string $message = null, string $details = null)
    {
        $this->setEasyFlexError($code, $message, $details);

        parent::__construct($message ?: 'EasyFlex Error');
    }

    /**
     * @param string      $code
     * @param string|null $message
     * @param string|null $details
     *
     * @return $this
     */
    public function setEasyFlexError(string $code, string $message = null, string $details = null): EasyFlexException
    {
        $this->easyFlexError = new Error($code, $message, $details);

        return $this;
    }

    /**
     * @return string
     */
    public function easyFlexCode(): string
    {
        return $this->easyFlexError->code();
    }

    /**
     * @return string
     */
    public function easyFlexMessage(): string
    {
        return $this->easyFlexError->message();
    }

    /**
     * @return string
     */
    public function easyFlexDescription(): string
    {
        return $this->easyFlexError->description();
    }
}
