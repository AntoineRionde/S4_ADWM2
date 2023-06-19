<?php

namespace press\app\services;

use press\app\models\Categorie;
use press\app\models\User;

class UserService{

    function getUser(){
        $users = Categorie::all();
        return $users;
    }

    public function IsUserExist(string $email)
    {
        $user = User::where('email', $email)->first();
        return (bool)$user;
    }

}