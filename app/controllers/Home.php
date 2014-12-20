<?php

  class Home extends Controller {

    public function index(){
      Registry::set("Teststring", "This is some example content stored in the registry!");
      
      View::render('home');
    }

  }

?>