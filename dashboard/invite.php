<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../inc/functions.php';

global $amb;

if (isset($_POST['amb_invite']) && $_POST['amb_invite'] != NULL) {
  $data = explode(',', $_POST['amb_invite']);
  $send = 'amb';
} else if (isset($_POST['sub_invite'])  && $_POST['sub_invite'] != NULL) {
  $data = explode(',', $_POST['sub_invite']);
  $send = 'sub';
} else {
  header('Location: ./?error=1');
  die();
}

foreach ($data as $email) {
  $email = str_replace(' ', '', $email);

  sendInvite($email, $send, $amb, (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]");

  echo 'Sent to: ' . $email . '<br>';
}

header('Location: ./?sent=1');