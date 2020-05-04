<?php

namespace TheCodeConnectors\EasyFlex\Tests\Mock;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex;
use TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData;

class DummyModel extends EasyFlex implements TransfersEasyFlexData
{
    /**
     * @var []
     */
    protected $fields = [
        'name' => 'naam',
    ];
}
