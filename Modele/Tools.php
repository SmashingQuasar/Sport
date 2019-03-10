<?php

namespace App;

use PDO;
use App\Cnx;
use Exception;

class Tools{

    public static function getLastInsertId(){

        $connexion = Cnx::getInstance();
        $id = $connexion->lastInsertId();
        return $id;
    }



}