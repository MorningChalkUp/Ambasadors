<?php

ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../inc/functions.php';

global $con;

$data = $con->fetchAll("SELECT points, sid, email FROM cu_amb_usr");

foreach ($data as $amb) {
  $status = $con->fetch("SELECT reward FROM cu_amb_status WHERE sid = ?", array((int)$amb['sid']));
  $next = (int)$amb['sid']+1;
  $next_status = $con->fetch("SELECT reward, points_min FROM cu_amb_status WHERE sid = ?", array($next));

  $fields = array(
    'Points' => (int)$amb['points'],
    'Current Level Reward' => $status['reward'],
    'Points Needed' => (int)$next_status['points_min'] - (int)$amb['points'],
    'Next Level Reward' => $next_status['reward'],
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

  $auth = array('api_key' => CM_API_KEY);
  $ambWrap = new CS_REST_Subscribers(CM_AMB_LIST_ID, $auth);

  $result = $ambWrap->update($amb['email'], array(
    'CustomFields' => $cm_custom_fields
  ));

  var_dump($amb['email']);
  echo "\n";
  ob_flush();
}

echo('done.');
ob_end_flush(); 