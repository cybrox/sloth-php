<?php

  class Controller extends Base {

    private static $new_controller;


    /**
     * Check if the given controller exists and return it if possible
     */
    public static function get_controller($controller){
      $controller_path = URI::$relative.APPDIR.'/controllers/'.$controller.'_controller.php';

      if(!file_exists($controller_path))
        throw new LazySloth("Trying to load nonexistent controller '{$controller}'");

      require_once($controller_path);

      $controller = ucfirst($controller).'Controller';
      self::$new_controller = new $controller();
    }


    /**
     * Check if the sub method of the controller exists and call it
     * @param sting $method - The respective controller method
     */
    public static function invoke_method($method){
      if(!method_exists(self::$new_controller, $method))
        throw new LazySloth("Trying to invoke nonexistent method '{$method}' of controller");
      
      else self::$new_controller->$method();
    }

  }

?>