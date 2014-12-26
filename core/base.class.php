<?php

  class Base {

    private static $config = array();


    /**
     * Set the config array to the base to have a globally accessible config
     * @param array $config - The config array
     */
    public static function set_config($config){
      self::$config = $config;

      if(!array_key_exists("database", $config))
        throw new LazySloth("Missing config value database([Array])");

      if(!array_key_exists("environment", $config))
        throw new LazySloth("Missing config value environment([String])");
    }


    /**
     * Get a value from the global config by its given key
     * @param string $key - The respective options key.
     */
    public static function config($key){
      if(!array_key_exists($key, self::$config))
        throw new LazySloth("Tried to access unset config value {$key} from Base::config");
     
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
      URI::setup_uri(SUBDIR);
      Router::set_base(SUBDIR);
    }

  }

?>