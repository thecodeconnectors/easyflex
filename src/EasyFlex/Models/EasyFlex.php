<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HasFields;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HasAttributes;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\InteractsWithEasyFlex;
use TheCodeConnectors\EasyFlex\EasyFlex\Concerns\TransfersFieldsToEasyFlexFields;

abstract class EasyFlex
{
    use InteractsWithEasyFlex, TransfersFieldsToEasyFlexFields, HasAttributes, HasFields;

    //abstract function get();
    //
    //public function find($id)
    //{
    //
    //}
    //
    //public function create()
    //{
    //
    //}
    //
    //public function update()
    //{
    //
    //}
}
