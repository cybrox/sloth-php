<?php

  /**
   * Sloth-PHP
   * Tiny php framework, not actually as slow as it sounds.
   *
   * Written and copyrighted 2014+
   * by Sven Marc 'cybrox' Gehring
   */


  /**
   * Class autoloader for core resources
   * !!Need to replace this with something better later on
   */
  function __autoload($class) {
    $dirs = array(
      'core',
      'app/controllers',
      'app/models',
      'app/views'
    );
    
    foreach ($dirs as $dir) {
      $path = $dir.'/'.$class.'.class.php';
      if(file_exists($path)) include($path);
    }
  }


  // echo '<pre>';
  // var_dump($_SERVER);
  // echo '</pre>';


  /**
   * Just space for testing for now
   */
  Router::route("GET", "/", "index#show");
  Router::route_before("GET", "/", function(){ echo 'a'; });
  Router::route_after("GET", "/", function(){ echo 'b'; });

  Router::route_process($_SERVER);

?>