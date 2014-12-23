<?php

  class Route extends Base {

    public $verb;
    public $path;
    public $pattern;
    public $namespace;

    private $controller;
    private $callmethod;

    private $has_before = false;
    private $has_after = false;
    private $before;
    private $after;

    /**
     * Create a new route for a given verb and path that will create 
     * a hook to loop through in the given controller object
     * @param string $verb - Matching http request verb
     * @param string $path - Matching http request path
     * @param string $controller - The controller action to call
     */
    public function __construct($verb, $path, $controller){
      $this->verb = strtolower($verb);
      $this->path = trim(trim($path), " \\/");

      $path_meta = explode("/", $this->path);
      $this->namespace = trim($path_meta[0], "\/() ");

      $pattern = str_replace(array("/", ")"), array("\/", ")?"), $this->path);
      $pattern = preg_replace("/\:[A-z0-9]+/i", "[^\/]+", $pattern);
      $this->pattern = "/^{$pattern}$/i";

      $controller_info = explode("#", $controller);
      $this->controller = $controller_info[0];
      $this->callmethod = $controller_info[1];
    }


    /**
     * Resolve dynamic route parameters from the called path
     * @param string $path - The requested path
     */
    public function resolve_params($path){
      $path_meta = str_replace(array("(", ")"), array("", ""), $this->path);

      $piece_meta = explode("/", $path_meta);
      $paths_meta = explode("/", $path);

      foreach($piece_meta as $i => $segment){
        if(substr($segment, 0, 1) == ":"){
          if(!empty($paths_meta[$i]))
            Registry::set(substr($segment, 1), $paths_meta[$i]);
        }
      }
    }


    /**
     * Append a hook function before executing the route 
     * @param function $before - Function that will be called before the route hooks
     */
    public function append_before($before){
      $this->has_before = true;
      $this->before = $before;
    }


    /**
     * Append a hook function after executing the route 
     * @param function $after - Function that will be called after the route hooks
     */
    public function append_after($after){
      $this->has_after = true;
      $this->after = $after;
    }


    /**
     * Call the function that has been defined before the model hook
     * this will do nothing, if the function is not set.
     */
    public function call_before(){
      if($this->has_before){
        if(is_callable($this->before)) $this->before->__invoke();
        else $this->call_controller_method($this->before);
      }
    }


    /**
     * Call the function that has been defined after the model hook
     * this will do nothing, if the function is not set.
     */
    public function call_after(){
      if($this->has_after){
        if(is_callable($this->after)) $this->after->__invoke();
        else $this->call_controller_method($this->after);
      }
    }


    /**
     * Call the actual controller action if the route was matched and
     * we want to do stuff
     */
    public function call_controller(){
      Controller::get_controller($this->controller);
      Controller::invoke_method($this->callmethod);
    }


    /**
     * Call a method from a controller with a given controller#method
     * constellation string.
     * @param string $method - The given address string
     */
    public function call_controller_method($method){
      $method_meta = explode("#", $method);

      Controller::get_controller($method_meta[0]);
      Controller::invoke_method($method_meta[1]);
    }

  }

?>