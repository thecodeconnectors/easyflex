<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationWithdrawal extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'id'                   => 'rf_decl_opn_idnr',
        'specification_code'   => 'rf_decl_opn_speccode',
        'prize_group'          => 'rf_decl_opn_premiegroep',
        'wage_type_id'         => 'rf_decl_lc_idnr',
        'wage_type'            => 'rf_decl_lc_type',
        'wage_type_category'   => 'rf_decl_lc_soort',
        'wage_type_paper_text' => 'rf_decl_lc_loonslip_tekst',
        'money'                => 'rf_decl_opn_geld',
        'time'                 => 'rf_decl_opn_tijd',
        'wage_breakdown_id'    => 'rf_decl_opn_loonspecificatie_idnr',
    ];
}
