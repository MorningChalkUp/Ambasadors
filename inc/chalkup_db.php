<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../inc/functions.php';

function addSubscriber($user) {
  if (!isInPerson($user['email'])) {
    $user['mcid'] = md5($user['email']);
    addPerson($user);
    $exists = false;
  } else {
    $exists = true;
  }
  
  $user['pid'] = getPersonId($user['email']);
  
  if (!isset($user['new_subscriber'])) {
    $user['new_subscriber'] = 1;
  }

  $suid = addSignup($user);

  if (isset($user['reff']) && !$exists) {
    updateAmbassador($user['reff'], $suid, 1);
  }
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
  $p = array(
    'email' => NULL,
    'fname' => NULL,
    'lname' => NULL,
    'about' => NULL,
    'city' => NULL,
    'state' => NULL,
    'zip' => NULL,
    'country' => NULL,
    'subscribed' => NULL,
    'reff' => NULL,
  );

  foreach ($p as $key => $value) {
    if (isset($person[$key])) {
      $p[$key] = $person[$key];
    }
  }
  if (isset($person['email'])) {
    global $con;

    if (!isInPerson($person['email'])) {
      $r = $con->execute("INSERT INTO cu_people(email, fname, lname,  about, city, state, zip, country, subscribed, first_reff) VALUES(:email, :fname, :lname, :about, :city, :state, :zip, :country, :subscribed, :reff)", $p);
      var_dump($con->lastInsertId());
      if ($con->lastInsertId() == 0) {
        echo 'There was an issue adding you to the database. Please contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for help.';
        die();
      }
    }
    return true;
  }
  return false;
}

function getPersonId($email) {
  global $con;

  $u = $con->fetch("SELECT pid FROM cu_people WHERE email = ?", $email);

  return $u['pid'];
}

function addSignup($signup) {
  $s = array(
    'pid' => 0,
    'mcid' => NULL,
    'url' => NULL,
    'source' => NULL,
    'medium' => NULL,
    'campaign' => NULL,
    'gclid' => NULL,
    'content' => NULL,
    'term' => NULL,
    'new_subscriber' => 1,
    'reff' => NULL,
    'su_time' => date("Y-m-d H:i:s"),
  );

  foreach ($s as $key => $value) {
    if (isset($signup[$key])) {
      $s[$key] = $signup[$key];
    }
  }

  global $con;

  $r = $con->execute("INSERT INTO cu_signup(pid, mcid, url, utm_source, utm_medium, utm_campaign, gclid, utm_content, utm_term, new_subscriber, reff_user, su_time) VALUES(:pid, :mcid, :url, :source, :medium, :campaign, :gclid, :content, :term, :new_subscriber, :reff, :su_time)", $s);

  if ($con->lastInsertId() == 0) {
    echo 'There was an issue adding your signup to the database. Please contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for help.';
    die();
  }

  return $con->lastInsertId();
}

function updateAmbassador($username, $suid, $points) {
  global $con;

  $amb = $con->fetch("SELECT aid, points, sid, email FROM cu_amb_usr WHERE username = ?", $username);

  if ($amb) {

    $su_points = array(
      'aid' => $amb['aid'],
      'points' => $points,
      'suid' => $suid,
    );

    $amb_points = $con->execute("INSERT INTO cu_amb_points(aid, points, suid) VALUES(:aid, :points, :suid)", $su_points);

    $status = $con->fetch("SELECT points_max FROM cu_amb_status WHERE sid = ?", $amb['sid']);

    if ($status['points_max'] < $amb['points'] + $points) {
      ++$amb['sid'];
    }

    $con->execute("UPDATE cu_amb_usr SET points = ?, sid =? WHERE username = ?", array($amb['points'] + $points, $amb['sid'], $username));

    $auth = array('api_key' => CM_API_KEY);
    $ambWrap = new CS_REST_Subscribers(CM_AMB_LIST_ID, $auth);

    $result = $ambWrap->update($amb['email'], array(
      'CustomFields' => array(
        array(
          'Key' => 'Points',
          'Value' => $amb['points'] + $points
        )
      ),
    ));

    if ($status['points_max'] < $amb['points'] + $points) {
      sendLevelUpdate($amb['aid'], $amb['sid'], (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]");
    }
  }
}