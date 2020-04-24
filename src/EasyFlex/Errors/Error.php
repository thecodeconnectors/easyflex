<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Errors;

/**
 * Class Error
 */
class Error
{
    /**
     * @var
     */
    protected $code;

    /**
     * @var mixed|string|null
     */
    protected $message = '';

    /**
     * @var mixed|string|null
     */
    protected $description = '';

    /**
     * @param             $code
     * @param string|null $message
     * @param string|null $details
     */
    public function __construct($code, string $message = null, string $details = null)
    {
        $this->code        = $code;
        $errorMessage      = Messages::by_code($code);

        $this->message     = $message ?: $errorMessage['message'] ?? '';
        $this->description = $details ?: $errorMessage['description'] ?? '';
    }

    /**
     * @return mixed
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

}
