<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationMoney extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'                     => 'rf_decl_geld_idnr',
        'wage_type_id'           => 'rf_decl_lc_idnr',
        'wage_type'              => 'rf_decl_lc_type',
        'wage_type_category'     => 'rf_decl_lc_soort',
        'wage_type_paper_text'   => 'rf_decl_lc_loonslip_tekst',
        'wage_type_invoice_text' => 'rf_decl_lc_factuur_tekst',
        'wage_type_unit'         => 'rf_decl_lc_eenheid',
        'employee_amount'        => 'rf_decl_geld_bedrag_fw',
        'relation_amount'        => 'rf_decl_geld_bedrag_rl',
        'cost_center'            => 'rf_decl_geld_kostenplaats',
        'wage_breakdown_id'      => 'rf_decl_geld_loonspecificatie_idnr',
        'invoice_id'             => 'rf_decl_geld_factuur_idnr',
    ];
}
