<?php
/**
 * File:  Eloquents.php
 * Creation Date: 14/06/2023
 * description: classe Eloquent, service de connexion à la base de données
 *
 *
 */

namespace press\app\services\utils;

use Illuminate\Database\Capsule\Manager as DB;

class Eloquent
{
    public static function init($filename): void
    {
        $db = new DB();
        $db->addConnection(parse_ini_file($filename));
        $db->setAsGlobal();
        $db->bootEloquent();

    }
}