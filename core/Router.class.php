<?php

  class Router extends BaseClass {

    private static $verb;
    private static $path;

    private static $routes = array();


    /**
     * Class constructor, this will resolve the given path
     * @param array $server - Server array
     */
    public function __constuct($server){
      self::$verb = $server['REQUEST_METHOD'];
      self::$path = str_replace(parent::$base, "", $server['REQUEST_URI']);
    }


    /**
     * Create a new route for a given verb and path that will create 
     * a hook to loop through in the given controller object
     * @param string $verb - Matching http request verb
     * @param string $path - Matching http request path
     * @param string $controller - The controller action to call
     * @param (opt) function $before - Function that will be called before the route hooks
     * @param (opt) function $after - Function that will be called after the route hooks
     */
    public static function route($verb, $path, $controller, $before = null, $after = null){
      $route = new Route($verb, $path, $controller);

      if($before != null) $route->append_after($before);
      if($after != null)  $route->append_after($after);

      array_push(self::$routes, $route);
    }


    /**
     * Append a hook function before executing the route 
     * @param string $verb - Matching http request verb
     * @param string $path - Matching http request path
     * @param function $before - Function that will be called before the route hooks
     */
    public static function route_before($verb, $path, $before){
      $route = self::match($verb, $path);

      if(!$route) return false;
      else $route->append_before($before);
    }


    /**
     * Append a hook function after executing the route 
     * @param string $verb - Matching http request verb
     * @param string $path - Matching http request path
     * @param function $after - Function that will be called after the route hooks
     */
    public static function route_after($verb, $path, $after){
      $route = self::match($verb, $path);

      if(!$route) return false;
      else $route->append_after($after);
    }


    /**
     * Match a route and call its hook steps
     * @param string $verb - http request verb
     * @param string $path - http request path
     */
    public static function match($verb, $path){
      if(empty($verb)) $verb = $this->verb;
      if(empty($path)) $path = $this->path;

      foreach (self::$routes as $route)
        if($route->verb == $verb && $route->path = $path) return $route;
    }

  }

?>