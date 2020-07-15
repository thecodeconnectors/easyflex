<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class Declaration extends EasyFlex
{
    public const STATUS_OPEN = 0;
    public const STATUS_SUBMITTED = 1;
    public const STATUS_ALL = 2;

    public const PERIOD_TYPE_WEEK = 'week';
    public const PERIOD_TYPE_FOUR_WEEKS = '4-weken';
    public const PERIOD_TYPE_MONTH = 'maand';

    /**
     * @var []
     */
    protected $fields = [
        'id'                                    => 'rf_decl_idnr',
        'year'                                  => 'rf_decl_jaar',
        'period_type'                           => 'rf_decl_periodesoort',
        'period_number'                         => 'rf_decl_periodenr',
        'start_date'                            => 'rf_decl_startdatum',
        'end_date'                              => 'rf_decl_einddatum',
        'status'                                => 'rf_decl_status',
        'status_employee'                       => 'rf_decl_status_fw',
        'status_relation'                       => 'rf_decl_status_rl',
        'ready_employee'                        => 'rf_decl_gereed_fw',
        'ready_relation'                        => 'rf_decl_gereed_rl',
        'comment_employee'                      => 'rf_decl_opmerking_fw',
        'comment_relation'                      => 'rf_decl_opmerking_rl',
        'end_of_work_employee'                  => 'rf_decl_eindewerk_fw',
        'end_of_work_relation'                  => 'rf_decl_eindewerk_rl',
        'overwork_type'                         => 'rf_decl_tvt',
        'default_wage_type_number'              => 'rf_decl_default_lcnr',
        'default_wage_type_percentage_employee' => 'rf_decl_default_lc_percfw',
        'default_wage_type_percentage_relation' => 'rf_decl_default_lc_percrl',
        'default_wage_type_change_employee'     => 'rf_decl_default_lc_wijzig_fw',
        'default_wage_type_change_relation'     => 'rf_decl_default_lc_wijzig_rl',
        'vacancy_id'                            => 'rf_decl_jobnr',
        'vacancy_function'                      => 'rf_decl_job_functie',
        'vacancy_start_date'                    => 'rf_decl_job_startdatum',
        'vacancy_end_date'                      => 'rf_decl_job_einddatum',
        'vacancy_cost_center_number'            => 'rf_decl_job_kostenplaats_nr',
        'vacancy_specification_code'            => 'rf_decl_job_speccode',
        'vacancy_price_group'                   => 'rf_decl_job_premiegroep',
        'employee_id'                           => 'rf_decl_flexwerker_idnr',
        'employee'                              => 'rf_decl_flexwerker',
        'employee_last_name'                    => 'rf_decl_flexwerker_achternaam',
        'relation_id'                           => 'rf_decl_relatie_idnr',
        'relation'                              => 'rf_decl_relatie',
    ];

    /**
     * @param null $ids
     *
     * @return mixed
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
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
    public function whereId($ids = []): Declaration
    {
        $this->parameters['rf_decl_idnrs'] = $ids;

        return $this;
    }

    /**
     * @param int $status
     *
     * @return static
     */
    public function whereStatus($status = Declaration::STATUS_OPEN): Declaration
    {
        $this->parameters['rf_decl_status'] = $status;

        return $this;
    }

    /**
     * @param int $costCentre
     *
     * @return static
     */
    public function whereCostCentre($costCentre = 0): Declaration
    {
        $this->parameters['rf_decl_kostenplaats'] = $costCentre;

        return $this;
    }

    /**
     * @param $date
     *
     * @return static
     */
    public function whereStartDate($date): Declaration
    {
        $this->parameters['rf_declaratie_start_datum'] = date('d-m-Y', strtotime($date));

        return $this;
    }

    /**
     * @param $date
     *
     * @return static
     */
    public function whereEndDate($date): Declaration
    {
        $this->parameters['rf_declaratie_eind_datum'] = date('d-m-Y', strtotime($date));

        return $this;
    }

    /**
     * @param $year
     *
     * @return static
     */
    public function whereYear($year): Declaration
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
    public function wherePeriod($type, $value): Declaration
    {
        $this->parameters['rf_decl_periodesoort'] = $type;
        $this->parameters['rf_decl_periodenr']    = $value;

        return $this;
    }

}
