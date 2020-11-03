<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\Reservations;
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
     * @param       $id
     * @param array $parameters
     */
    public function updateDeclaration($id, array $parameters = [])
    {
        $parameters['rf_decl_idnr'] = $id;

        $this->call('rf_declaratie_update', $parameters);

        // if anything goes wrong we get an exception instead.s
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
