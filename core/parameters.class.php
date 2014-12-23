<?php

  class Parameters extends Base {

    private static $get_dump;
    private static $post_dump;


    /**
     * Get a parameter from the request arrays
     * @param string $key - The key of the parameter
     * @param string $type - The type of the parameter
     */
    public static function get($key, $type = null) {
      if(self::$get_dump == null | self::$post_dump == null)
        self::load_data();

      switch (strtolower($type)) {
        case 'post': return self::$post_dump[$key]; break;
        case 'get':  return self::$get_dump[$key]; break;
        default: return self::get_key($key); break;
      }
    }


    /**
     * Check if a parameter array has a certain key
     * @param string $key - The key of the parameter
     * @param string $type - The type of the parameter
     */
    public static function has($key, $type = null){
      if(self::$get_dump == null | self::$post_dump == null)
        self::load_data();

      switch (strtolower($type)) {
        case 'post': return array_key_exists($key, $post_dump); break;
        case 'get':  return array_key_exists($key, $get_dump); break;
        default: return self::has_key($key); break;
      }
    }


    /**
     * Try to get the key value from either one of the arrays
     * @param string $key - The key of the parameter
     */
    private static function get_key($key){
      if(array_key_exists($key, self::$post_dump)) return self::$post_dump[$key];
      if(array_key_exists($key, self::$get_dump)) return self::$get_dump[$key];
      return null;
    }


    /**
     * Try to find the key in either one of the arrays
     * @param string $key - The key of the parameter
     */
    private static function has_key($key){
      if(array_key_exists($key, self::$post_dump)) return true;
      if(array_key_exists($key, self::$get_dump)) return true;
      return false;
    }


    /**
     * Load data from the request arrays into buffer
     */
    private static function load_data(){
      self::$post_dump = $_POST;
      self::$get_dump = $_GET;
    }
  }

?>