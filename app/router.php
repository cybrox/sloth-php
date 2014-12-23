<?php


  /**
   * This is the sloth-php router.
   * You may want to define all routes that your app will use in here.
   * The route will determine what controller and what action to call
   * when the server needs to render the page.
   *
   * For example, if we map GET '/' to home#index, sloth-php will call
   * the method 'index' in the 'Home' controller (app/controllers.Home.php)
   * when somebody accesses the path '/' via http get.
   *
   * You can use the following notations:
   * Router::route("GET", "/", "home#index");
   * Router::route("GET", "/", "home#index", function(){}, function(){});
   * Router::route_before("GET", "/", function(){ echo 'I will be run before rendering home#index'; });
   * Router::route_after("GET", "/", function(){ echo 'I will be run after rendering home#index'; });
   *
   */

?>