<?php

  class Database extends Base {

    private static $pdo;
    public static $prefix;


    /**
     * Create a new MySQL database instance
     * @param array $db - Database config
     */
    public static function connect($db){
      $dns = 'mysql:' . implode(';', array('dbname=' . $db['database'], 'host=' . $db['hostname'],
                                'port=' . $db['port'], 'charset=' . $db['charset']));

      self::$prefix = $db['prefix'];
      self::$pdo = new PDO($dns, $db['username'], $db['password']);
    }


    /**
     * Prepare and execute a built query
     * @param string $sql - The sql query string
     * @param array $binds - The pdo param bindings array
     */
    public static function execute($sql, $binds){
      $statement = self::$pdo->prepare($sql);
      $result = $statement->execute($binds);
      return array($result, $statement);
    }


    /**
     * Get the active database connection
     */
    public static function connection(){
      return self::$pdo;
    }

  }

?>