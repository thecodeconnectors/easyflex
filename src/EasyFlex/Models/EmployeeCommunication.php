<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class EmployeeCommunication extends EasyFlex
{
    /**
     * @var array
     */
    public $fields = [
        'type'     => 'wm_communicatie_type',
        'way'      => 'wm_communicatie_middel',
        'data'     => 'wm_communicatie_gegeven',
        'addition' => 'wm_communicatie_aanvulling',
    ];
}
