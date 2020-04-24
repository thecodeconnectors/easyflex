<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\Tests\Mock\MappedModel;

class FieldMappingTest extends TestCase
{

    public function test_it_sets_the_original_attribute()
    {
        $model = new MappedModel([
            'naam' => 'martijn',
        ]);

        $this->assertTrue($model->hasAttribute('naam'));
    }

    public function test_it_has_a_mapped_attribute()
    {
        $model = new MappedModel([
            'naam' => 'martijn',
        ]);

        $this->assertTrue($model->hasMappedAttribute('naam'));
        $this->assertEquals('name', $model->getMappedAttributeName('naam'));
    }

    /**
     * @test
     */
    public function it_sets_the_attribute_by_mapped_name()
    {
        $model = new MappedModel([
            'name' => 'martijn',
        ]);

        $this->assertEquals('naam', $model->getMappedAttributeName('name'));
    }

    public function test_it_gets_the_value_by_original_and_mapped_attribute_name()
    {
        $model = new MappedModel([
            'naam' => 'martijn',
        ]);

        $this->assertEquals('martijn', $model->naam);
        $this->assertEquals('martijn', $model->name);
    }

    public function test_it_accepts_the_mapped_key_as_attribute_name()
    {
        $model = new MappedModel([
            'name' => 'martijn',
        ]);

        $this->assertEquals('martijn', $model->name);
        $this->assertEquals('martijn', $model->naam);
    }
}
