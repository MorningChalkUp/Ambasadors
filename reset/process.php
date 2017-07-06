<?php

  require '../inc/functions.php';

  $token = $_POST['token'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];

  $request = $con->fetchAll("SELECT * FROM cu_amb_password_request WHERE token = ? ORDER BY prid DESC", $token);

  $exp = strtotime($request[0]['expire_time']);

  if ($exp >= time()) {
    if ($password !== $confirmpassword) {
      $e = 'password';
    } else {
      if ($password == '' || $confirmpassword == '') {
        $e = 'empty';
      }
    }
  } else {
    $e = 'expired';
  }

  if (isset($e)) {
    $loc = 'Location: ' . $_POST['URL'] . '?token=' . $token . '&e=' . $e;
    header($loc);
    die();
  }

  $pass = md5($password);

  $r = $con->execute("UPDATE cu_amb_usr SET password = ? WHERE aid = ?", array($pass, $request[0]['aid']));

  $r = $con->execute("DELETE FROM cu_amb_password_request WHERE token = ?", $token);

  $loc = 'Location: /login/';
  header($loc);


