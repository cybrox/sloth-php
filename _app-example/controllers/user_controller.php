<?php

  class UserController extends BaseController {

    // GET "/"
    public function home(){
      View::render('home');
    }


    // GET "/dashboard"
    public function dashboard(){
      $user = Session::get('user');
      $images = Image::where("user_id", "=", $user->id);

      Registry::set('images', $images->get());

      View::render('dashboard');
    }


    // POST "/user/login"
    public function login(){
      $username = Parameters::get('username', 'post');
      $password = Parameters::get('password', 'post');

      $user = User::where(array(
        array("username", "=", $username),
        array("password", "=", $password)
      ));

      if(intval($user->count()) == 1){
        Session::set('user', $user->fetch());
        Router::redirect('/dashboard');
      } else {
        Router::redirect('/', array("login_failed" => true));
      }
    }


    // GET "/user/logout"
    public function logout(){
      Session::drop("user");
      Router::redirect("/");
    }


    // Auth verification via session
    public function auth_by_session(){
      if(Session::get('user') == null)
        Router::redirect('/', array("login_needed" => true));
    }


    // Auth verification via token parameter
    public function auth_by_token(){
      $token = Parameters::get('auth_token');
      if(!preg_match("/[A-z0-9]{30}/si", $token)) {
        $this->auth_error_api("invalid token syntax");
      } else {

        $user = User::where("auth_token", "=", $token);
        if(intval($user->count()) != 1)
          $this->auth_error_api("invalid auth token");

        Registry::set('user', $user->fetch());

      }
    }


    // API Auth error message
    public function auth_error_api($msg){
      View::render_json(array("error" => true, "info" => $msg));
      Router::terminate();
    }

  }

?>