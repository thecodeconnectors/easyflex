<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

use TheCodeConnectors\EasyFlex\EasyFlex\Client;

class Employee extends EasyFlex
{
    /**
     * @var array
     */
    public $fields = [
        'id'                                 => 'fw_flexwerker_idnr',
        'sexe'                               => 'fw_geslacht',
        'marital_status'                     => 'fw_burgerlijke_staat',
        'title'                              => 'fw_titel',
        'initials'                           => 'fw_voorletters',
        'prefix'                             => 'fw_voorvoegsels',
        'last_name'                          => 'fw_achternaam',
        'maiden_name_prefix'                 => 'fw_meisjesnaam_voorvoegsels',
        'maiden_name_last_name'              => 'fw_meisjesnaam_achternaam',
        'name'                               => 'fw_roepnaam',
        'file_number'                        => 'fw_dossiernummer',
        'nationaloty_without_state'          => 'fw_nationaliteit_staatloos',
        'domicile_address_street'            => 'fw_domicilieadres_straat',
        'domicile_address_postal_code'       => 'fw_domicilieadres_postcode',
        'domicile_address_house_number'      => 'fw_domicilieadres_huisnummer',
        'domicile_address_addition'          => 'fw_domicilieadres_huisnummer_toevoeging',
        'domicile_address_place'             => 'fw_domicilieadres_plaats',
        'domicile_address_country_code'      => 'fw_domicilieadres_land_code',
        'domicile_address_country'           => 'fw_domicilieadres_land',
        'home_address_postal_code'           => 'fw_woonadres_postcode',
        'home_address_street'                => 'fw_woonadres_straat',
        'home_address_house_number'          => 'fw_woonadres_huisnummer',
        'home_address_house_number_addition' => 'fw_woonadres_huisnummer_toevoeging',
        'home_address_place'                 => 'fw_woonadres_plaats',
        'home_address_country_code'          => 'fw_woonadres_land_code',
        'home_address_country'               => 'fw_woonadres_land',
        'date_of_birth'                      => 'fw_geboortedatum',
        'place_of_birth'                     => 'fw_geboorteplaats',
        'country_of_birth_code'              => 'fw_geboorteland_code',
        'country_of_birth'                   => 'fw_geboorteland',
        'identification'                     => 'fw_identificatiebewijs',
        'nationality_code'                   => 'fw_nationaliteit_code',
        'nationality'                        => 'fw_nationaliteit',
        'identification_number'              => 'fw_identificatiebewijs_nummer',
        'identification_valid_until'         => 'fw_identificatiebewijs_geldig_tm',
        'residence_permit_issued_by'         => 'fw_verblijfsvergunning_afgegeven_door',
        'residence_permit_issued_on'         => 'fw_verblijfsvergunning_afgegeven_op',
        'residence_permit_number'            => 'fw_verblijfsvergunning_nummer',
        'residence_permit_valid_until'       => 'fw_verblijfsvergunning_geldig_tm',
        'work_permit_issued_by'              => 'fw_tewerkstellingsvergunning_afgegeven_door',
        'work_permit_issued_on'              => 'fw_tewerkstellingsvergunning_afgegeven_op',
        'work_permit_number'                 => 'fw_tewerkstellingsvergunning_nummer',
        'work_permit_valid_until'            => 'fw_tewerkstellingsvergunning_geldig_tm',
        'driver_license'                     => 'fw_rijbewijs',
        'driver_license_number'              => 'fw_rijbewijs_nummer',
        'driver_license_valid_until'         => 'fw_rijbewijs_geldig_tm',
        'transport_bike'                     => 'fw_vervoer_fiets',
        'transport_moped'                    => 'fw_vervoer_bromfiets',
        'transport_motorcycle'               => 'fw_vervoer_motorfiets',
        'transport_passenger_bus'            => 'fw_vervoer_personenbus',
        'transport_car'                      => 'fw_vervoer_personenauto',
        'payment_method_1'                   => 'fw_betaalwijze_1',
        'acount_number_1'                    => 'fw_rekeningnummer_1',
        'payment_reference_1'                => 'fw_betalingskenmerk_1',
        'different_beneficiary_1_name'       => 'fw_afwijkende_begunstigde_1_naam',
        'different_beneficiary_1_place'      => 'fw_afwijkende_begunstigde_1_plaats',
        'different_beneficiary_1_country'    => 'fw_afwijkende_begunstigde_1_land',
        'payment_method_2'                   => 'fw_betaalwijze_2',
        'acount_number_2'                    => 'fw_rekeningnummer_2',
        'payment_reference_2'                => 'fw_betalingskenmerk_2',
        'different_beneficiary_2_name'       => 'fw_afwijkende_begunstigde_2_naam',
        'different_beneficiary_2_place'      => 'fw_afwijkende_begunstigde_2_plaats',
        'different_beneficiary_2_country'    => 'fw_afwijkende_begunstigde_2_land',
        'social_security_number'             => 'fw_sofinummer',
        'citizen_service_number'             => 'fw_burgerservicenummer',
        'relation_manager_id'                => 'fw_relatiebeheerder_idnr',
        'relation_manager_formal'            => 'fw_relatiebeheerder_formeel',
        'relation_manager_informal'          => 'fw_relatiebeheerder_informeel',
        'location_id'                        => 'fw_locatie_idnr',
        'location_name'                      => 'fw_locatie_naam',
        'identification_img'                 => 'fw_identificatie_img',
        'identification_image'               => 'fw_identificatie_image',
        'residence_permit_img'               => 'fw_verblijfsvergunning_img',
        'residence_permit_image'             => 'fw_verblijfsvergunning_image',
        'work_permit_image'                  => 'fw_tewerkstellingsvergunning_image',
        'work_permit_img'                    => 'fw_tewerkstellingsvergunning_img',
        'driver_license_img'                 => 'fw_rijbewijs_img',
        'driver_license_image'               => 'fw_rijbewijs_image',
    ];

    /**
     * @param $userName
     * @param $password
     */
    public function login($userName, $password)
    {
        $this->client()->authenticate($userName, $password, Client::EMPLOYEE);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     */
    public function details()
    {
        return $this->client()->personalDetails();
    }
}
