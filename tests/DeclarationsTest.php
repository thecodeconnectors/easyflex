<?php

namespace TheCodeConnectors\EasyFlex\Tests;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\Declaration;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection;

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

    public function test_it_returns_a_declaration_collection_object()
    {
        $declaration = Declaration::select()->setClient($this->client)->get(123);

        $this->assertInstanceOf(EasyFlexCollection::class, $declaration);
    }

}
