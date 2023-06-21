<?php

namespace press\app\services\user;

use press\app\models\Categorie;
use press\app\models\User;

class UserService{

    /**
     * Méthode statique vérifiant le niveau d'accès de l'utilisateur
     * @param int $id
     * @throws AccessControlException
     */
    public static function checkAcessRole(int $id)
    {
        $user = User::where('id', $id)->first();
        if (!$user->role) {
            throw new AccessControlException();
        }
    }

    function getUser(){
        $users = Categorie::all();
        return $users;
    }

    public function IsUserExist(string $email): bool
    {
        $user = User::where('email', $email)->first();
        return (bool)$user;
    }

}