<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class AnnualStatement extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'   => 'fw_jaaropgave_idnr',
        'year' => 'fw_jaaropgave_jaar',
        'file' => 'fw_jaaropgave',
    ];
}


