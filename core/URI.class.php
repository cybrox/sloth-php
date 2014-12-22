<?php

  class URI extends Base {

    public static $root;
    public static $relative;


    /**
     * This will set up the uri class and get the current
     * uri settings to request other files easier.
     */
    public static function setup_uri(){
      self::$root = str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);
      self::$relative = str_replace(self::$root, "", $_SERVER['REQUEST_URI']);
    }


    /**
     * Update the URI params by simply recalling setup uri
     */
    public static function update_uri(){
      self::setup_uri();
    }

  }

?>