<?php

function mc_is_member($email) {
  $url = mc_get_member_url($email);
  $result = mc_curl('GET', $url);

  if ($result != false) {
    return true;
  } else {
    return false;
  }
}

function mc_get_member($email) {
  if (mc_is_member($email)) {
    return mc_curl('GET', mc_get_member_url($email));
  }
  return false;
}

function mc_get_status($email) {
  $result = mc_get_member($email);
  if ($result != false) {
    return array(
      'status' => $result['status'],
      'timestamp_signup' => $result['timestamp_signup'],
      'timestamp_opt' => $result['timestamp_opt'],
    );
  }
  return 'not subscribed';
}

function mc_build_member($data) {
  $time = date('c');
  $new_member = array(
   'email_address'         => $data['email_address'],
   'timestamp_signup'      => $time,
   'timestamp_opt'         => $time,
   'merge_fields'  => array(
      'FNAME'         => $data['FNAME'],
      'LNAME'         => $data['LNAME'],
      'ZIP'           => $data['ZIP'],
      'WEBSITE'       => $data['WEBSITE'],
      'ABOUT'         => $data['ABOUT'],
      'URL'           => $data['URL'],
      'UTM_SOURCE'    => $data['UTM_SOURCE'],
      'UTM_MEDIUM'    => $data['UTM_MEDIUM'],
      'UTM_CAMP'      => $data['UTM_CAMP'],
      'GCLID'         => $data['GCLID'],
      'AFFILIATE'     => $data['AFFILIATE'],
      'COUNTRY'       => $data['COUNTRY'],
    ),
  );

  if ($data['us']) { // The Morning Chalk Up
    $new_member['interests']['4df5affc52'] = true;
  }
  if ($data['europe']) { // The Morning Chalk Up Europe
    $new_member['interests']['dc21ea3e80'] = true;
  }
  if ($data['alerts']) { // Alerts
    $new_member['interests']['98dfe7ca35'] = true;
  }
  
  $status = mc_get_status($data['email_address']);
  
  switch ($status['status']) {
    case 'subscribed':
      $new_member['status'] = 'subscribed';
      $new_member['timestamp_signup'] = $status['timestamp_signup'];
      $new_member['timestamp_opt'] = $status['timestamp_opt'];
      break;
    
    case 'unsubscribed':
      $new_member['status'] = 'pending';
      $new_member['timestamp_signup'] = $status['timestamp_signup'];
      $new_member['timestamp_opt'] = $status['timestamp_opt'];
      break;
    
    case 'pending':
      $new_member['status'] = 'pending';
      $new_member['timestamp_signup'] = $status['timestamp_signup'];
      $new_member['timestamp_opt'] = $status['timestamp_opt'];
      break;
    
    case 'not subscribed':
      $new_member['status'] = 'subscribed';
      break;
    
    default:
      $new_member['status'] = 'subscribed';
      break;
  }

  return $new_member;
}

/* 
  INPUT: fields to add new subscriber
  OUTPUT: member ID
*/
function mc_add_member($data) {
  if (!isset($data['b_2590f9a5c5961923b49f0256e_6b069b795a']) || $data['b_2590f9a5c5961923b49f0256e_6b069b795a'] != '' || $data['b_2590f9a5c5961923b49f0256e_6b069b795a'] != NULL) {

    $new_member = mc_build_member($data);
    $result = mc_curl('PUT', mc_get_member_url($data['email_address']), $new_member);

    if ($result == false) {
      echo 'There was an issue subscribing to the mailing list. Please contat the webmaster at: <a href="eric@morningchalkup.com">eric@morningchalkup.com</a>.';
      die();
    }
  }
  return $result['id'];
}


function mc_curl($method, $url, $new_member = NULL) {

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_USERPWD, 'user:' . MC_API_KEY);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

  if($method == 'GET') {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  } else {
    $time = date('c');

    $json = json_encode($new_member);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
  }

  $result = curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  
  curl_close($ch);

  $result = json_decode($result, true);

  if ($httpCode != 200) {
    out_pre($result['status'] . ' ' . $result['title']);
    out_pre($result['detail']);
    echo_pre($result['errors']);
    out_pre('<hr>');
    return false;
  }

  // echo_pre($result);

  return $result;
}


function mc_get_member_id($email) {
  return md5(strtolower($email));
}

function mc_get_member_url($email) {
  $memberId = mc_get_member_id($email);
  
  return 'https://' . MC_DATA_CENTER . '.api.mailchimp.com/3.0/lists/' . MC_LIST_ID . '/members/' . $memberId;
}