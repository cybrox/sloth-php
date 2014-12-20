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
      array('core', '.class'),
      array('app/controllers', ''),
      array('app/models', ''),
      array('app/views', '')
    );

    foreach ($dirs as $dir) {
      $path = $dir[0].'/'.$class.$dir[1].'.php';
      if(file_exists($path)) include($path);
    }
  }


  /**
   * Include needed files
   */
  require_once('./router.php');

  // echo '<pre>';
  // var_dump($_SERVER);
  // echo '</pre>';


  /**
   * Just space for testing for now
   */

  Router::route_process($_SERVER);

?>