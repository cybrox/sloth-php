<?php

  class Home extends BaseController {

    public function index(){
      Registry::set("Teststring", "This is some example content stored in the registry!");
      
      if(parent::$request_type == 'html'){
        View::render('home');
      } else {
        View::render_json(array(Registry::get('Teststring')));
      } 
    }

    public function before_index(){

      if(!Session::get('isUser'))
        Session::set('isUser', true);

    }

  }

?>