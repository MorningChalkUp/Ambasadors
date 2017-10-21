<?php

require_once '../inc/vars.php';
include('../inc/chalkup_db.php');
require_once 'cm/csrest_subscribers.php';

$auth = array('api_key' => CM_API_KEY);
$wrap = new CS_REST_Subscribers(CM_MCU_LIST_ID, $auth);

$data['url']      = isset($_POST['URL']) ? $_POST['URL'] : '';
$data['source']   = isset($_POST['UTM_SOURCE']) ? $_POST['UTM_SOURCE'] : '';
$data['medium']   = isset($_POST['UTM_MEDIUM']) ? $_POST['UTM_MEDIUM'] : '';
$data['campaign'] = isset($_POST['UTM_CAMP']) ? $_POST['UTM_CAMP'] : '';
$data['gclid']    = isset($_POST['GCLID']) ? $_POST['GCLID'] : '';
$data['content']  = isset($_POST['utm_content']) ? $_POST['utm_content'] : '';
$data['term']     = isset($_POST['utm_term']) ? $_POST['utm_term'] : '';
$data['reff']     = isset($_POST['reff']) ? $_POST['reff'] : '';
$data['fbid']     = isset($_POST['FBID']) ? $_POST['FBID'] : '';

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
if (isset($_POST['zip']) && $_POST['zip'] != '') {
  $data['zip'] = $_POST['zip'];
  $dat['zip'] = $data['zip'];
  $location = getLocation($data['zip']);
  $data['city'] = isset($location['city']) ? $location['city'] : '';
  $data['state'] = isset($location['state']) ? $location['state'] : '';
  $data['country'] = isset($location['country']) ? $location['country'] : '';
} else {
  $data['zip'] = '';
  $error[] = 'zip';
}
if (isset($_POST['affiliate']) && $_POST['affiliate'] != '') {
  $data['affiliate'] = $_POST['affiliate'];
  $dat['affiliate'] = $data['affiliate'];
} else {
  $data['affiliate'] = '';
}
if (isset($_POST['about']) && $_POST['about'] != '') {
  $data['about'] = $_POST['about'];
  $dat['about'] = $data['about'];
} else {
  $error[] = 'about';
}
if (isset($_POST['us']) || isset($_POST['eu'])) {
  if (isset($_POST['us'])) {
    $data['us'] = 1;
    $dat['us'] = $data['us'];
  } else {
    $data['us'] = '';
  }
  if (isset($_POST['eu'])) {
    $data['eu'] = 1;
    $dat['eu'] = $data['eu'];
  } else {
    $data['eu'] = '';
  }
} else {
  $error[] = 'list';
}

if (isset($error) && (!isset($_POST['FBID']) || $data['fbid'] == '')) {
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

$cm_data = array(
  'EmailAddress'    =>  $data['email'],
  'Name'            =>  $data['full-name'],
  'Resubscribe'     =>  true,
);

$fields = array(
  'About'           =>  $data['about'],
  'URL'             =>  $data['url'],
  'utm_source'      =>  $data['source'],
  'utm_medium'      =>  $data['medium'],
  'utm_campaign'    =>  $data['campaign'],
  'Zip Code'        =>  $data['zip'],
  'City'            =>  $data['city'],
  'State'           =>  $data['state'],
  'Country'         =>  $data['country'],
  'US Edition'      =>  $data['us'],
  'EU Edition'      =>  $data['eu'],
  'FBID'            =>  $data['fbid'],
  'Affiliate'       =>  $data['affiliate'],
  'Reff'            =>  $data['reff'],
);

$cm_custom_fields = array();

foreach ($fields as $key => $value) {
  if (isset($value) && ($value != NULL || $value != '')) {
    array_push(
      $cm_custom_fields, 
      array('key' => $key, 'value' => $value)
    );
  }
}

$cm_data['CustomFields'] = $cm_custom_fields;

$result = $wrap->add($cm_data);

$data['subscribed'] = false;
echo "Result of POST /api/v3.1/subscribers/{list id}.{format}\n<br />";
if($result->was_successful()) {
    echo "Subscribed with code ".$result->http_status_code;
    $data['subscribed'] = true;
} else {
    echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
    var_dump($result->response);
    echo '</pre>';
    die();
}

/* Add To chalk DB */
addSubscriber($data);

$location = 'Location: thankyou?fname=' . $name[0];

header($location);

function getLocation($zip) {
  $key = 'AIzaSyBwTd5GESfcwrhWMp1oaIcWqeKkERZDrxc';
  $url = 'https://maps.googleapis.com/maps/api/geocode/json';

  $call = $url . '?address=' . $zip . '&key=' . $key;

  $result = file_get_contents($call);
  $data = json_decode($result, true);

  foreach ($data['results'][0]['address_components'] as $key) {
    switch ($key['types'][0]) {
      case 'locality':
        $loc['city'] = $key['long_name'];
        break;
      case 'administrative_area_level_1':
        $loc['state'] = $key['long_name'];
        break;
      case 'country':
        $loc['country'] = $key['long_name'];
        break;
    }
  }

  return $loc;
}