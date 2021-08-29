<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\Reservations;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\SalarySlip;

trait HandlesEmployeeData
{
    public function reservations(): EasyFlexCollection
    {
        return $this
            ->call('fw_reserveringen')
            ->getResponse()
            ->toCollection(Reservations::class);
    }

    public function salarySlips(): EasyFlexCollection
    {
        return $this
            ->call('fw_loonspecificaties')
            ->getResponse()
            ->toCollection(SalarySlip::class);
    }

    public function salarySlip($id): SalarySlip
    {
        $parameters['fw_loonspecificatie_idnr'] = $id;

        return $this
            ->call('fw_loonspecificaties', $parameters)
            ->getResponse()
            ->toModel(SalarySlip::class);
    }

    public function updateDeclaration($id, array $parameters = []): void
    {
        $parameters['rf_decl_idnr'] = $id;

        $this->call('rf_declaratie_update', $parameters);
    }

    public function updateDeclarationLines($id, array $parameters = []): void
    {
        $parameters['rf_decl_idnr'] = $id;

        $this->call('rf_declaratie_regels_update', $parameters);
    }
}
