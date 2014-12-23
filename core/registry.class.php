<?php

  class Registry extends Base {

    private static $stack = array();


    /**
     * Set a value in the registry stack to access it from the view
     * @param string $name - Name of the property
     * @param string $value - Value of the property
     */
    public static function set($name, $value){
      self::$stack[$name] = $value;
    }


    /**
     * Allow the template to quickly get any value from the registry
     * @param string $name - Name of the property
     */
    public static function get($name){
      if(!array_key_exists($name, self::$stack)) return " [variable.{$name}] ";
      return self::$stack[$name];
    }


    /**
     * Check if registry has a certain key
     * @param string $name - Name of the property
     */
    public static function has($name){
      return array_key_exists($name, self::$stack);
    }

  }

?>