<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class ContactCommunication extends EasyFlex
{
    public const TYPE_FROM_CONVERSION = 20010;
    public const TYPE_SKYPE = 20013;
    public const TYPE_PHONE_NAME = 20014;
    public const TYPE_PHONE = 20015;
    public const TYPE_MOBILE = 20016;
    public const TYPE_EMAIL = 20017;
    public const TYPE_WEBSITE = 20018;
    public const TYPE_FAX = 20019;

    /**
     * @var []
     */
    protected $fields = [
        'type'    => 'rl_contactpersoon_communicatie_type',
        'status'  => 'rl_contactpersoon_communicatie_middel',
        'value'   => 'rl_contactpersoon_communicatie_gegeven',
        'remarks' => 'rl_contactpersoon_communicatie_aanvulling',
    ];

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\ContactCommunication[]|\TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function get()
    {
        return $this->client()->contactCommunications($this->parameters);
    }
}
