<?php

namespace press\api\services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use press\api\models\Categorie;
use press\api\models\User;

class UserService{

    function getUser(){
        $users = Categorie::all();
        return $users;
    }

    function getEmailByUserId(int $id): string
    {
        try {
            return User::where('id', $id)->firstOrFail()->email;
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de l'utilisateur n'est pas renseigné");
        }
    }

    function getIdUsersByEmail(String $email): string
    {
        try {
            return User::where('email', $email)->firstOrFail()->id;
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de l'utilisateur n'est pas renseigné");
        }
    }

}