<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Declaration extends EasyFlex
{
    const STATUS_OPEN = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_ALL = 2;

    const PERIOD_TYPE_WEEK = 'week';
    const PERIOD_TYPE_FOUR_WEEKS = '4-weken';
    const PERIOD_TYPE_MONTH = 'maand';

    /**
     * @param null $ids
     *
     * @return mixed|\TheCodeConnectors\EasyFlex\EasyFlex\Client
     */
    public function get($ids = null)
    {
        if ($ids) {
            $this->whereId((array)$ids);
        }

        return $this->client()->declarations($this->parameters);
    }

    /**
     * @param array $ids
     *
     * @return static
     */
    public function whereId($ids = [])
    {
        $this->parameters['rf_decl_idnrs'] = $ids;

        return $this;
    }

    /**
     * @param int $status
     *
     * @return static
     */
    public function whereStatus($status = Declaration::STATUS_OPEN)
    {
        $this->parameters['rf_decl_status'] = $status;

        return $this;
    }

    /**
     * @param int $costCentre
     *
     * @return static
     */
    public function whereCostCentre($costCentre = 0)
    {
        $this->parameters['rf_decl_kostenplaats'] = $costCentre;

        return $this;
    }

    /**
     * @param $date
     *
     * @return static
     */
    public function whereStartDate($date)
    {
        $this->parameters['rf_declaratie_start_datum'] = date('d-m-Y', strtotime($date));

        return $this;
    }

    /**
     * @param $date
     *
     * @return static
     */
    public function whereEndDate($date)
    {
        $this->parameters['rf_declaratie_eind_datum'] = date('d-m-Y', strtotime($date));

        return $this;
    }

    /**
     * @param $year
     *
     * @return static
     */
    public function whereYear($year)
    {
        $this->parameters['rf_decl_jaar'] = date('Y', strtotime($year));

        return $this;
    }

    /**
     * @param $type
     * @param $value
     *
     * @return static
     */
    public function wherePeriod($type, $value)
    {
        $this->parameters['rf_decl_periodesoort'] = $type;
        $this->parameters['rf_decl_periodenr']    = $value;

        return $this;
    }

}
