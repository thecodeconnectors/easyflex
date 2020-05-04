<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationPeriods extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'year'       => 'rf_decl_jaar',
        'type'       => 'rf_decl_periodesoort',
        'number'     => 'rf_decl_periodenr',
        'start_date' => 'rf_decl_startdatum',
        'end_date'   => 'rf_decl_einddatum',
        'amount'     => 'rf_decl_aantal',
    ];
}
