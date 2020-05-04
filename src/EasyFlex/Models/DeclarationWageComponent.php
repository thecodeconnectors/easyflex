<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationWageComponent extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'                             => 'rf_decl_lc_idnr',
        'wage_type'                      => 'rf_decl_lc_type',
        'wage_type_category'             => 'rf_decl_lc_soort',
        'wage_type_paper_text'           => 'rf_decl_lc_loonslip_tekst',
        'wage_type_billing_text'         => 'rf_decl_lc_fcatuur_tekst',
        'wage_type_unit'                 => 'rf_decl_lc_eenheid',
        'wage_type_percentage_employee'  => 'rf_decl_lc_percentage_fw',
        'wage_type_percentage_relation'  => 'rf_decl_lc_percentage_rl',
        'wage_type_hourly_wage'          => 'rf_decl_lc_uurloon',
        'wage_type_tariff'               => 'rf_decl_lc_tarief',
        'wage_type_explanation–relation' => 'rf_decl_lc_toelichting_rl',
        'wage_type_name_short'           => 'rf_decl_lc_naam_kort_rl',
        'wage_type_explanation_employee' => 'rf_decl_lc_toelichting_fw',
        'wage_type_name_short_employee'  => 'rf_decl_lc_naam_kort_fw',
        'wage_type_change_relation'      => 'rf_decl_lc_wijzig_rl',
        'wage_type_change_employee'      => 'rf_decl_lc_wijzig_fw',
    ];
}
