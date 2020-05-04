<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\Tests\Mock\DummyModel;

class AttributesTest extends TestCase
{
    public function test_it_fills_the_attributes_from_fill()
    {
        $model = new DummyModel();

        $model->fill([
            'naam' => 'martijn',
        ]);

        $this->assertTrue($model->hasAttribute('naam'));
        $this->assertEquals('martijn', $model->naam);
    }

}
