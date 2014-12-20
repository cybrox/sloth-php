<?php

  class Session extends Base {


    /**
     * Get a value in the current session
     * @param string $key - The session array key
     */
    public static function get($key){
      if(!array_key_exists($key, self::$config))
        throw new LazySloth("Tried to access unset seddion value");
     
      return $_SESSION[$key];
    }


    /**
     * Set a value in the current session
     * @param string $key - The session array key
     * @param string $value - The session array value
     */
    public static function set($key, $value){
      $_SESSION[$key] = $value;
    }


    /**
     * Get a cookie from the user's cookie array
     * @param string $value - Value of the set cookie
     */
    public static function get_cookie($name){
      if(!array_key_exists($key, self::$config))
        throw new LazySloth("Tried to access unset cookie value");
     
      return $_SESSION[$key];
    }


    /**
     * Set a cookie for the current user
     * @param string $name - Name of the cookie
     * @param string $value - Value of the set cookie
     * @param string $expire - Expiration value of the cookie
     */
    public static function set_cookie($name, $value = "", $expire){
      setcookie($name, $value, $expire);
    }

  }

?>