<?php

  class Router extends Base {

    private static $base = '/';
    private static $verb;
    private static $path;
    private static $rtpe;
    private static $count = 0;

    private static $routes = array();
    private static $e = false; // Error indicator


    /**
     * Set the base of the router path.
     * @param string $base - The routing base
     */
    public static function set_base($base){
      self::$base = trim(trim($base), " \\/");
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
      self::$count++;
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
      $path = trim(trim($path), " \\/");

      foreach (self::$routes as $route)
        if($route->verb == $verb && $route->path == $path) return $route;
    }


    /**
     * Match a dynamic route
     * @param string $verb - http request verb
     * @param string $path - http request path
     */
    public static function match_dynamic($verb, $path){
      if(self::$count == 0)
        throw new LazySloth("Cannot resolve path, no routes defined in '".APPDIR."/router.php'");
      
      if(empty($verb)) $verb = self::$verb;
      if(empty($path)) $path = self::$path;

      $verb = strtolower($verb);
      $path = trim(trim($path), " \\/");

      $path_meta = explode("/", $path);
      $path_test = $path_meta[0];

      foreach (self::$routes as $route){
        if($route->verb == $verb && $route->namespace == $path_test){
          if(preg_match($route->pattern, $path)){
            $route->resolve_params($path);
            return $route;
          }
        }
      }
    }


    /**
     * This method will be called from the index to actually process the current route
     * @param array $server - Server array
     */
    public static function route_process($server){
      self::$verb = strtolower($server['REQUEST_METHOD']);
      self::$path = str_replace(self::$base, "", $server['REQUEST_URI']);
      self::$rtpe = (substr_count($server['REQUEST_URI'], ".json") == 1) ? 'json' : 'html';

      // Remove query strings from requested path
      $path_meta  = preg_split("/(\?|\&|\.)/i", self::$path);
      self::$path = $path_meta[0];

      BaseController::$request_type = self::$rtpe;
      if(Session::has('__regtemp')){
        foreach(Session::get('__regtemp') as $k => $v)
          Registry::set($k, $v);

        Session::drop('__regtemp');
      }


      $route = self::match_dynamic(self::$verb, self::$path);

      if(!$route) Error::throw404();
      else {
        if(!self::$e) $route->call_before();
        if(!self::$e) $route->call_controller();
        if(!self::$e) $route->call_after();
      }
    }


    /**
     * Redirect to another route
     */
    public static function redirect($path, $registry = array()){
      Session::set('__regtemp', $registry);
      header("Location: /".self::fix_path(self::$base, $path));
    }


    /**
     * Kill routing, don't load following controller actions
     */
    public static function terminate(){
      self::$e = true;
    }


    /**
     * Fix the connection between two path segments
     * @param string $part1 - First part of the string
     * @param string $part2 - Second part of the string
     */
    public static function fix_path($part1, $part2){
      if(substr($part1, -1) != '/' && substr($part2, 0, 1) != '/')
        return $part1.'/'.$part2;

      if(strstr($part1.$part2, "//"))
        return $part1.substr($part2, 1);

      return $part1.$part2;
    }


    /**
     * Base shortcut for templating
     */
    public static function b(){
      return self::$base;
    }


    /**
     * Link helper for templating
     * @param string $target - The link target
     */
    public static function link($target){
      return "/".self::fix_path(self::$base, $target);
    }

  }

?>