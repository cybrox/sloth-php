<?php

  class Controller extends BaseClass {

    private static $new_controller;


    /**
     * Check if the given controller exists and return it if possible
     */
    public static function get_controller($controller){
      $controller = ucfirst($controller);
      self::$new_controller = new $controller();
    }


    /**
     * Check if the sub method of the controller exists and call it
     * @param sting $method - The respective controller method
     */
    public static function invoke_method($method){
      if(!method_exists(self::$new_controller, $method)) return; // Error handling!
      self::$new_controller->$method();
    }

  }

?>