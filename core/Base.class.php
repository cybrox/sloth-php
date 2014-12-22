<?php

  class Base {

    private static $config;


    /**
     * Set the config array to the base to have a globally accessible config
     * @param array $config - The config array
     */
    public static function set_config($config){
      self::$config = $config;
    }


    /**
     * Get a value from the global config by its given key
     * @param string $key - The respective options key.
     */
    public static function config($key){
      if(!array_key_exists($key, self::$config))
        throw new LazySloth("Tried to access unset config value from Base::config");
     
      return self::$config[$key]; 
    }


    /**
     * The boot function will be called once from the index to
     * get all the initial stuff done.
     */
    public static function boot(){
      session_start();

      /* Check PHP version */
      if(version_compare(PHP_VERSION, '5.3') < 0) {
        echo "sloth-php needs PHP 5.3 or higher, you're running" . PHP_VERSION;
        exit;
      }

      /* URI class setup */
      // more here
    }

  }

?>