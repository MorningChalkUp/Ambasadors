<?php
require '../inc/functions.php';

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
     /* else {
        if (limitSignup($data['email'])) {
          $error[] = 'no-signup';
        }
      }*/
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
    die();
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
    'join_time' => date("Y-m-d H:i:s"),
  );

  /* Execute Insert */
  $r = $con->execute("INSERT INTO cu_amb_usr(fullname, fname, lname, email, password, username, join_time) VALUES(:fullname, :fname, :lname, :email, :password, :username, :join_time)", $user);

  /* Check If Successful */
  if ($con->lastInsertId() == 0) {
    echo 'There was an issue adding this user to the database';
    die();
  }

/*Create User Cookie */
  
  mcuamb_setUserCookie($user['username'], $user['password']);

/* Send to Dashboard */
  
  $location = 'Location: /dashboard/';
  header($location);



/* Utility Functions */

function limitSignup($email) {
  global $con;

  $allowed = $con->fetchAll("SELECT email FROM cu_amb_allowed_signup");

  foreach ($allowed as $user) {
    if (strtolower($user['email']) == strtolower($email)) {
      echo 'in';
      return false;
    }
  }
  
  return true;

}