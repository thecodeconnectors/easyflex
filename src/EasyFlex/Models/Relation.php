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
     */
    public function details()
    {
        return $this->companyDetails();
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     */
    public function companyDetails()
    {
        return $this->client()->companyDetails();
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\Contact[]|\TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function contacts()
    {
        return $this->client()->contacts();
    }

    /**
     * @param $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\Contact[]|\TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function contact($id)
    {
        return $this->client()->contacts($id);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|\TheCodeConnectors\EasyFlex\EasyFlex\Models\Placement[]
     */
    public function placements()
    {
        return $this->client()->placements();
    }
}
