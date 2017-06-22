<?php

require '../inc/vars.php';
require '../inc/db/class.DBPDO.php';

try {
  $con = new DBPDO();
} catch (Exception $e) {
  echo 'There was an issue establishing a connection with the Database';
}

/* Validate Info */

  $e = '';

  /* Full Name -> First and Last */
  if ($_POST['full-name'] && $_POST['full-name'] != '') {
    $data['full-name'] = $_POST['full-name'];
    $dat['full-name'] = $data['full-name'];
  
    $name = explode(' ',$data['full-name']);

    if (!isset($name[1])) {
      $name[1] = '';
    }

    $data['first-name'] = $name[0];
    $data['last-name'] = $name[1];
  } else {
    $error[] = 'full-name';
  }

  /* Regex Email Address And Does email Exist */
  if ($_POST['email'] && $_POST['email'] != '') {
    if (validateEMAIL($_POST['email'])) {
      $data['email'] = $_POST['email'];
      $dat['email'] = $data['email'];
      $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE email = ?", $data['email']);
      if (isset($u) && $u != false) {
        $error[] = 'email-exists';
      }
    } else {
      $error[] = 'email';
    }
  } else {
    $error[] = 'email';
  }

  /* password match */
  if ($_POST['password'] && $_POST['password'] != '') {
    $data['password']  = $_POST['password'];
  } else {
    $error[] = 'password';
  }
  if ($_POST['conf-password'] && $_POST['conf-password'] != '') {
    $data['conf-password']  = $_POST['conf-password'];
  } else {
    $error[] = 'conf-password';
  }
  if ($data['password'] && $data['conf-password']) {
    if ($data['password'] !== $data['conf-password']) {
      $error[] = 'no-match';
    }
  }

  /* Username Required and Doesn't Exist */
  if ($_POST['username'] && $_POST['username'] != '') {
    $data['username'] = $_POST['username'];
    $dat['username'] = $data['username'];

    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $data['username']);
    if (isset($u) && $u != false) {
      $error[] = 'username-exists';
    }
  } else {
    $error[] = 'username';
  }

  /* If Errors - Return to signup page */
  if (isset($error)) {
    foreach ($error as $err) {
      $e .= 'e[' . $err . ']=1&';
    }
    foreach ($dat as $k => $v) {
      $d .= $k . '=' . $v . '&';
    }
    $location = 'Location: ' . $_POST['URL'] . '?' . $d . trim($e, '&');
    header($location);
  }

/* Create User Referal ID */

  /* substr(md5(EMAIL),rand(0,26),5); */
  $data['ref'] = substr(md5($data['email']),rand(0,26),5);

/* Add to DB */
  
  /* Set User Info */
  $user = array(
    'fullname' => $data['full-name'],
    'fname' => $data['first-name'],
    'lname' => $data['last-name'],
    'email' => $data['email'],
    'password' => md5($data['password']),
    'username' => $data['username'],
  );

  dump_pre($user);

  /* Execute Insert */
  $r = $con->execute("INSERT INTO cu_amb_usr(fullname, fname, lname, email, password, username) VALUES(:fullname, :fname, :lname, :email, :password, :username)", $user);

  dump_pre($r);

  dump_pre($con->lastInsertId());

  /* Check If Successful */
  if ($con->lastInsertId() == 0) {
    echo 'There was an issue adding this user to the database';
    die();
  }

/*Create User Cookie */
  
  setcookie('mcu_amb',$data['email'],time()+60*60,'/');

/* Send to Dashboard */
  
  $location = 'Location: /dashboard/';
  header($location);



/* Utility Functions */

function validateEMAIL($EMAIL) {
  if (filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) { 
    return true; 
  } else {
    return false;
  }
}

function dump_pre($VAL) {
  echo '<pre>';
  var_dump($VAL);
  echo '</pre>';
}