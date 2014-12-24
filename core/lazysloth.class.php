<?php

  class LazySloth extends Exception {

    private static $css_wrapper = "position:fixed;width:100%; height:100%; left:0; top:0; background:#efefef; font-family: Tahoma, Arial;";
    private static $css_header = "width100%; height:50px; background:#cd2626; border-bottom 1px solid #ddd; line-height:50px;";
    private static $css_title = "color: #fff; font-site: 1.1em; margin: 0; padding: 0 0 0 30px; text-align: left; font-weight: normal;";
    private static $css_container = "width: 60%; margin: 100px auto; border: 1px solid #ddd; border-radius: 3px;";
    private static $css_details = "padding: 20px; text-align: left; color: #333;";
    private static $css_trace = "padding: 10px 5px; font-family: monospace;";


    /**
     * Create a new error object with the given information
     * @param string $message - The error message
     * @param int $code - The error code
     */
    public function __construct($message, $code = 0) {
      if(is_object($message)){
        $this->message = $message->getMessage();
        $this->file = $message->getFile();
        $this->line = $message->getLine();
        $this->trace = $message->getTrace();
      } else {
        parent::__construct($message, $code);
        $this->trace = parent::getTrace();
      }
    }


    /**
     * Return the HTML string of this error
     */
    public function __toString() {
      return $this->build_template();
    }


    /**
     * Build the HTML strin of this error
     */
    private function build_template(){
      return '
        <div style="'.self::$css_wrapper.'">
          <div style="'.self::$css_header.'">
            <h1 style="'.self::$css_title.'">sloth-php error ('.$this->code.')</h1>
          </div>
          <div style="'.self::$css_container.'"> 
            <div style="'.self::$css_details.'"> 
              <p><strong>Error: </strong>'.$this->message.'</p>
              <p><strong>File: </strong>'.$this->file.'</p>
              <p><strong>Line: </strong>'.$this->line.'</p>
              <p><strong>Trace: </strong></p>
              <div style="'.self::$css_trace.'">'.$this->build_stacktrace().'</div>
            </div>
          </div>
        </div>
      ';
    }


    /**
     * Build the stacktrace strings
     */
    private function build_stacktrace(){
      $trace_meta = "";

      foreach($this->trace as $trace){
        $trace_meta .= $trace['file'].'<br />&nbsp;'.$this->line_number($trace['line']);
        $trace_meta .= '<strong>'.$trace['class'].$trace['type'].$trace['function'].'();';
        $trace_meta .= '</strong><br /><br />';
      }

      // Error easteregg to make developers happy
      $trace_meta .= '/hidden/place/somewhere/out/there/in/the/universe<br/>';
      $trace_meta .= '&nbsp;1337&nbsp;&nbsp;<strong>Sloth::rule_the_world();</strong>';

      return $trace_meta;
    }


    /**
     * Line number formatting helper
     * @param int $number - The given line number
     */
    private function line_number($number){
      $number_meta = strlen($number."");
      return str_repeat("&nbsp;", 4 - $number_meta).$number.'&nbsp;&nbsp;';
    }


  }

?>