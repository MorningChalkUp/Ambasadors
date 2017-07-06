<?php

  require '../inc/functions.php';

  $input = $_POST['username'];

  if (validateEMAIL($input)) {
    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE email = ?", $input);
  } else {
    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $input);
  }

  if (!$u) {
    $location = 'Location: confirm.php';
    header($location);
    die();
  }

  /* Add To Table */
  /* Table: prid (auto), aid, token (md5-un), request-time (now), expire_time (now+1 day)*/
  $now = time();
  $request = array(
    'aid' => $u['aid'],
    'token' => md5($u['username']),
    'request_time' => date("Y-m-d H:i:s", $now),
    'expire_time' => date("Y-m-d H:i:s",strtotime('+1 day', $now))
  ); 

  $r = $con->execute("INSERT INTO cu_amb_password_request(aid, token, request_time, expire_time) VALUES(:aid, :token, :request_time, :expire_time)", $request);

  /* Send Email */
  sendPasswordReset($u['aid'], $request['token'], $domain);

  $location = 'Location: confirm.php?email=' . $u['email'];
  header($location);


  function validateEMAIL($EMAIL) {
    if (filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) { 
      return true; 
    } else {
      return false;
    }
  }