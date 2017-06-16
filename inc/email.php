<?php

  include('vars.php');
  include('test.php');

  $url = 'https://api.mailgun.net/v3/mail.morningchalkup.com/messages';

  $key = MAILGUN_KEY;
 
  $message = array();
  $message['from'] = "info@mail.morningchalkup.com";
  $message['to'] = 'eric@morningchalkup.com';
  // $message['h:Reply-To'] = "<info@morningchalkup.com>";
  $message['subject'] = "Email Auto Send";
  $message['text'] = "Test";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($cl, CURLOPT_USERPWD, "api:" . MAILGUN_DOMAIN);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
  $result = curl_exec($ch);
  curl_close($ch);
  dump($result);