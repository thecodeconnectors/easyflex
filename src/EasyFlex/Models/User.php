<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Models;

class User extends EasyFlex
{
    public const PERMISSION_ALLOW = 1;
    public const PERMISSION_DISALLOW = 0;

    /**
     * @var []
     */
    protected $fields = [
        'id'                  => 'user_idnr',
        'user_name'           => 'user_naam',
        'password'            => 'user_wachtwoord',
        'initials'            => 'user_voorletters',
        'insertion'           => 'user_tussenvoegsels',
        'last_name'           => 'user_achternaam',
        'note'                => 'ws_user_aantekening',
        'management'          => 'ws_user_beheer',
        'personal_data'       => 'ws_user_persoonsgegevens',
        'declarations'        => 'ws_user_urendeclaraties',
        'declaration_set'     => 'ws_user_decl_invoeren',
        'declaration_approve' => 'ws_user_decl_accorderen',
    ];

    /**
     * @return bool
     */
    public function canManageUsers()
    {
        return $this->ws_user_beheer === self::PERMISSION_ALLOW;
    }

    /**
     * @return bool
     */
    public function canSeePersonalData()
    {
        return $this->ws_user_persoonsgegevens === self::PERMISSION_ALLOW;
    }

    /**
     * @return bool
     */
    public function canEnterDeclarations()
    {
        return $this->ws_user_urendeclaraties === self::PERMISSION_ALLOW;
    }

    /**
     * @return bool
     */
    public function canApproveDeclarations()
    {
        return $this->ws_user_urendeclaraties === self::PERMISSION_ALLOW;
    }

}
