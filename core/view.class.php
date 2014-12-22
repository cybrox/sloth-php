<?php

  class View extends Base {

    private static $has_header = false;
    private static $has_footer = false;
    private static $header;
    private static $footer;


    /**
     * Render given json data as json output instead of a view
     * @param mixed $data - json input data
     */
    public static function render_json($data){
      if(is_array($data)) $data = json_encode($data);
      header('Content-Type: application/json');
      echo $data;
    }


    /**
     * Render a view with the given header and footer parts
     * @param string $name - The name of the view to render
     */
    public static function render($name){
      if(!file_exists(self::get_path($name)))
        throw new LazySloth("Tried to render inexistend view '".$name."'");

      if(self::$has_header) self::partial($header);
      include self::get_path($name);
      if(self::$has_footer) self::partial($footer);
    }


    /**
     * Render a partial without the header or footer part
     * @param string $name - The name of the partial to render
     */
    public static function partial($name){
      if(!file_exists(self::get_path($name)))
        throw new LazySloth("Tried to render inexistend partial '".$name."'");

      include self::get_path($name);
    }


    /**
     * Set header partial for full page templates
     * @param string $name - The name of the partial to render
     */
    public static function set_header($name){
      self::$has_header = true;
      self::$header = $name;
    }


    /**
     * Set footer partial for full page templates
     * @param string $name - The name of the partial to render
     */
    public static function set_footer($name){
      self::$has_footer = true;
      self::$footer = $name;
    }


    /**
     * Get the path to a given view
     * @param string $name - Name of the respective view
     */
    private static function get_path($name){
      return 'app/views/'.$name.'.php';
    }


  }

?>