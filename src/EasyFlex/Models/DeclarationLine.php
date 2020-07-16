<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationLine extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'declaration_id' => 'rf_decl_idnr',
        'hours'          => 'rf_decl_uren',
        'compensation'   => 'rf_decl_vergoedingen',
        'withdrawal'     => 'rf_decl_opnamen',
    ];
}
