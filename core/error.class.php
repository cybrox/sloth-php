<?php

  class Error extends Base {

    /**
     * Render the error404 view
     */
    public static function throw404(){
      if(Base::config('environment') == 'development'){
        $s = new LazySloth("The current path did not match any routes.");
        die($s->__toString());
      } else {
        View::render('error404');
      }
    }


    /**
     * The shutdown method will be the actual php error handler
     * for the framework that kicks in whenever some php-side
     * stuff is going wrong to give the user a feedback.
     * @param LazySloth $s - The exception object
     */
    public static function shutdown($s){
      if(Base::config('environment') == 'development'){
        die($s->__toString());
      } else {
        die("An internal error occured, please contact an administrator.");
      }
    }

  }

?>