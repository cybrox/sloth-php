<?php

  class Route extends BaseClass {

    public $verb;
    public $path;

    private $controller;
    private $callmethod;

    private $has_before;
    private $has_after;
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
      $this->verb = $verb;
      $this->path = $path;

      $controller_info = explode("#", $controller);
      $this->controller = $controller_info[0];
      $this->callmethod = $controller_info[1];
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

  }

?>