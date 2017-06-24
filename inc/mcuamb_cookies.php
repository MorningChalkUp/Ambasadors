<?php
require 'cookies.php';

$cookie_timeout = time()+60*60*14;

function mcuamb_setUserCookie($useername, $password, $remember = false) {
  if ($remember) {
    cookie_create('mcu_amb_user', $useername, $cookie_timeout);
    cookie_create('mcu_amb_pass', $password, $cookie_timeout);
  } else {
    cookie_create('mcu_amb_user', $useername);
    cookie_create('mcu_amb_pass', $password);
  }

  return mcuamb_loginState();
}

function mcuamb_getUsername() {
  $value = cookie_read('mcu_amb_user');
  return $value;
}

function mcuamb_loginState($con) {
  $username = cookie_read('mcu_amb_user');
  if (!$username) {
    return false;
  }
  $password = cookie_read('mcu_amb_pass');
  if (!$username) {
    return false;
  }

  if (!isset($con)) {
    try {
      $con = new DBPDO();
    } catch (Exception $e) {
      echo 'There was an issue establishing a connection with the Database';
    }
  }

  $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $username);
  
  if ($password != $u['password']) {
    return false;
  }

  return true;

}

function mcuamb_logout() {
  cookie_expire('mcu_amb_user');
  cookie_expire('mcu_amb_pass');
}