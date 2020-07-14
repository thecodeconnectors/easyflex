<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\Contact;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection;
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
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function declarations($parameters = []): EasyFlexCollection
    {
        return $this
            ->call('rf_declaraties', $parameters)
            ->getResponse()
            ->toCollection(Declaration::class);
    }

    /**
     * @param null $id
     * @param int  $status
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function contacts($id = null, $status = Contact::STATUS_ACTIVE): EasyFlexCollection
    {
        $parameters = [
            'rl_contactpersoon_idnr'   => $id,
            'rl_contactpersoon_status' => $status,
        ];

        return $this
            ->call('rl_contactpersoon', $parameters)
            ->getResponse()
            ->toCollection(Contact::class);
    }

    /**
     * @param null $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function placements($id = null): EasyFlexCollection
    {
        $parameters = [
            'rl_plaatsing_idnr' => $id,
        ];

        return $this
            ->call('rl_plaatsingen', $parameters)
            ->getResponse()
            ->toCollection(Placement::class);
    }

}
