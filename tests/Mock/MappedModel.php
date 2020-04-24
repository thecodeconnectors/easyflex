<?php

namespace TheCodeConnectors\EasyFlex\Tests\Mock;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex;

class MappedModel extends EasyFlex
{
    protected $fields = [
        'naam',
    ];

    protected $mappedAttributes = [
        'naam' => 'name',
    ];
}
