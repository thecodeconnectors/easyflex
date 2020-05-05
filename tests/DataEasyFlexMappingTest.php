<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\Tests\Mock\DummyModel;

class DataEasyFlexMappingTest extends TestCase
{
    public function test_it_transfers_fields_from_easy_flex()
    {
        $model = DummyModel::fromEasyFlex([
            'naam' => 'martijn',
        ]);

        $this->assertTrue($model->hasAttribute('name'));
        $this->assertEquals('martijn', $model->name);
    }

    public function test_it_transfers_fields_to_easy_flex()
    {
        $model = DummyModel::toEasyFlex([
            'name' => 'martijn',
        ]);

        $this->assertTrue($model->hasAttribute('naam'));
        $this->assertEquals('martijn', $model->naam);
    }

}
