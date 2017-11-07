<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../inc/functions.php';

  $data['filename'] = $_POST['file'];
  $data['pos_x'] = $_POST['pos_x'];
  $data['pos_y'] = $_POST['pos_y'];
  $data['width'] = $_POST['width'];
  $data['height'] = $_POST['height'];
  $data['new_width'] = $_POST['img_width'];
  $data['new_height'] = $_POST['img_height'];

  $src = '../../img/uploads/raw/' . $data['filename'];

  $info = getimagesize($src);

  $width    = $info[0];
  $height   = $info[1];
  $mime     = $info['mime'];
  
  $data['new_height'] = ($height / $width) * $data['new_width'];
  
  $type = substr(strrchr($mime, '/'), 1);
  switch ($type){
    case 'jpeg':
      $image_create_func = 'imagecreatefromjpeg';
      $image_save_func = 'imagejpeg';
      $new_image_ext = 'jpg';
      break;
    case 'png':
      $image_create_func = 'imagecreatefrompng';
      $image_save_func = 'imagepng';
      $new_image_ext = 'png';
      break;
    case 'bmp':
      $image_create_func = 'imagecreatefrombmp';
      $image_save_func = 'imagebmp';
      $new_image_ext = 'bmp';
      break;
    case 'gif':
      $image_create_func = 'imagecreatefromgif';
      $image_save_func = 'imagegif';
      $new_image_ext = 'gif';
      break;
    default:
      $image_create_func = 'imagecreatefromjpeg';
      $image_save_func = 'imagejpeg';
      $new_image_ext = 'jpg';
  }

  $image_c = imagecreatetruecolor($data['new_width'], $data['new_height']);

  $new_image = $image_create_func($src);
  imagecopyresampled($image_c, $new_image, 0, 0, 0, 0, $data['new_width'], $data['new_height'], $width, $height);
  $save_path = '../../img/uploads/resized/' . $data['filename'];
  $image_save_func($image_c, $save_path);



  $info = getimagesize($save_path);

  $width    = $info[0];
  $height   = $info[1];
  $mime     = $info['mime'];

  $image_c = imagecreatetruecolor($data['width'], $data['height']);

  $new_image = $image_create_func($save_path);
  imagecopyresampled($image_c, $new_image, 0, 0, $data['pos_x'], $data['pos_y'], $data['width'], $data['height'], $data['width'], $data['height']);
  $save_path = '../../img/uploads/' . $data['filename'];
  $image_save_func($image_c, $save_path);

  global $amb;

  $id = $amb->getValue('id');

  $set = array($data['filename'], $id);
  $con->execute("UPDATE cu_amb_usr SET image = ? WHERE aid = ?", $set);