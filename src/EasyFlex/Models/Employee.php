<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

use TheCodeConnectors\EasyFlex\EasyFlex\Client;

class Employee extends EasyFlex
{
    public $fw_flexwerker_idnr; // int

    public $fw_geslacht; // string

    public $fw_burgerlijke_staat; // string

    public $fw_titel; // string

    public $fw_voorletters; // string

    public $fw_voorvoegsels; // string

    public $fw_achternaam; // string

    public $fw_meisjesnaam_voorvoegsels; // string

    public $fw_meisjesnaam_achternaam; // string

    public $fw_roepnaam; // string

    public $fw_domicilieadres_postcode; // string

    public $fw_domicilieadres_straat; // string

    public $fw_domicilieadres_huisnummer; // int

    public $fw_domicilieadres_huisnummer_toevoeging; // string

    public $fw_domicilieadres_plaats; // string

    public $fw_domicilieadres_land_code; // string

    public $fw_domicilieadres_land; // string

    public $fw_woonadres_postcode; // string

    public $fw_woonadres_straat; // string

    public $fw_woonadres_huisnummer; // int

    public $fw_woonadres_huisnummer_toevoeging; // string

    public $fw_woonadres_plaats; // string

    public $fw_woonadres_land_code; // string

    public $fw_woonadres_land; // string

    public $fw_geboortedatum; // string

    public $fw_geboorteplaats; // string

    public $fw_geboorteland_code; // string

    public $fw_geboorteland; // string

    public $fw_identificatiebewijs; // string

    public $fw_nationaliteit_code; // string

    public $fw_nationaliteit; // string

    public $fw_identificatiebewijs_nummer; // string

    public $fw_identificatiebewijs_geldig_tm; // string

    public $fw_verblijfsvergunning_afgegeven_door; // string

    public $fw_verblijfsvergunning_afgegeven_op; // string

    public $fw_verblijfsvergunning_nummer; // string

    public $fw_verblijfsvergunning_geldig_tm; // string

    public $fw_tewerkstellingsvergunning_afgegeven_door; // string

    public $fw_tewerkstellingsvergunning_afgegeven_op; // string

    public $fw_tewerkstellingsvergunning_nummer; // string

    public $fw_tewerkstellingsvergunning_geldig_tm; // string

    public $fw_rijbewijs; // string

    public $fw_rijbewijs_nummer; // string

    public $fw_rijbewijs_geldig_tm; // string

    public $fw_vervoer_fiets; // string

    public $fw_vervoer_bromfiets; // string

    public $fw_vervoer_motorfiets; // string

    public $fw_vervoer_personenbus; // string

    public $fw_vervoer_personenauto; // string

    public $fw_betaalwijze_1; // string

    public $fw_rekeningnummer_1; // string

    public $fw_betalingskenmerk_1; // string

    public $fw_afwijkende_begunstigde_1_naam; // string

    public $fw_afwijkende_begunstigde_1_plaats; // string

    public $fw_betaalwijze_2; // string

    public $fw_rekeningnummer_2; // string

    public $fw_betalingskenmerk_2; // string

    public $fw_afwijkende_begunstigde_2_naam; // string

    public $fw_afwijkende_begunstigde_2_plaats; // string

    public $fw_sofinummer; // int

    public $fw_burgerservicenummer; // int

    public $fw_relatiebeheerder_idnr; // int

    public $fw_relatiebeheerder_formeel; // string

    public $fw_relatiebeheerder_informeel; // string

    public $fw_locatie_idnr; // int

    public $fw_locatie_naam; // string

    public $fw_identificatie_img; // int

    public $fw_verblijfsvergunning_img; // int

    public $fw_tewerkstellingsvergunning_img; // int

    public $fw_rijbewijs_img; // int

    public $fw_identificatie_image; // base64Binary

    public $fw_verblijfsvergunning_image; // base64Binary

    public $fw_tewerkstellingsvergunning_image; // base64Binary

    public $fw_rijbewijs_image; // base64Binary

    /**
     * @var array
     */
    public $english = [
        'fw_flexwerker_idnr' => 'employee_id',
    ];

    /**
     * @param $userName
     * @param $password
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function login($userName, $password)
    {
        $this->client()->authenticate($userName, $password, Client::EMPLOYEE);
    }

    public function getDetails()
    {
        $this->responseToProperties(
            $this->client()->call('fw_persoonsgegevens')
        );

        return $this;
    }

    protected function responseToProperties(Client $client)
    {
        if($response = $client->getResponse()) {
            $this->fill($response->toArray());
        }
    }

    public function declarations()
    {

    }

}
