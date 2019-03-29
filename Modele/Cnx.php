<?php

//Elie Bismuth

namespace App;

use PDO;

class Cnx {
    
    private static $_instance = null;
    
    private static $dsn = 'mysql:dbname=dev_elie_sport;host=localhost';
    private static $user = 'dev-elie-sport';
    private static $passwd = '';
    private static $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''];
 
    private function __construct() {  
    }
  
    /**
     * Recupére l'instance de PDO
     *
     * @return void
     */
    public static function getInstance() {
  
      if(is_null(self::$_instance)) {
        self::$_instance = new PDO(self::$dsn, self::$user, self::$passwd, self::$options);;  
      }
  
      return self::$_instance;
    }

    /**
     * Récupére le dernier id inseré en base de données
     *
     * @return void
     */
    public static function getLastInsertId(){

        $id = self::$_instance->lastInsertId();
        return $id;
    }
 

}


?>
