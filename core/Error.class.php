<?php

  class Error extends Base {

    /**
     * This will eventually render a real 404 resposne
     */
    public static function throw404(){
      die("404 Not found");
    }

  }

?>