<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../inc/functions.php';

global $amb;

if (isset($_POST['amb_invite'])) {
  $data = explode(',', $_POST['amb_invite']);
  $send = 'amb';
} else if (isset($_POST['sub_invite'])) {
  $data = explode(',', $_POST['sub_invite']);
  $send = 'sub';
} else {
  header('Location: ./');
  die();
}

foreach ($data as $email) {
  $email = str_replace(' ', '', $email);

  sendInvite($email, $send, $amb);

  echo 'Sent to: ' . $email . '<br>';
}

header('Location: ./?sent=1');