<?php

  class Autoloader extends Base {


    /**
     * Load scripts or stylesheets from the public directory.
     * This can be used in a template header to load resources.
     */
    public static function load_public(){
      self::load_files('./public');
    }


    /**
     * Load all scripts or stylesheets from the vendor directory.
     * This can be used in a template header to load resources.
     */
    public static function load_vendor(){
      self::load_files('./vendor');
    }


    /**
     * Load specified script and stylsheet files
     * @param string $path - The path to the directory to load from
     */
    private static function load_files($path){
      $rdi = new RecursiveDirectoryIterator($path);
      foreach (new RecursiveIteratorIterator($rdi) as $file => $f) {
        $file_meta = preg_split("/\/|[\\\]/is", $file);
        $file_name = $file_meta[(count($file_meta) - 1)];

        if(!preg_match("/.*\.(js|css)/is", $file_name)) continue;

        $file = str_replace("./", "", $file);
        $file = "/".Router::fix_path(Router::b(), $file);

        echo (substr($file_name, -3) == 'css') ? '<link rel="stylesheet" href="'.$file.'" />' : 
          '<script type="text/javascript" src="'.$file.'"></script>';
      }
    }


    /**
     * Register internal autoloading to spl stack
     */
    public static function register(){
      spl_autoload_register(array(__CLASS__, 'load'));
    }


    /**
     * This will attempt to load a class invoked by the spl autoloader
     * @param string $class - The name of the respective class
     */
    private static function load($class){
      $dirs = array(
        array('core', '.class'),
        array(APPDIR.'/models', '')
      );

      foreach ($dirs as $dir) {
        $path = $dir[0].'/'.strtolower($class).$dir[1].'.php';
        if(file_exists($path)) include($path);
      }
    }


    /**
     * Load the app config and router
     */
    public static function load_app(){
      include(URI::$relative.APPDIR.'/router.php');
      include(URI::$relative.APPDIR.'/config.php');

      Base::set_config($__sphpconfig);
    }


    /**
     * Load our database connections
     */
    public static function load_dbs(){
      $db = Base::config('database');
      if($db['use_db']) Database::connect($db);
    }

  }

?>