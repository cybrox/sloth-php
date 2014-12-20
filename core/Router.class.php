<?php

  class Router extends Base {

    private static $verb;
    private static $path;
    private static $base;

    private static $routes = array();


    /**
     * Set the base of the router path.
     * @param string $base - The routing base
     */
    public static function set_base($base){
      self::$base = trim($base);
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
      if(empty($verb)) $verb = self::$verb;
      if(empty($path)) $path = self::$path;

      $verb = strtolower($verb);
      $path = trim($path);

      foreach (self::$routes as $route)
        if($route->verb == $verb && $route->path == $path) return $route;
    }


    /**
     * This method will be called from the index to actually process the current route
     * @param array $server - Server array
     */
    public static function route_process($server){
      self::$verb = strtolower($server['REQUEST_METHOD']);
      self::$path = str_replace(self::$base, "", $server['REQUEST_URI']);

      $route = self::match(self::$verb, self::$path);

      if(!$route) Error::throw404();
      else {
        $route->call_before();
        $route->call_controller();
        $route->call_after();
      }
    }

  }

?>