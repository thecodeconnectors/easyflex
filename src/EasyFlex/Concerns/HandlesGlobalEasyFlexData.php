<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Employee;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\CompanyDetails;

/**
 * Trait HandlesRelationData
 *
 * @mixin \TheCodeConnectors\EasyFlex\EasyFlex\Client
 */
trait HandlesGlobalEasyFlexData
{

    /**
     * @param null $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function personalDetails($id = null): EasyFlex
    {
        $parameters = [
            'fw_flexwerker_idnr' => $id,
        ];

        return $this
            ->call('fw_persoonsgegevens', $parameters)
            ->getResponse()
            ->toModel(Employee::class);
    }

    /**
     * @param null $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\EasyFlexException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\RequireChangePasswordException
     * @throws \TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\WebserviceOfflineException
     */
    public function companyDetails($id = null)
    {
        $parameters = [
            'rl_relatie_idnr' => $id,
        ];

        return $this
            ->call('rl_bedrijfsgegevens', $parameters)
            ->getResponse()
            ->toModel(CompanyDetails::class);
    }

}
