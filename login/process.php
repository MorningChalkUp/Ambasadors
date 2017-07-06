<?php
define('__ROOT__', dirname(dirname(__FILE__))); 

require_once(__ROOT__.'/inc/vars.php');
require_once(__ROOT__.'/inc/db/class.DBPDO.php');
require '../inc/mcuamb_cookies.php';


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
    $location = 'Location: ' . $_POST['URL'] . '?e=1';
    header($location);
    die();
  }

/* set cookie */
  mcuamb_setUserCookie($_POST['username'], $u['password'], $remember = $_POST['remember']);

/* go to dashboard */
  $location = 'Location: /dashboard/';
  header($location);