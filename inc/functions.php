<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 

  require_once(__ROOT__.'/inc/vars.php');
  require_once(__ROOT__.'/inc/db/class.DBPDO.php');

  require 'mcuamb_cookies.php';
  require 'class.ambassador.php';

  try {
    $con = new DBPDO();
  } catch (Exception $e) {
    echo 'There was an issue establishing a connection with the Database. Please contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for assistance.';
  }

  $logedin = mcuamb_loginState($con);

  if ($logedin) {
    $username = mcuamb_getUsername();
    $amb = new Ambassador;
    $amb->setUser($username, $con);
  }

  function getLeaders($num, $con) {
    $leaders = $con->fetchAll("SELECT * FROM cu_amb_usr ORDER BY points DESC");

    $return = array_slice($leaders, 0, $num);

    return $return;
  }

  function redirectIfLoggedOut($loc) {
    global $logedin;
    
    if (!$logedin) {
      $location = 'Location: ' . $loc;
      header($location);
    }
  }