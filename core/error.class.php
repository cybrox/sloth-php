<?php

  class Error extends Base {

    /**
     * Render the error404 view
     */
    public static function throw404(){
      View::render('error404');
    }


    /**
     * The shutdown method will be the actual php error handler
     * for the framework that kicks in whenever some php-side
     * stuff is going wrong to give the user a feedback.
     * @param LazySloth $s - The exception object
     */
    public static function shutdown($s){
      echo '
        <div style="position:absolute;width:100%;height:60%;padding:20% 0;top:0;left:0;text-align:center;background:#fff;font-family:Arial;">
          <strong>Error:</strong><br /><br />'. $s->__toString() .'
        </div>
      ';
    }

  }

?>