<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class SalarySlip extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'         => 'fw_loonspecificatie_idnr',
        'year'       => 'fw_loonspecificatie_jaar',
        'number'     => 'fw_loonspecificatie_nummer',
        'period'     => 'fw_loonspecificatie_periode',
        'pay_period' => 'fw_loonspecificatie_loontijdvak',
        'created_at' => 'fw_loonspecificatie_aangemaakt_op',
        'file'       => 'fw_loonspecificatie', // only when id is given
    ];
}


