<?php

  /**
   * Sloth-PHP
   * Tiny php framework, not actually as slow as it sounds.
   *
   * Written and copyrighted 2014+
   * by Sven Marc 'cybrox' Gehring
   */


  /* Require needed fiels */
  require_once('./core/Base.class.php');
  require_once('./core/Autoloader.class.php');


  /* Register the autloader and load out files */
  Autoloader::register();


  /* Include needed files */
  require_once('./app/router.php');
  require_once('./app/config.php');


  /* Create function alias for simple templating */
  function __($name){ echo Registry::get($name); }


  /* Start a new session */
  session_start();

  /* Check PHP version */
  if(version_compare(PHP_VERSION, '5.3') < 0) {
    echo "sloth-php needs PHP 5.3 or higher, you're running" . PHP_VERSION;
    exit;
  }


  /* Actually render page or catch errors */
  try {

    Base::set_config($__sphpconfig);
    Router::route_process($_SERVER);

  } catch(LazySloth $s) {
    Error::shutdown($s);
  }
?>