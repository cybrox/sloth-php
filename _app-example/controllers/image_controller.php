<?php

  class ImageController extends BaseController {

    // GET "/images"
    public function list_all(){
      $user = Registry::get('user');

      $images = Image::where("user_id", "=", $user->id);
      $images->sort('id', 'desc');

      View::render_json(array("images" => $images->get()));
    }


    // POST "/images/add"
    public function add(){
      if(!Parameters::has('image')){
        View::render_json(array(
          "error" => true,
          "info" => "no image url given"
        ), true);
        return;
      }

      $user = Registry::get('user');
      $img = Parameters::get('image');

      if(Image::exists($img, $user->id)){
        View::render_json(array(
          "error" => true,
          "info" => "image already in your library"
        ), true);
        return;
      }

      Image::insert(array(
        "user_id" => $user->id,
        "link" => $img,
        "status" => 0
      ));

      View::render_json(array(
        "error" => false,
        "info" => "successfully added image"
      ));
    }


    // POST "/images/remove"
    public function remove(){
      if(!Parameters::has('image')){
        View::render_json(array(
          "error" => true,
          "info" => "no image url given"
        ), true);
        return;
      }

      $user = Registry::get('user');
      $img = Parameters::get('image');

      if(!Image::exists($img, $user->id)){
        View::render_json(array(
          "error" => true,
          "info" => "image not in your library"
        ), true);
        return;
      }

      $image = Image::where(array(
        array("user_id", "=", $user->id),
        array("link", "=", $img)
      ));
      $image->delete();

      View::render_json(array(
        "error" => false,
        "info" => "successfully removed image"
      ));
    }

  }

?>