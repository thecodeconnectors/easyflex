<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\Declaration;

class DeclarationsTest extends EasyFlexSoapClientTest
{
    public function test_it_selects_without_any_parameters()
    {
        $builder = Declaration::select();
        $this->assertEquals([], $builder->parameters());
    }

    public function test_it_selects_by_id_or_ids()
    {
        $builder = Declaration::select()->whereId(123);
        $this->assertEquals(['rf_decl_idnrs' => 123], $builder->parameters());

        $builder = Declaration::select()->whereId([123, 456]);
        $this->assertEquals(['rf_decl_idnrs' => [123, 456]], $builder->parameters());
    }

    public function test_it_returns_a_declaration_object()
    {
        $declaration = Declaration::select()->setClient($this->client)->get(123);

        $this->assertInstanceOf(Declaration::class, $declaration);
    }

    public function test_it_gets_a_declaration_by_id()
    {
        $mock = \Mockery::mock($this->client);

        $mock->shouldReceive('declarations')
            ->andReturn(new Declaration(['rf_decl_idnr' => 123]));

        $declaration = Declaration::select()->setClient($mock)->get(123);

        $this->assertEquals(123, $declaration->rf_decl_idnr);
    }

}
