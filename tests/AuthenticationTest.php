<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidPasswordException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidUserNameException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidAccountTypeException;

class AuthenticationTest extends EasyFlexSoapClientTest
{

    public function test_it_does_not_accept_a_wrong_account_type(): void
    {
        $this->expectException(InvalidAccountTypeException::class);

        $this->client->authenticate('username', 'password', 'wrong');
    }

    public function test_it_authenticates_a_user(): void
    {
        $this->client->soapClient()->setMockedResponse(file_get_contents(__DIR__ . '/responses/login.xml'));

        $client = $this->client->authenticate('username', 'password', 'relatie');

        $this->assertEquals('veryrandomsessionstring', $client->getSession());
    }

    public function test_updates_the_users_credentials(): void
    {
        $this->client->soapClient()->setMockedResponse(file_get_contents(__DIR__ . '/responses/login-update.xml'));

        $client = $this->client->updateCredentials('new-username', '123abc!@#');

        $this->assertEquals('veryrandomupdatedsessionstring', $client->getSession());
    }

    public function test_it_does_not_accept_a_short_user_name(): void
    {
        $this->expectException(InvalidUserNameException::class);

        $this->client->updateCredentials('12345', '123abc!@#');
    }

    public function test_it_does_not_accept_a_long_user_name(): void
    {
        $this->expectException(InvalidUserNameException::class);

        $this->client->updateCredentials('123456789012345678901234567890123', '123abc!@#');
    }

    public function test_it_does_not_accept_a_user_name_that_starts_with_ef(): void
    {
        $this->expectException(InvalidUserNameException::class);

        $this->client->updateCredentials('ef_username', '123abc!@#');

        $this->client->user()->authenticate();
        $this->client->user()->updateCredentials();
        $this->client->relation()->authenticate();
        $this->client->relation()->updateCredentials();

        $this->client->relation()->contacts();
    }

    public function test_it_does_not_accept_a_user_name_contains_spaces(): void
    {
        $this->expectException(InvalidUserNameException::class);

        $this->client->updateCredentials('user name', '123abc!@#');
    }

    public function test_it_does_not_accept_a_short_password(): void
    {
        $this->expectException(InvalidPasswordException::class);

        $this->client->updateCredentials('new-username', '12345');
    }

    public function test_it_does_not_accept_a_long_password(): void
    {
        $this->expectException(InvalidPasswordException::class);

        $this->client->updateCredentials('new-username', '123456789012345678901234567890123');
    }

    public function test_it_does_not_accept_a_password_contains_spaces(): void
    {
        $this->expectException(InvalidPasswordException::class);

        $this->client->updateCredentials('new-username', 'pass word');
    }

    public function test_it_does_not_accept_a_password_without_a_number(): void
    {
        $this->expectException(InvalidPasswordException::class);

        $this->client->updateCredentials('new-username', 'abc!@#');
    }

    public function test_it_does_not_accept_a_password_without_a_letter(): void
    {
        $this->expectException(InvalidPasswordException::class);

        $this->client->updateCredentials('new-username', '123!@#');
    }

    public function test_it_does_not_accept_a_password_without_a_special_character(): void
    {
        $this->expectException(InvalidPasswordException::class);

        $this->client->updateCredentials('new-username', '123abc');
    }

}
