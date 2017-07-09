<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 

  require_once(__ROOT__.'/inc/vars.php');
  require_once(__ROOT__.'/inc/db/class.DBPDO.php');

  require __ROOT__.'/inc/mcuamb_cookies.php';
  require __ROOT__.'/inc/class.ambassador.php';
  // require __ROOT__.'/inc/sendmail.php';
  require __ROOT__.'/templates/leaderboard.php';
  require __ROOT__.'/templates/activity.php';

  try {
    $con = new DBPDO();
  } catch (Exception $e) {
    echo 'There was an issue establishing a connection with the Database. Please contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for assistance.';
  }

  $domain = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

  $loggedin = mcuamb_loginState($con);

  if ($loggedin) {
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
    global $loggedin;
    
    if (!$loggedin) {
      $location = 'Location: ' . $loc;
      header($location);
    }
  }

  function redirectIfLoggedIn($loc) {
    global $loggedin;
    
    if ($loggedin) {
      $location = 'Location: ' . $loc;
      header($location);
    }
  }

  function getLevels() {
    global $con;

    $levels = $con->fetchAll("SELECT * FROM cu_amb_status ORDER BY sid ASC");

    return $levels;
  }







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