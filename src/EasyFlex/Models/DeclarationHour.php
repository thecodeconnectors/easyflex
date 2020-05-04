<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationHour extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'                            => 'rf_decl_uur_idnr',
        'date'                          => 'rf_decl_uur_datum',
        'wage_type_id'                  => 'rf_decl_lc_idnr',
        'wage_type'                     => 'rf_decl_lc_type',
        'wage_type_category'            => 'rf_decl_lc_soort',
        'wage_type_paper_text'          => 'rf_decl_lc_loonslip_tekst',
        'wage_type_invoice_text'        => 'rf_decl_lc_factuur_tekst',
        'wage_type_percentage_employee' => 'rf_decl_lc_percentage_fw',
        'wage_type_percentage_relation' => 'rf_decl_lc_percentage_rl',
        'wage'                          => 'rf_decl_uur_uurloon',
        'rate'                          => 'rf_decl_uur_tarief',
        'amount_relation'               => 'rf_decl_uur_aantal_rl',
        'amount_employee'               => 'rf_decl_uur_aantal_fw',
        'hour_cost_center'              => 'rf_decl_uur_kostenplaats',
        'wage_breakdown_id'             => 'rf_decl_uur_loonspecificatie_idnr',
        'invoice_id'                    => 'rf_decl_uur_factuur_idnr',
    ];
}
