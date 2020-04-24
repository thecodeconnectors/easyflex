<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Relation extends EasyFlex
{

    public function companyDetails()
    {

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
