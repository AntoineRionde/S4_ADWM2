<?php

namespace press\app\services\user;

use press\app\models\Categorie;
use press\app\models\User;

class UserService{

    function getUser(){
        $users = Categorie::all();
        return $users;
    }

    public function IsUserExist(string $username)
    {
        $user = User::where('username', $username)->first();
        return (bool)$user;
    }

    /**
     * @param string $username
     * @param int $role
     * @return void
     * set le role à un user
     * utile pour la création d'un compte admin
     */
    public function setRole(string $username, int $role): void
    {
        $user = User::where('username', $username)->first();
        $user->role = $role;
    }

}