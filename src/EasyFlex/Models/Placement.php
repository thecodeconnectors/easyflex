<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Placement extends EasyFlex
{
    public const HAS_DECLARATIONS_NO = 'nee';
    public const HAS_DECLARATIONS_YES = 'ja';

    /**
     * @var array
     */
    public $fields = [
        'id'                                => 'rl_plaatsing_idnr',
        'employee_id'                       => 'rl_plaatsing_flexwerker_idnr',
        'employee_name'                     => 'rl_plaatsing_flexwerker_naam',
        'relation_id'                       => 'rl_plaatsing_relatie_idnr',
        'start_date'                        => 'rl_plaatsing_startdatum',
        'end_date'                          => 'rl_plaatsing_einddatum',
        'end_date_status'                   => 'rl_plaatsing_einddatum_status',
        'job_title'                         => 'rl_plaatsing_functienaam',
        'job_id'                            => 'rl_plaatsing_functie_idnr',
        'kind_of_work'                      => 'rl_plaatsing_soortwerk',
        'hours_a_week'                      => 'rl_plaatsing_uren_per_week',
        'working_hours'                     => 'rl_plaatsing_werktijden',
        'has_declarations'                  => 'rl_plaatsing_declaraties',
        'activities'                        => 'rl_plaatsing_werkzaamheden',
        'remarks'                           => 'rl_plaatsing_bijzonderheden',
        'different_billing_address_id'      => 'rl_plaatsing_afwijkend_factuuradres_idnr',
        'reporting_address_id'              => 'rl_plaatsing_meldadres_idnr',
        'report_to_contact_person_id'       => 'rl_plaatsing_melden_bij_contactpersoon_idnr',
        'report_to_contact_person_formal'   => 'rl_plaatsing_melden_bij_contactpersoon_formeel',
        'report_to_contact_person_informal' => 'rl_plaatsing_melden_bij_contactpersoon_informeel',
        'cost_center_id'                    => 'rl_plaatsing_kostenplaats_idnr',
        'cost_center'                       => 'rl_plaatsing_kostenplaats',
        'accessibility'                     => 'rl_plaatsing_bereikbaarheid',
        'request_id'                        => 'rl_plaatsing_aanvraag_idnr',
    ];
}
