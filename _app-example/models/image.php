<?php

  class Image extends BaseModel {

    public static function exists($url, $user){
      $image = self::where(array(
        array("user_id", "=", $user),
        array("link", "=", $url),
      ));

      return (intval($image->count()) > 0);
    }

  }

?>