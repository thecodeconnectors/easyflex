<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Registration extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'location'               => 'wm_inschrijving_locatie',
        'sexe'                   => 'wm_inschrijving_geslacht',
        'marital_status'         => 'wm_inschrijving_burgerlijkestaat',
        'initials'               => 'wm_inschrijving_voorletters',
        'name'                   => 'wm_inschrijving_roepnaam',
        'prefixes'               => 'wm_inschrijving_voorvoegsels',
        'lastname'               => 'wm_inschrijving_achternaam',
        'girl_prefixes'          => 'wm_inschrijving_meisjes_voorvoegsels;',
        'address'                => 'wm_inschrijving_adres',
        'house_number'           => 'wm_inschrijving_huisnummer',
        'house_number_addition'  => 'wm_inschrijving_huisnummer_tvg',
        'postal_code'            => 'wm_inschrijving_postcode',
        'country_code'           => 'wm_inschrijving_landcode',
        'choice_reason'          => 'wm_inschrijving_keuze_reden',
        'choice_before'          => 'wm_inschrijving_keuze_voorheen',
        'choice_know_from'       => 'wm_inschrijving_keuze_kent_van',
        'date_of_birth'          => 'wm_inschrijving_geboortedatum',
        'country_of_birth_code'  => 'wm_inschrijving_geboortelandcode',
        'place_of_birth'         => 'wm_inschrijving_geboorteplaats',
        'citizen_service_number' => 'wm_inschrijving_burgerservicenummer',
        'email'                  => 'wm_inschrijving_email',
        'phone'                  => 'wm_inschrijving_telefoon',
        'mobile'                 => 'wm_inschrijving_mobiel',
        'drivers_license_a1'     => 'wm_inschrijving_rijbewijs_a1',
        'drivers_license_a2'     => 'wm_inschrijving_rijbewijs_a2',
        'drivers_license_b'      => 'wm_inschrijving_rijbewijs_b',
        'drivers_license_c'      => 'wm_inschrijving_rijbewijs_c',
        'drivers_license_d'      => 'wm_inschrijving_rijbewijs_d',
        'drivers_license_eb'     => 'wm_inschrijving_rijbewijs_eb',
        'drivers_license_ec'     => 'wm_inschrijving_rijbewijs_ec',
        'drivers_license_ed'     => 'wm_inschrijving_rijbewijs_ed',
        'drivers_license_am'     => 'wm_inschrijving_rijbewijs_am',
        'education'              => 'wm_inschrijving_opleidingen',
        'skills'                 => 'wm_inschrijving_vaardigheden',
        'work_experience'        => 'wm_inschrijving_werkervaringen',
        'resume_filename'        => 'wm_inschrijving_cv_bestandsnaam',
        'resume'                 => 'wm_inschrijving_cv',
        'photo'                  => 'wm_inschrijving_foto',
        'comment'                => 'wm_inschrijving_opmerking',
    ];
}
