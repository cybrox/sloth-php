<?php

  /**
   * Sloth-PHP
   * Tiny php framework, not actually as slow as it sounds.
   *
   * Written and copyrighted 2014+
   * by Sven Marc 'cybrox' Gehring
   */

  /* Allow user to switch app dir */
  define("APPDIR", "app");


  /* Require needed fiels */
  require_once('./core/base.class.php');
  require_once('./core/uri.class.php');
  require_once('./core/autoloader.class.php');


  /* Invoke base boot to get data we need */
  Base::boot();


  /* Register the autloader and load our files */
  Autoloader::register();
  Autoloader::load_app();
  Autoloader::load_dbs();


  /* Create function alias for simple templating */
  function __($name){ echo Registry::get($name); }


  /* Actually render page or catch errors */
  try {
    Router::route_process($_SERVER);
  } catch(LazySloth $s) {
    Error::shutdown($s);
  }
?>