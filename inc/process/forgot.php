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
  if ($_POST['email'] && $_POST['email'] != '') {
    $data['email'] = $_POST['email'];
    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE email = ?", $data['email']);
    if (!isset($u) || $u == false ) {
      $error = true;
    }
  } else {
    $error = true;
  }

  /* If Error */
  if (isset($error) && $error) {
    $location = 'Location: ' . $_POST['URL'] . '?e=1&';
    header($location);
  }

/* Send Email */
  /* Set Expire Token */
  /* Email with password reset link */

/* Send to Email Sent Page */