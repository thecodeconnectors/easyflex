<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationCostsCenter extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'           => 'rl_kostenplaats_idnr',
        'relation_id'  => 'rl_kostenplaats_rlnr',
        'company_name' => 'rl_kostenplaats_bedrijfsnaam',
        'code'         => 'rl_kostenplaats_code',
        'name'         => 'rl_kostenplaats_naam',
        'status'       => 'rl_kostenplaats_status',
        'amount'       => 'rf_decl_aantal',
    ];
}
