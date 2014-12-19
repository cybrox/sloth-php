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
    require './core/'.$class.'.class.php';
  }



  /**
   * Just space for testing for now
   */
  Router::route("GET", "/", "index#show");
  Router::route_before("GET", "/", function(){ echo 'a'; });

  Router::route_process();

?>