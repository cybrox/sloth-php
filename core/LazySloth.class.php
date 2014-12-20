<?php

  class LazySloth extends Exception {

    public function __construct($message, $code = 0) {
      parent::__construct($message, $code);
    }

    public function __toString() {
      return "({$this->code}) {$this->message}<br />{$this->file}";
    }

  }

?>