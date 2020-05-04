<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\Contact;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Placement;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Declaration;

/**
 * Trait HandlesRelationData
 *
 * @mixin \TheCodeConnectors\EasyFlex\EasyFlex\Client
 */
trait HandlesRelationData
{

    /**
     * @param array $parameters
     *
     * @return mixed
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function declarations($parameters = []): EasyFlex
    {
        return $this
            ->call('rf_declaraties', $parameters)
            ->getResponse()
            ->toModel(Declaration::class);
    }

    /**
     * @param null $id
     * @param int  $status
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function contacts($id = null, $status = Contact::STATUS_ACTIVE): EasyFlex
    {
        $parameters = [
            'rl_contactpersoon_idnr'   => $id,
            'rl_contactpersoon_status' => $status,
        ];

        return $this
            ->call('rl_contactpersoon', $parameters)
            ->getResponse()
            ->toModel(Contact::class);
    }

    /**
     * @param null $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function placements($id = null): EasyFlex
    {
        $parameters = [
            'rl_plaatsing_idnr' => $id,
        ];

        return $this
            ->call('rl_plaatsingen', $parameters)
            ->getResponse()
            ->toModel(Placement::class);
    }

}
