<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Client;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidAccountTypeException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidPasswordException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidUserNameException;

trait AuthenticatesUsers
{
    public function authenticate(string $userName, string $password, string $accountType): self
    {
        $parameters = [
            'db_inlognaam'  => $userName,
            'db_wachtwoord' => $password,
            'accounttype'   => $this->validateAccountType($accountType),
        ];

        $this->call('wm_inloggen_verify', $parameters, ['fields']);

        return $this;
    }

    public function updateCredentials(string $userName, string $password): self
    {
        $parameters = [
            'db_inlognaam'  => $this->validateUserName($userName),
            'db_wachtwoord' => $this->validatePassword($password),
        ];

        $this->call('wm_inloggen_update', $parameters, ['fields']);

        return $this;
    }

    protected function validateAccountType(string $accountType): string
    {
        $accountTypes = [
            Client::EMPLOYEE,
            Client::RELATION,
        ];

        if (in_array($accountType, $accountTypes, true)) {
            return $accountType;
        }

        throw new InvalidAccountTypeException($accountType);
    }

    public function validateUserName(string $userName): string
    {
        // cannot start with ef_
        // cannot contain spaces
        // min 6 and max 32 characters
        if (stripos($userName, "ef_") === 0
            || strpos($userName, ' ') !== false
            || ! $this->stringLengthIsCorrect($userName, 6, 32)
        ) {
            throw new InvalidUserNameException();
        }

        return $userName;
    }

    public function validatePassword(string $passsword): string
    {
        // must have at least 1 number, 1 letter, 1 special character
        // cannot contain spaces
        // min 6 and max 32 characters
        if ( ! $this->containsRequiredPasswordCharacters($passsword)
            || strpos($passsword, ' ') !== false
            || ! $this->stringLengthIsCorrect($passsword, 8, 32)
        ) {
            throw new InvalidPasswordException();
        }

        return $passsword;
    }

    protected function stringLengthIsCorrect($string, $min = 6, $max = 32): bool
    {
        $length = strlen($string);
        return ($length >= $min && $length <= $max);
    }

    protected function containsRequiredPasswordCharacters($string): bool
    {
        $specials = [
            '!',
            '@',
            '#',
            '$',
            '%',
            '^',
            '&',
            '*',
            '(',
            ')',
            '-',
            '_',
            '+',
            '=',
            '{',
            '}',
            '[',
            ']',
            ':',
            ';',
            '"',
            "'",
            '|',
            '\'',
            '<',
            '>',
            ',',
            '.',
            '?',
            '/',
            '`',
            '~',
            '±',
            '§',
        ];

        return static::contains($string, $specials)
            && preg_match('/[A-Za-z]/', $string)
            && preg_match('/\d/', $string);
    }

    public static function contains(string $haystack, $needles): bool
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}
