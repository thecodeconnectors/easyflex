<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Contact extends EasyFlex
{
    public const STATUS_ACTIVE = 26880;
    public const STATUS_PASSIVE = 26881;

    /**
     * @var []
     */
    protected $fields = [
        'id'                    => 'rl_contactpersoon_idnr',
        'status'                => 'rl_contactpersoon_status',
        'sexe'                  => 'rl_contactpersoon_geslacht',
        'title'                 => 'rl_contactpersoon_titel',
        'initials'              => 'rl_contactpersoon_voorletters',
        'prefixes'              => 'rl_contactpersoon_voorvoegsels',
        'last_name'             => 'rl_contactpersoon_achternaam',
        'maiden_prefixes'       => 'rl_contactpersoon_meisjes_voorvoegsels',
        'maiden_last_name'      => 'rl_contactpersoon_meisjes_achternaam',
        'address'               => 'rl_contactpersoon_adres',
        'house_number'          => 'rl_contactpersoon_huisnummer',
        'house_number_addition' => 'rl_contactpersoon_huisnummer_toevoeging',
        'postal_code'           => 'rl_contactpersoon_postcode',
        'place'                 => 'rl_contactpersoon_plaats',
        'country_code'          => 'rl_contactpersoon_land_code',
        'country'               => 'rl_contactpersoon_land',
    ];

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function get()
    {
        return $this->client()->contacts($this->parameters);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->rl_contactpersoon_status === self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isPassive(): bool
    {
        return $this->rl_contactpersoon_status === self::STATUS_PASSIVE;
    }

    /**
     * @param int $type
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function communication($type = ContactCommunication::TYPE_EMAIL)
    {
        return $this->client()->contactCommunications($this->rl_contactpersoon_idnr, $type);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function email()
    {
        return $this->communication();
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function phone()
    {
        return $this->communication(ContactCommunication::TYPE_PHONE);
    }

}
