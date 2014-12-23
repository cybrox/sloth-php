<?php

  class Controller extends Base {

    private static $new_controller;


    /**
     * Check if the given controller exists and return it if possible
     */
    public static function get_controller($controller){
      if(!@require_once(URI::$relative.'app/controllers/'.$controller.'_controller.php'))
        throw new LazySloth("Trying to load nonexistent controller '{$controller}'");

      $controller = ucfirst($controller).'Controller';
      self::$new_controller = new $controller();
    }


    /**
     * Check if the sub method of the controller exists and call it
     * @param sting $method - The respective controller method
     */
    public static function invoke_method($method){
      if(!method_exists(self::$new_controller, $method))
        throw new LazySloth("Trying to invoke nonexistend method '{$method}' of controller");
      
      else self::$new_controller->$method();
    }

  }

?>