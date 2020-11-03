<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Models\User;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Contact;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Placement;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\Declaration;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\DeclarationLine;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\ContactCommunication;
use TheCodeConnectors\EasyFlex\EasyFlex\Models\DeclarationWageComponent;

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
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|Declaration[]
     */
    public function declarations($parameters = []): EasyFlexCollection
    {
        return $this
            ->call('rf_declaraties', $parameters)
            ->getResponse()
            ->toCollection(Declaration::class);
    }

    /**
     * @param array $declarationIds
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|DeclarationLine[]
     */
    public function declarationLines($declarationIds = []): EasyFlexCollection
    {
        $parameters = [
            'rf_decl_idnrs' => $this->toNamedParameters($declarationIds, 'rf_decl_idnr'),
        ];

        return $this
            ->call('rf_declaratie_regels', $parameters)
            ->getResponse()
            ->toCollection(DeclarationLine::class);
    }

    /**
     * @param $declarationId
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|DeclarationWageComponent[]
     */
    public function wageComponents($declarationId)
    {
        $parameters = [
            'rf_decl_idnr' => $declarationId,
        ];

        return $this
            ->call('rf_declaratie_looncomponent', $parameters)
            ->getResponse()
            ->toCollection(DeclarationWageComponent::class);
    }

    /**
     * @param null $id
     * @param int  $status
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|Contact[]
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
     * @param null $contactId
     * @param int  $type
     * @param null $relationId
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|ContactCommunication[]
     */
    public function contactCommunications($contactId = null, $type = ContactCommunication::TYPE_EMAIL, $relationId = null): EasyFlexCollection
    {
        $parameters = [
            'rl_contactpersoon_idnr' => $contactId,
            'wm_com_type'            => $type,
            'rl_relatie_idnr'        => $relationId,
        ];

        return $this
            ->call('rl_contactpersoon_communicatie', array_filter($parameters))
            ->getResponse()
            ->toCollection(ContactCommunication::class);
    }

    /**
     * @param null $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|Placement[]
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

    /**
     * @param $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\Placement|\TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     */
    public function placement($id): Placement
    {
        $parameters = [
            'rl_plaatsing_idnr' => $id,
        ];

        return $this
            ->call('rl_plaatsingen', $parameters)
            ->getResponse()
            ->toModel(Placement::class);
    }

    /**
     * @param null $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection|User[]
     */
    public function users($id = null): EasyFlexCollection
    {
        $parameters = [
            'user_idnr' => $id,
        ];

        return $this
            ->call('user_list', $parameters)
            ->getResponse()
            ->toCollection(User::class);
    }

}
