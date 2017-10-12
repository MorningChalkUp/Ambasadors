<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/vars.php');
include('../inc/chalkup_db.php');
include('../inc/mc.php');

$data['url']      = $_POST['URL'];
$data['source']   = $_POST['UTM_SOURCE'];
$data['medium']   = $_POST['UTM_MEDIUM'];
$data['campaign'] = $_POST['UTM_CAMP'];
$data['gclid']    = $_POST['GCLID'];
// $data['content']  = $_POST['utm_content'];
// $data['term']     = $_POST['utm_term'];
$data['reff']     = $_POST['reff'];

$query = '';

if (isset($data['source']) && $data['source'] != '') {
$query .= 'utm_source=' . $data['source'] . '&';
}
if (isset($data['medium']) && $data['medium'] != '') {
$query .= 'utm_medium=' . $data['medium'] . '&';
}
if (isset($data['campaign']) && $data['campaign'] != '') {
$query .= 'utm_campaign=' . $data['campaign'] . '&';
}
if (isset($data['gclid']) && $data['gclid'] != '') {
$query .= 'gclid=' . $data['gclid'] . '&';
}
if (isset($data['content']) && $data['content'] != '') {
$query .= 'utm_content=' . $data['content'] . '&';
}
if (isset($data['term']) && $data['term'] != '') {
$query .= 'utm_term=' . $data['term'] . '&';
}
if (isset($data['reff']) && $data['reff'] != '') {
$query .= 'reff=' . $data['reff'] . '&';
}

$e = '';

if ($_POST['full-name'] && $_POST['full-name'] != '') {
  $data['full-name'] = $_POST['full-name'];
  $dat['full-name'] = $data['full-name'];
} else {
  $error[] = 'full-name';
}
if ($_POST['email'] && $_POST['email'] != '') {
  $data['email'] = $_POST['email'];
  $dat['email'] = $data['email'];
} else {
  $error[] = 'email';
}
if (isset($_POST['about']) && $_POST['about'] != '') {
  $data['about'] = $_POST['about'];
  $dat['about'] = $data['about'];
} else {
  // $data['about'] = 'CrossFit Fan!';
  $error[] = 'about';
}
if (isset($_POST['website']) && $_POST['website'] != '') {
  $data['website'] = $_POST['website'];
  $dat['website'] = $data['website'];
} else {
  $data['website'] = '';
}
if (isset($_POST['affiliate']) && $_POST['affiliate'] != '') {
  $data['affiliate'] = $_POST['affiliate'];
  $dat['affiliate'] = $data['affiliate'];
} else {
  $data['affiliate'] = '';
}
if (isset($_POST['us']) || isset($_POST['eu'])) {
  if (isset($_POST['us'])) {
    $data['us'] = true;
    $dat['us'] = $data['us'];
  } else {
    $data['us'] = '';
  }
  if (isset($_POST['eu'])) {
    $data['eu'] = true;
    $dat['eu'] = $data['eu'];
  } else {
    $data['eu'] = '';
  }
} else {
  $error[] = 'list';
}

if (isset($error)) {
  foreach ($error as $err) {
    $e .= 'e[' . $err . ']=1&';
  }
  foreach ($dat as $k => $v) {
    $d .= $k . '=' . $v . '&';
  }
  $location = 'Location: ' . $_POST['URL'] . '?' . $query . $d . trim($e, '&');
  header($location);
  die();
}

$data['sub'] = 'sub';
$data['new_subscriber'] = true;

$name = explode(' ',$data['full-name']);

if (!isset($name[1])) {
  $name[1] = '';
}

$data['fname'] = $name[0];
$data['lname'] = $name[1];

$mc_data = array(
  'email_address'   =>  $data['email'],
  'FNAME'           =>  $name[0],
  'LNAME'           =>  $name[1],
  'ABOUT'           =>  $data['about'],
  'URL'             =>  $data['url'],
  'UTM_SOURCE'      =>  $data['source'],
  'UTM_MEDIUM'      =>  $data['medium'],
  'UTM_CAMP'        =>  $data['campaign'],
  'GCLID'           =>  $data['gclid'],
  'ZIP'             =>  '',
  'WEBSITE'         =>  $data['website'],
  'AFFILIATE'       =>  $data['affiliate'],
  'COUNTRY'         =>  '',
  'us'              =>  $data['us'],
  'europe'          =>  $data['eu'],
  'alerts'          =>  false,
);

$status = mc_get_status($data['email']);

if(!isset($data['sub']) || $data['sub'] == '') {
  if ($status['status'] == 'subscribed' || $status['status'] == 'pending') {
    $data['subscribed'] = true;
    $mcid = mc_add_member($mc_data);
  } else {
    $data['subscribed'] = false;
    $mcid = null;
  }
} else {
  if ($status['status'] != 'subscribed') {
    $data['new_subscriber'] = true;
  }
  $data['subscribed'] = true;
  $mcid = mc_add_member($mc_data);
}



/* Add To chalk DB */
addSubscriber($data);


$location = 'Location: thankyou?fname=' . $name[0];

header($location);

