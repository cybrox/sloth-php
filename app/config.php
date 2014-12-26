<?php


  /**
   * This is the sloth-php config.
   *
   * Any value you set here will be available globally in your
   * application via Base::config('keyname').
   */

  $__sphpconfig = array(

    // The environment settings determine the level of error reporting of
    // your application. You can set this to:
    // - production (live version, only show minimal error info)
    // - development (dev version, shows full php errors and trace)
    'environment' => 'development',

    // The database configuration allows you to connect your application
    // to a MySQL database. To prevent errors if you're not using the
    // database, set `use_db` to false.
    'database' => array(
      'use_db' => false,
      'driver' => 'mysql',
      'hostname' => 'localhost',
      'port' => 3306,
      'username' => 'root',
      'password' => '',
      'database' => 'sloth-php',
      'charset' => 'utf8',
      'prefix' => ''
    ),


    
    // You can add your own global variables here
    /* 'sloths' => 'awesome', */

  );

?>