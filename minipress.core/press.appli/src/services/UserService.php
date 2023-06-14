<?php

namespace press\app\services;

use press\app\models\User;
use Slim\Exception\HttpBadRequestException;

class UserService{

    function getUser(){
        $users = Categorie::all();
        return $users;
    }
}