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

        echo (substr($file_name, -3) == 'css') ? '<link rel="stylesheet" href="'.$file.'" />' : 
          '<script type="text/javascript" src="'.$file.'"></script>';
      }
    }

  }

?>