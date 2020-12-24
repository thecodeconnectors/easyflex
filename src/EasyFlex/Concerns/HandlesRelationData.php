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
     * @param null $placementId
     * @param null $relationId
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlexCollection
     */
    public function placements($placementId = null, $relationId = null): EasyFlexCollection
    {
        $parameters = [
            'rl_plaatsing_idnr' => $placementId,
            'rl_relatie_idnr'   => $relationId,
        ];

        return $this
            ->call('rl_plaatsingen', array_filter($parameters))
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
     * @param $id
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\User|\TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     */
    public function user($id): User
    {
        $parameters = [
            'user_idnr' => $id,
        ];

        return $this
            ->call('user_list', $parameters)
            ->getResponse()
            ->toModel(User::class);
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

    /**
     * @param array )
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Models\EasyFlex
     */
    public function createUser(array $parameters)
    {
        $creatable = [
            'user_voorletters',
            'user_tussenvoegsels',
            'user_achternaam',
            'ws_user_aantekening',
            'ws_user_beheer',
            'ws_user_persoonsgegevens',
            'ws_user_urendeclaraties',
            'ws_user_decl_invoeren',
            'ws_user_decl_accorderen',
            'ws_user_decl_kostenplaatsen',
        ];

        $parameters = array_intersect_key($parameters, array_combine($creatable, $creatable));

        return $this
            ->call('user_insert', $parameters)
            ->getResponse()
            ->toModel(User::class);
    }

    /**
     * @param \TheCodeConnectors\EasyFlex\EasyFlex\Models\User|int $userOrId
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesRelationData
     */
    public function deleteUser($userOrId)
    {
        $id = $userOrId instanceof User ? $userOrId->user_idnr : $userOrId;

        return $this->call('user_delete', ['user_idnr' => $id]);
    }

    /**
     * @param       $id
     * @param array $parameters
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Concerns\HandlesRelationData
     */
    public function updateUser($id, array $parameters = [])
    {
        $updatable = [
            'user_naam',
            'user_wachtwoord',
            'user_voorletters',
            'user_tussenvoegsels',
            'user_achternaam',
            'ws_user_aantekening',
            'ws_user_beheer',
            'ws_user_persoonsgegevens',
            'ws_user_urendeclaraties',
            'ws_user_decl_invoeren',
            'ws_user_decl_accorderen',
            'ws_user_decl_kostenplaatsen',
        ];

        $parameters              = array_intersect_key($parameters, array_combine($updatable, $updatable));
        $parameters['user_idnr'] = $id;

        if ($userName = $updatable['user_naam'] ?? null) {
            $this->validateUserName($userName);
        }

        if ($password = $updatable['user_wachtwoord'] ?? null) {
            $this->validatePassword($password);
        }

        return $this->call('user_update', $parameters);
    }

}
