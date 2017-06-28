<?php

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/vars.php');
require_once(__ROOT__.'/inc/db/class.DBPDO.php');

if (!isset($con)) {
  try {
    $con = new DBPDO();
  } catch (Exception $e) {
    echo 'There was an issue establishing a connection with the Database';
  }
}

function addSubscriber($user) {
  if (!isInPerson($user['email'])) {
    $person = ()

    // addPerson
  } else {
    // $pid = getPerson($email);
  }

  // addSignup

  /*if (isReferal) {
    update Ambassador
  }*/
}

function isInPerson($email) {
  global $con;

  $u = $con->fetch("SELECT email FROM cu_people WHERE email = ?", $email);

  if ($u != false) {
    return true;
  }

  return false;
}

function addPerson($person) {
  /* Add Person To cu_people */
}

function getPersonId($email) {
  /* Get Person ID from cu_people*/
}

function addSignup($signup) {
  /* Add Signup to cu_signup */
}

function updateAmbassador($username, $suid) {

}