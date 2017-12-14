<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 

  require_once(__ROOT__.'/inc/vars.php');
  require_once(__ROOT__.'/inc/db/class.DBPDO.php');

  require __ROOT__.'/inc/mcuamb_cookies.php';
  require __ROOT__.'/inc/class.ambassador.php';
  
  if($_SERVER['SERVER_NAME'] != 'mcu-ambassadors.dev'){
    require __ROOT__.'/inc/sendmail.php';
  }
  require __ROOT__.'/templates/leaderboard.php';
  require __ROOT__.'/templates/activity.php';
  require __ROOT__.'/inc/cm/csrest_subscribers.php';

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

  function isUser($username) {
    global $con;
    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $username);

    if ($u != false) {
      return true;
    }
    return false;
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

  function track_pageview($ip, $url, $time, $reff) {
    global $con;

    $set = array(
      'url' => $url, 
      'reff' => $reff, 
      'visit_time' => $time, 
      'ip' => $ip
    );

    $r = $con->execute("INSERT INTO cu_signup_pavgeview(url, reff, visit_time, ip) VALUES(:url, :reff, :visit_time, :ip)", $set);
  }


  function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

function isSelected($val, $type) {
  global $amb;

  $ambVal = $amb->getValue('shirt_' . $type);

  if ($ambVal == $val) {
    return 'selected';
  }
  return '';
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