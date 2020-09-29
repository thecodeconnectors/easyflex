<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use App\Models\EasyFlex\Declaration\Declaration;
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
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
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
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
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
     *
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function updateDeclarationLines($id, array $parameters = [])
    {
        $parameters['rf_decl_idnr'] = $id;

        $this->call('rf_declaratie_regels_update', $parameters);

        // if anything goes wrong we get an exception instead.
    }

}
