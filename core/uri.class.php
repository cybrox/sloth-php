<?php

  class URI extends Base {

    public static $root;
    public static $relative;


    /**
     * This will set up the uri class and get the current
     * uri settings to request other files easier.
     * @param string $base - Subdirectory base
     */
    public static function setup_uri($base){
      self::$root .= substr(str_replace("index.php", "", $_SERVER['SCRIPT_NAME']), 1);
      self::$root = str_replace($base, "", self::$root);

      $endpost = strpos(self::$root, substr($_SERVER['REQUEST_URI'], 1));
      $overlap = ($endpost) ? substr(self::$root, $endpost) : "";

      self::$relative = "./".str_repeat("../", substr_count($overlap, "/"));
    }


    /**
     * Update the URI params by simply recalling setup uri
     */
    public static function update_uri(){
      self::setup_uri();
    }

  }

?>