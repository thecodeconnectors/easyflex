<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationLine extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'         => 'fw_declaratie_regel_idnr',
        'date'       => 'fw_declaratie_datum',
        'start_time' => 'fw_declaratie_starttijd',
        'end_time'   => 'fw_declaratie_eindtijd',
        'hour_type'  => 'fw_declaratie_urensoort',
    ];
}
