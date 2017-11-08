<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../inc/functions.php';
require_once '../inc/cm/csrest_subscribers.php';
require '../inc/shopify.php';

function addSubscriberEvent($user) {
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

  $eid = addSignup($user);

  if (isset($user['reff']) && !$exists) {
    updateAmbassador($user['reff'], $eid, 1);
  }
}

function addAmbEvent($user) {
  $user['aid'] = getAmbId($user['email']);

  $eid = addAmbSignup($user);

  if (isset($user['reff'])) {
    updateAmbassador($user['reff'], $eid, 2);
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

function getAmbId($email) {
  global $con;

  $u = $con->fetch("SELECT aid FROM cu_amb_usr WHERE email = ?", $email);

  return $u['aid'];
}

function addSignup($signup) {
  $s = array(
    'pid' => 0,
    'url' => NULL,
    'source' => NULL,
    'medium' => NULL,
    'campaign' => NULL,
    'gclid' => NULL,
    'content' => NULL,
    'term' => NULL,
    'new_subscriber' => NULL,
    'reff' => NULL,
    'su_time' => date("Y-m-d H:i:s"),
  );

  foreach ($s as $key => $value) {
    if (isset($signup[$key])) {
      $s[$key] = $signup[$key];
    }
  }

  global $con;

  $r = $con->execute("INSERT INTO cu_form_event(pid, url, utm_source, utm_medium, utm_campaign, gclid, utm_content, utm_term, new_subscriber, reff_user, su_time) VALUES(:pid, :url, :source, :medium, :campaign, :gclid, :content, :term, :new_subscriber, :reff, :su_time)", $s);

  if ($con->lastInsertId() == 0) {
    echo 'There was an issue adding your signup to the database. Please contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for help.';
    die();
  }

  return $con->lastInsertId();
}

function addAmbSignup($signup) {
  $s = array(
    'aid' => 0,
    'url' => NULL,
    'source' => NULL,
    'medium' => NULL,
    'campaign' => NULL,
    'gclid' => NULL,
    'content' => NULL,
    'term' => NULL,
    'reff' => NULL,
    'su_time' => date("Y-m-d H:i:s"),
  );

  foreach ($s as $key => $value) {
    if (isset($signup[$key])) {
      $s[$key] = $signup[$key];
    }
  }

  global $con;

  echo "<pre>";
  var_dump($s);
  echo "</pre>";

  $r = $con->execute("INSERT INTO cu_form_event(aid, url, utm_source, utm_medium, utm_campaign, gclid, utm_content, utm_term, reff_user, su_time) VALUES(:aid, :url, :source, :medium, :campaign, :gclid, :content, :term, :reff, :su_time)", $s);

   echo "<pre>";
  var_dump($r);
  echo "</pre>";

  if ($con->lastInsertId() == 0) {
    echo 'There was an issue adding your signup to the database. Please contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for help.';
    die();
  }

  return $con->lastInsertId();
}

function updateAmbassador($username, $eid, $pvalid) {
  global $con;

  $amb = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $username);

  $points = $con->fetch("SELECT * FROM cu_amb_point_value WHERE pvalid = ?" , $pvalid);

  if ($amb) {

    $su_points = array(
      'aid' => $amb['aid'],
      'pvalid' => $pvalid,
      'eid' => $eid,
    );

    $amb_points = $con->execute("INSERT INTO cu_amb_points(aid, pvalid, eid) VALUES(:aid, :pvalid, :eid)", $su_points);

    $status = $con->fetch("SELECT points_max FROM cu_amb_status WHERE sid = ?", $amb['sid']);
    

    $level_up = false;
    $amb['points'] += $points['points'];
    if ($status['points_max'] < $amb['points']) {
      ++$amb['sid'];
      $level_up = true;
    }

    $con->execute("UPDATE cu_amb_usr SET points = ?, sid =? WHERE username = ?", array($amb['points'], $amb['sid'], $username));

    $new_status = $con->fetch("SELECT reward, product_id FROM cu_amb_status WHERE sid = ?", $amb['sid']);

    var_dump($new_status);

    $next_status = $con->fetch("SELECT points_min, reward FROM cu_amb_status WHERE sid = ?", $amb['sid']+1);

    $auth = array('api_key' => CM_API_KEY);
    $ambWrap = new CS_REST_Subscribers(CM_AMB_LIST_ID, $auth);

    $result = $ambWrap->update($amb['email'], array(
      'CustomFields' => array(
        array(
          'Key' => 'Points',
          'Value' => (int)$amb['points']
        ),
        array(
          'Key' => 'Current Level Reward',
          'Value' => $new_status['reward'],
        ),
        array(
          'Key' => 'Points Needed',
          'Value' => (int)$next_status['points_min'] - (int)$amb['points'],
        ),
        array(
          'Key' => 'Next Level Reward',
          'Value' => $next_status['reward'],
        ),
      ),
    ));

    if ($level_up) {
      sendLevelUpdate($amb['aid'], $amb['sid'], (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]");
      if (isset($new_status['product_id']) && $new_status['product_id'] != NULL) {
        sendShopifyOrder($amb, $new_status['product_id']);
      }
    }
  }
}