<?php

  class BaseModel extends Base {

    public static $no_table = false;
    public static $table;
    public static $query;

    private static $db_modifiers = array("where", "or_where", "where_in", "join", "left_join", "sort", "group");
    private static $db_actions = array("delete", "update", "insert_get_id", "insert", "get", "fetch", "column", "count");


    /**
     * Magic method to catch static calls to model methods
     * This will allow direct model database interactions
     * @param string $name - The name of the called method
     * @param mixed $params - The given method parameters
     */
    public static function __callStatic($name, $params){
      self::check_model_table();

      // Check if called class has method
      if(method_exists(get_called_class(), $name)) return;

      // Query builder request, return query
      if(in_array(strtolower($name), self::$db_modifiers)){
        if(count($params) == 1 && is_array($params[0])){
          foreach ($params[0] as $param_meta) $x= self::call_model_method($name, $param_meta);
        } else {
          $x = self::call_model_method($name, $params);
        }

        return $x;
      }

      // Fetch request, return data
      if(in_array(strtolower($name), self::$db_actions)){
        $x = self::call_model_method($name, $params);
        self::$query = null;
        return $x;
      }

      // Get a new query
      if($name == "query")
        return self::get_new_model_query();
    }


    /**
     * Check if the model has a valid table. If not, try to guess.
     */
    private static function check_model_table(){
      if(self::$no_table)
        throw new LazySloth("Tried to interact with table of model with \$no_table parameter!");

      $table_meta = strtolower(get_called_class());
      if($table_meta != self::$table) self::$query = null;
      self::$table = $table_meta;
    }


    /**
     * Call a model method with given parameters
     * @param string $name - The name of the method to call
     * @param mixed $params - The given method parameters
     */
    private static function call_model_method($name, $params){
      if(self::$query == null) self::$query = new Query(self::$table);
      return call_user_func_array(array(self::$query, $name), $params);
    }


    /**
     * Get a new query for the called module
     */
    private static function get_new_model_query(){
      self::check_model_table();
      self::$query = new Query(self::$table);
      return self::$query;
    }

  }

?>