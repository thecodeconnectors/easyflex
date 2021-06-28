<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\SalarySlip;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Reservations;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\AnnualStatement;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection;

/**
 * Trait HandlesRelationData
 *
 * @mixin \TheCodeConnectors\EasyFlex\EasyFlex\Client
 */
trait HandlesEmployeeData
{

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function reservations(): EasyFlexCollection
    {
        return $this
            ->call('fw_reserveringen')
            ->getResponse()
            ->toCollection(Reservations::class);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function salarySlips(): EasyFlexCollection
    {
        return $this
            ->call('fw_loonspecificaties')
            ->getResponse()
            ->toCollection(SalarySlip::class);
    }

    /**
     * @param $id
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex|SalarySlip
     */
    public function salarySlip($id): SalarySlip
    {
        $parameters['fw_loonspecificatie_idnr'] = $id;

        return $this
            ->call('fw_loonspecificaties', $parameters)
            ->getResponse()
            ->toModel(SalarySlip::class);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function annualStatements(): EasyFlexCollection
    {
        return $this
            ->call('fw_jaaropgaven')
            ->getResponse()
            ->toCollection(AnnualStatement::class);
    }

    /**
     * @param $id
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex|AnnualStatement
     */
    public function annualStatement($id): AnnualStatement
    {
        $parameters['fw_jaaropgave_idnr'] = $id;

        return $this
            ->call('fw_jaaropgaven', $parameters)
            ->getResponse()
            ->toModel(AnnualStatement::class);
    }


    /**
     * @param       $id
     * @param array $parameters
     */
    public function updateDeclaration($id, array $parameters = [])
    {
        $parameters['rf_decl_idnr'] = $id;

        $this->call('rf_declaratie_update', $parameters);

        // if anything goes wrong we get an exception instead.
    }

    /**
     * @param       $id
     * @param array $parameters
     */
    public function updateDeclarationLines($id, array $parameters = [])
    {
        $parameters['rf_decl_idnr'] = $id;

        $this->call('rf_declaratie_regels_update', $parameters);

        // if anything goes wrong we get an exception instead.
    }

}
