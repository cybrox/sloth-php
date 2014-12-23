<?php

  class Session extends Base {


    /**
     * Get a value in the current session
     * @param string $key - The session array key
     */
    public static function get($key){
      if(!array_key_exists($key, $_SESSION)) return null;
           
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
     * Check if a session variable exists
     * @param string $key - The session array key
     */
    public static function has($key){
      return array_key_exists($key, $_SESSION);
    }


    /**
     * Unset a value in the current session
     * @param string $key - The session array key
     */
    public static function drop($key){
      if(!array_key_exists($key, $_SESSION)) return;
      unset($_SESSION[$key]);
    }


    /**
     * Get a cookie from the user's cookie array
     * @param string $name - Name of the cookie
     */
    public static function get_cookie($name){
      if(!array_key_exists($key, self::$config)) return null;
           
      return $_SESSION[$key];
    }


    /**
     * Set a cookie for the current user
     * @param string $name - Name of the cookie
     * @param string $value - Value of the set cookie
     * @param string $expire - Expiration value of the cookie
     * @param string $path - The cookie path
     * @param string $domain - The cookie domain
     * @param bool $secure - Cookie secure indicator
     */
    public static function set_cookie($name, $name, $value, $expire = 0, $path = '/', $domain = null, $secure = false) {
      setcookie($name, $value, $expire, $path, $domain, $secure);
    }


    /**
     * Delete a cookie by setting its expiration time
     * @param string $name - Name of the cookie
     * @param string $path - The cookie path
     * @param string $domain - The cookie domain
     * @param bool $secure - Cookie secure indicator
     */
    public static function delte_cookie($name, $path = '/', $domain = null, $secure = false) {
      setcookie($name, null, -2000, $path, $domain, $secure);
    }

  }

?>