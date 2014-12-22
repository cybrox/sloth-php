<?php

  class Database extends Base {

    private static $instance;


    /**
     * Create a new MySQL database instance
     * @param array $db - Database config
     */
    public static function connect($db){
      $dns = 'mysql:' . implode(';', array('dbname=' . $db['database'], 'host=' . $db['hostname'], 'port=' . $db['port'], 'charset=' . $db['charset']));
      self::$instance = new PDO($dns, $db['username'], $db['password']);
      
      return self::$instance;
    }

  }

?>