<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\EasyFlex\Errors\Error;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException;

class EasyFlexExceptionTest extends TestCase
{
    public function test_it_creates_an_error_message_by_code()
    {
        $message = new Error('39057');

        $this->assertEquals(39057, $message->code());
        $this->assertEquals('Result error (Licentie tag ontbreekt)', $message->message());
        $this->assertEquals('De licentietag ontbreekt.', $message->description());
    }

    public function test_it_sets_the_easy_flex_error()
    {
        $exception = new EasyFlexException('39057');

        $this->assertEquals(39057, $exception->easyFlexCode());
        $this->assertEquals('Result error (Licentie tag ontbreekt)', $exception->easyFlexMessage());
        $this->assertEquals('De licentietag ontbreekt.', $exception->easyFlexDescription());
    }
}
