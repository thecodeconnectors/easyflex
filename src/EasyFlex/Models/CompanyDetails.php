<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class CompanyDetails extends EasyFlex
{
    /**
     * @var string[]
     */
    protected $fields = [
        'relation_number'                              => 'rl_relatienummer',
        'debtors_number'                               => 'rl_debiteurennummer',
        'company_name'                                 => 'rl_bedrijfsnaam',
        'visiting_address_street'                      => 'rl_bezoekadres_straat',
        'visiting_address_housenumber'                 => 'rl_bezoekadres_huisnummer',
        'visiting_address_housenumber_addition'        => 'rl_bezoekadres_huisnummer_toevoeging',
        'visiting_address_postal_code'                 => 'rl_bezoekadres_postcode',
        'visiting_address_place'                       => 'rl_bezoekadres_plaats',
        'visiting_address_country_code'                => 'rl_bezoekadres_land_code',
        'visiting_address_country'                     => 'rl_bezoekadres_land',
        'correspondence_address_street'                => 'rl_correspondentieadres_straat',
        'correspondence_address_house-number'          => 'rl_correspondentieadres_huisnummer',
        'correspondence_address_house-number_addition' => 'rl_correspondentieadres_huisnummer_toevoeging',
        'correspondence_address_postal_code'           => 'rl_correspondentieadres_postcode',
        'correspondence_address_place'                 => 'rl_correspondentieadres_plaats',
        'correspondence_address_country_code'          => 'rl_correspondentieadres_land_code',
        'correspondence_address_country'               => 'rl_correspondentieadres_land',
        'number_chamber_of_commerce'                   => 'rl_nummer_kvk',
        'billing_address_street'                       => 'rl_factuuradres_straat',
        'billing_address_house_number'                 => 'rl_factuuradres_huisnummer',
        'billing_address_house_number_addition'        => 'rl_factuuradres_huisnummer_toevoeging',
        'billing_address_mailbox'                      => 'rl_factuuradres_postbus',
        'billing_address_postal_code'                  => 'rl_factuuradres_postcode',
        'billing_address_postal_code_mailbox'          => 'rl_factuuradres_postcode_postbus',
        'billing_address_place'                        => 'rl_factuuradres_plaats',
        'billing_address_place_mailbox'                => 'rl_factuuradres_plaats_postbus',
        'billing_address_country_code'                 => 'rl_factuuradres_land_code',
        'billing_address_country'                      => 'rl_factuuradres_land',
        'billing_address_contact_id'                   => 'rl_factuuradres_contactpersoon_idnr',
        'billing_address_contact_formal'               => 'rl_factuuradres_contactpersoon_formeel',
        'billing_address_contact_informal'             => 'rl_factuuradres_contactpersoon_informeel',
        'vat_number'                                   => 'rl_btwnummer',
        'bank_account_number'                          => 'rl_bankrekeningnummer',
        'giro_account_number'                          => 'rl_girorekeningnummer',
        'payment_method'                               => 'rl_betaalwijze',
        'relation_manager_id'                          => 'rl_relatiebeheerder_idnr',
        'relation_manager_formal'                      => 'rl_relatiebeheerder_formeel',
        'relation_manager_informal'                    => 'rl_relatiebeheerder_informeel',
        'payment_term'                                 => 'rl_betaaltermijn',
        'location_id'                                  => 'rl_locatie_idnr',
        'location_name'                                => 'rl_locatie_naam',
        'branche_id'                                   => 'rl_branche_idnr',
        'branche'                                      => 'rl_branche',
        'first_workday_notification'                   => 'rl_edm_indienen',
        'contactperson_id'                             => 'rl_contactpersoon_idnr',
        'contactperson_formal'                         => 'rl_contactpersoon_formeel',
        'contactperson_informal'                       => 'rl_contactpersoon_informeel',
    ];
}
