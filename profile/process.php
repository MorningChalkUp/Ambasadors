<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../inc/functions.php';

$section = $_POST['section'];
$id = $_POST['id'];

// Profile Image
if ($section == 'image') {
  dump_pre($_FILES["profile_pic"]);

  $u = $con->fetch('SELECT username FROM cu_amb_usr WHERE aid = ?', $id);

  if (isset($_FILES["profile_pic"]["name"]) && $_FILES["profile_pic"]["size"] > 0) {


    $target_dir = "../img/uploads/raw/";
    $name = $_FILES["profile_pic"]["name"];
    $tmp = explode(".", $name);
    $filename = $u['username'] . '_' . round(microtime(true)) . '.' . end($tmp);

    $target_file = $target_dir . $filename;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
      if($check === false) {
        $loc = 'Location: /profile/update.php/?update=image&error=image';
        header($loc);
        die();
      }
    }
    // Check file size
    if ($_FILES["profile_pic"]["size"] > 5000000) {
      $loc = 'Location: /profile/update.php/?update=image&error=size';
      header($loc);
      die();
    }
    // Allow certain file formats
    if($_FILES["profile_pic"]['type'] != "image/jpg" && $_FILES["profile_pic"]['type'] != "image/png" && $_FILES["profile_pic"]['type'] != "image/jpeg" && $_FILES["profile_pic"]['type'] != "image/gif" ) {
      $loc = 'Location: /profile/update.php/?update=image&error=image';
      header($loc);
      die();
    }

    $type = substr(strrchr($_FILES["profile_pic"]['type'], '/'), 1);
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

    $image = $image_create_func($_FILES["profile_pic"]["tmp_name"]);

    if($_FILES["profile_pic"]['type'] == 'image/jpeg') {
      $exif = exif_read_data($_FILES["profile_pic"]["tmp_name"]);
      if(isset($exif['Orientation'])) {
        $orientation = $exif['Orientation'];
      }
    }

    if(isset($orientation)) {
      switch($orientation) {
        case 3:
          $image = imagerotate($image, 180, 0);
          break;
        case 6:
          $image = imagerotate($image, -90, 0);
          break;
        case 8:
          $image = imagerotate($image, 90, 0);
          break;
      }
    }

    $image_save_func($image, $target_file);

    $loc = 'Location: /profile/crop/?img=' . $filename;
    header($loc);
    die();

  } else {
    $default = 'person.png';
    $set = array($default, $id);
    $con->execute("UPDATE cu_amb_usr SET image = ? WHERE aid = ?", $set);
  }
  
}

// Personal Information
if ($section == 'personal') {
  $name = explode(' ',$_POST['fullname']);
  $email = explode(' ',$_POST['email']);

  $u = $con->fetch('SELECT email FROM cu_amb_usr WHERE aid = ?', $id);
  $test = $con->fetch('SELECT aid FROM cu_amb_usr WHERE email = ?', $email);

  if ($u['email'] != $email) {
    if ($test != false && $id != $test['aid']) {
      $loc = 'Location: /profile/update.php/?update=personal&error=email';
      header($loc);
      die();
    }
  }

  if (!isset($name[1])) {
    $name[1] = '';
  }

  $update = array(
    'fullname' => $_POST['fullname'],
    'fname' => $name[0],
    'lname' => $name[1],
    'address' => $_POST['address'],
    'city' => $_POST['city'],
    'state' => $_POST['state'],
    'zip' => $_POST['zip'],
    'email' => $_POST['email'],
    'size' => $_POST['size'],
  );

  foreach ($update as $value) {
    if ($value == '') {
      $value = null;
    }
    $set[] = $value;
  }

  $set[] = $id;

  dump_pre($set);

  $r = $con->execute('UPDATE cu_amb_usr SET fullname = ?, fname = ?, lname = ?, address = ?, city = ?, state = ?, zip = ?, email = ?, size = ? WHERE aid = ?', $set);

  dump_pre($r);

}
if ($section == 'unpw') {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $u = $con->fetch('SELECT password, username FROM cu_amb_usr WHERE aid = ?', $id);
  $test = $con->fetch('SELECT aid FROM cu_amb_usr WHERE username = ?', $username);

  if ($u['username'] != $username) {
    if ($test != false && $id != $test['aid']) {
      $loc = 'Location: /profile/update.php/?update=unpw&error=username';
      header($loc);
      die();
    }
  }

  if ($password != $u['password']) {
    $password = md5($password);
  }

  $update = array(
    'username' => $username,
    'password' => $password,
  );

  foreach ($update as $value) {
    $set[] = $value;
  }

  $set[] = $id;

  $r = $con->execute('UPDATE cu_amb_usr SET username = ?, password = ? WHERE aid = ?', $set);

  mcuamb_logout();
  mcuamb_setUserCookie($update['username'], $update['password'], true);
  
}



$loc = 'Location: /profile/?updated=1';
header($loc);


function makeThumb( $filename , $thumbSize=100 ){
  global $max_width, $max_height;
 /* Set Filenames */
  $srcFile = '../img/uploads/original/'.$filename;
  $thumbFile = '../img/uploads/'.$filename;
 /* Determine the File Type */
  $type = substr( $filename , strrpos( $filename , '.' )+1 );
 /* Create the Source Image */
  switch( $type ){
    case 'jpg' : case 'jpeg' :
      $src = imagecreatefromjpeg( $srcFile ); break;
    case 'png' :
      $src = imagecreatefrompng( $srcFile ); break;
    case 'gif' :
      $src = imagecreatefromgif( $srcFile ); break;
  }
 /* Determine the Image Dimensions */
  $oldW = imagesx( $src );
  $oldH = imagesy( $src );
 /* Calculate the New Image Dimensions */
  if( $oldH > $oldW ){
   /* Portrait */
    $newW = $thumbSize;
    $newH = $oldH * ( $thumbSize / $newW );
  }else{
   /* Landscape */
    $newH = $thumbSize;
    $newW = $oldW * ( $thumbSize / $newH );
  }
 /* Create the New Image */
  $new = imagecreatetruecolor( $thumbSize , $thumbSize );
 /* Transcribe the Source Image into the New (Square) Image */
  imagecopyresampled( $new , $src , 0 , 0 , ( $newW-$thumbSize )/2 , ( $newH-$thumbSize )/2 , $thumbSize , $thumbSize , $oldW , $oldH );
  switch( $type ){
    case 'jpg' : case 'jpeg' :
      $src = imagejpeg( $new , $thumbFile ); break;
    case 'png' :
      $src = imagepng( $new , $thumbFile ); break;
    case 'gif' :
      $src = imagegif( $new , $thumbFile ); break;
  }
  imagedestroy( $new );
  imagedestroy( $src );
}