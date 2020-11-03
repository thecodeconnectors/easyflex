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

    /**
     * EasyFlex wants some parameters to be wrapped in seperate arrays,
     * where each parameter value is wrapped in a single array with the name in the key:
     *
     * $parameters = [
     *    0 => [$name => 12345],
     *    1 => [$name => 67890],
     * ];
     *
     * @param array $parameters
     * @param       $name
     *
     * @return array[]
     */
    public function toNamedParameters(array $parameters, $name)
    {
        return array_map(function ($parameters) use ($name) {
            return [$name => $parameters];
        }, $parameters);
    }

}
