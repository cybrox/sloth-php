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

  }

?>