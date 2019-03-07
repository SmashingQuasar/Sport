<?php

//Elie Bismuth

namespace App;

use PDO;

class Cnx {
    
    private static $_instance = null;
    
    private static $dsn = 'mysql:dbname=sport;host=127.0.0.1';
    private static $user = 'root';
    private static $passwd = '';
    private static $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''];
 
    private function __construct() {  
    }
  
    public static function getInstance() {
  
      if(is_null(self::$_instance)) {
        self::$_instance = new PDO(self::$dsn, self::$user, self::$passwd, self::$options);;  
      }
  
      return self::$_instance;
    }
 

}


?>
