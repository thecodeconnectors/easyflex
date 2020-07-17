<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class DeclarationLine extends EasyFlex
{
    /**
     * @var []
     */
    protected $fields = [
        'declaration_id' => 'rf_decl_idnr',
        'hours'          => 'rf_decl_uren',
        'compensation'   => 'rf_decl_vergoedingen',
        'withdrawal'     => 'rf_decl_opnamen',
    ];

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|\TheCodeConnectors\EasyFlex\EasyFlex\Models\DeclarationHour[]
     */
    public function hours()
    {
        $items = [];

        foreach ((array)$this->hours as $hour) {
            $items[] = new DeclarationHour($hour);
        }

        return new EasyFlexCollection($items);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|\TheCodeConnectors\EasyFlex\EasyFlex\Models\DeclarationMoney[]
     */
    public function money()
    {
        $items = [];

        foreach ((array)$this->compensation as $compensation) {
            $items[] = new DeclarationMoney($compensation);
        }

        return new EasyFlexCollection($items);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|\TheCodeConnectors\EasyFlex\EasyFlex\Models\DeclarationWithdrawal[]
     */
    public function withdrawals()
    {
        $items = [];

        foreach ((array)$this->withdrawal as $withdrawal) {
            $items[] = new DeclarationWithdrawal($withdrawal);
        }

        return new EasyFlexCollection($items);
    }

}
