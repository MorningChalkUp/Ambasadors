<?php

require '../inc/functions.php';

if (isset($_POST['email']) && $_POST['email'] != '') {
  if (validateEMAIL($_POST['email'])) {
    $email = $_POST['email'];
  } else {
    $loc = 'Location: /contact/?e=1';
    header($loc);
    die();
  }
} else {
  $loc = 'Location: /contact/?e=1';
  header($loc);
  die();
}

$message = $_POST['question'];

sendContact($email, $message);

$loc = 'Location: /contact/?ty=1';
header($loc);

