<?php

require '../inc/functions.php';

$section = $_POST['section'];
$id = $_POST['id'];

if ($section == 'image') {

}
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

  $fname = $name[0];
  $lname = $name[1];

  $update = array(
    'fullname' => $_POST['fullname'],
    'fname' => $fname,
    'lname' => $lname,
    'address' => $_POST['address'],
    'city' => $_POST['city'],
    'state' => $_POST['state'],
    'zip' => $_POST['zip'],
    'email' => $_POST['email'],
    'size' => $_POST['size'],
  );

  foreach ($update as $value) {
    $set[] = $value;
  }

  $set[] = $id;

  $r = $con->execute('UPDATE cu_amb_usr SET fullname = ?, fname = ?, lname = ?, address = ?, city = ?, state = ?, zip = ?, email = ?, size = ? WHERE aid = ?', $set);

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