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

        if (isset($this->rf_decl_uren->item)) {
            foreach ((array)$this->rf_decl_uren->item as $hour) {
                $items[] = new DeclarationHour((array)$hour);
            }
        }

        return new EasyFlexCollection($items);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|\TheCodeConnectors\EasyFlex\EasyFlex\Models\DeclarationMoney[]
     */
    public function money()
    {
        $items = [];

        if (isset($this->rf_decl_vergoedingen->item)) {
            foreach ((array)$this->rf_decl_vergoedingen->item as $compensation) {
                $items[] = new DeclarationMoney((array)$compensation);
            }
        }

        return new EasyFlexCollection($items);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|\TheCodeConnectors\EasyFlex\EasyFlex\Models\DeclarationWithdrawal[]
     */
    public function withdrawals()
    {
        $items = [];

        if (isset($this->rf_decl_opnamen->item)) {
            foreach ((array)$this->rf_decl_opnamen->item as $withdrawal) {
                $items[] = new DeclarationWithdrawal((array)$withdrawal);
            }
        }

        return new EasyFlexCollection($items);
    }

}
