<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Reservations extends EasyFlex
{
    public const WAGE_TYPE_HOLIDAYS = 'vakantiedagen';

    /**
     * @var array
     */
    public $fields = [
        'specification_code'   => 'fw_res_speccode',
        'price_group'          => 'fw_res_premiegroep',
        'wage_type_id'         => 'fw_res_lc_idnr',
        'wage_type'            => 'fw_res_lc_soort',
        'wage_type_paper_text' => 'fw_res_lc_loonslip_tekst',
        'storage_number'       => 'fw_res_opslagnr',
        'storage_name'         => 'fw_res_opslagnaam',
        'balance_money'        => 'fw_res_saldo_geld',
        'balance_time'         => 'fw_res_saldo_tijd',
    ];
}
