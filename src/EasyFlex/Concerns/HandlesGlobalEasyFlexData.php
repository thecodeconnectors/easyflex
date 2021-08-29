<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Employee;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\CompanyDetails;

trait HandlesGlobalEasyFlexData
{
    public function personalDetails($id = null, array $fields = []): EasyFlex
    {
        $parameters = [
            'fw_flexwerker_idnr' => $id,
        ];

        return $this
            ->call('fw_persoonsgegevens', $parameters, $fields)
            ->getResponse()
            ->toModel(Employee::class);
    }

    public function companyDetails($id = null): EasyFlex
    {
        $parameters = [
            'rl_relatie_idnr' => $id,
        ];

        return $this
            ->call('rl_bedrijfsgegevens', $parameters)
            ->getResponse()
            ->toModel(CompanyDetails::class);
    }

    public function toNamedParameters(array $parameters, string $name): array
    {
        // EasyFlex wants some parameters to be wrapped in seperate arrays,
        // where each parameter value is wrapped in a single array with the name in the key:
        // $parameters = [
        //     0 => [$name => 12345],
        //     1 => [$name => 67890],
        // ];
        return array_map(function ($parameters) use ($name) {
            return [$name => $parameters];
        }, $parameters);
    }

}
