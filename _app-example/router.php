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

  // User UI routes
  Router::route("GET", "/", "user#home");
  Router::route("GET", "/dashboard(/:page_nr)", "user#dashboard");
  Router::route("GET", "/user/logout", "user#logout");
  Router::route("POST", "/user/login", "user#login");

  Router::route_before("GET", "/dashboard(/:page_nr)", "user#auth_by_session");
  Router::route_before("GET", "/user/logout", "user#auth_by_session");


  // Image API routes
  Router::route("GET", "/images", "image#list_all");
  Router::route("POST", "/images/add", "image#add");
  Router::route("POST", "/images/remove", "image#remove");

  Router::route_before("GET", "/images", "user#auth_by_token");
  Router::route_before("POST", "images/add", "user#auth_by_token");
  Router::route_before("POST", "images/remove", "user#auth_by_token");
?>