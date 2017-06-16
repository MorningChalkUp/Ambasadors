<?php

require '../vars.php';
require '../db/class.DBPDO.php';

try {
  $con = new DBPDO();
} catch (Exception $e) {
  echo 'There was an issue establishing a connection with the Database';
}

/* Validate Form */

  /* check email */
  if ($_POST['username'] && $_POST['username'] != '') {
    $data['username'] = $_POST['username'];
    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $data['username']);
    if (!isset($u) || $u == false ) {
      $error = true;
    }
  } else {
    $error = true;
  }

  /* check password */
  if ($_POST['password'] && $_POST['password'] != '') {
    if (md5($_POST['password']) != $u['password']) {
      $error = true;
    }
  } else {
    $error = true;
  }

  if (isset($error) && $error) {
    foreach ($data as $k => $v) {
      $d .= $k . '=' . $v . '&';
    }
    $location = 'Location: ' . $_POST['URL'] . '?e=1&' . $d;
    header($location);
  }

/* set cookie */
  if ($_POST['remember'] == true) {
    setcookie('mcu_amb',$data['email'],time()+60*60*14,'/');
  } else {
    setcookie('mcu_amb',$data['email'],0,'/');
  }

/* go to dashboard */
  $location = 'Location: /';
  header($location);