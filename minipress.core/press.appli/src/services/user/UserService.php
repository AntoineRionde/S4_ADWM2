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

}