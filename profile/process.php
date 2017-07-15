<?php

require '../inc/functions.php';

$section = $_POST['section'];
$id = $_POST['id'];

// Profile Image
if ($section == 'image') {
  dump_pre($_FILES["profile_pic"]);

  $u = $con->fetch('SELECT username FROM cu_amb_usr WHERE aid = ?', $id);

  if (isset($_FILES["profile_pic"]["name"]) && $_FILES["profile_pic"]["size"] > 0) {


    $target_dir = "../img/uploads/";
    $name = $_FILES["profile_pic"]["name"];
    $tmp = explode(".", $name);
    $filename = $u['username'] . '_' . round(microtime(true)) . '.' . end($tmp);

    $target_file = $target_dir . $filename;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check === false) {
        $loc = 'Location: /profile/update.php/?update=image&error=image';
        // header($loc);
        die();
      }
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      $loc = 'Location: /profile/update.php/?update=image&error=size';
      header($loc);
      die();
    }
    // Allow certain file formats
    if($_FILES["profile_pic"]['type'] != "image/jpg" && $_FILES["profile_pic"]['type'] != "image/png" && $_FILES["profile_pic"]['type'] != "image/jpeg" && $_FILES["profile_pic"]['type'] != "image/gif" ) {
      $loc = 'Location: /profile/update.php/?update=image&error=image';
      // header($loc);
      die();
    }

    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file);
    $set = array($filename, $id);
    $con->execute("UPDATE cu_amb_usr SET image = ? WHERE aid = ?", $set);
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
    'zip' => $zip,
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