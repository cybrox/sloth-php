<?php

  class HomeController extends BaseController {

    public function index(){
      Registry::set("framework", static::config('framework'));
      
      if(static::$request_type == 'html'){
        View::render('home');
      } else {
        View::render_json(
          array("framework" => Registry::get('framework'))
        );
      } 
    }

    public function before_index(){

      if(!Session::get('isUser'))
        Session::set('isUser', true);

    }

  }

?>