<?php

  class BaseClass {

    protected $base;

    /**
     * Core constructor, will initialize important stuff
     */
    public function __construct(){
      // Actually load config file here
      $this->base = "imgsave/";
    }

  }

?>