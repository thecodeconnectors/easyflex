<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

use TheCodeConnectors\EasyFlex\EasyFlex\Client;

class Relation extends EasyFlex
{
    /**
     * @param $userName
     * @param $password
     */
    public function login($userName, $password)
    {
        $this->client()->authenticate($userName, $password, Client::RELATION);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function details()
    {
        return $this->companyDetails();
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function companyDetails()
    {
        return $this->client()->companyDetails();
    }

    public function contacts()
    {
        return $this->client()->contacts();
    }

    public function contact($id)
    {
        return $this->client()->contacts($id);
    }

    public function placements()
    {
        return $this->client()->placements();
    }

    public function declarations()
    {

    }

}
