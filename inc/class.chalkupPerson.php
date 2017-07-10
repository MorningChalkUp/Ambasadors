<?php

class Person
{
  $person = array(
    'pid' = 0,
    'email' => '',
    'mcid' => '',
    'fname' => '',
    'lname' => '',
    'website' => '',
    'about' => '',
    'address1' => '',
    'address2' => '',
    'city' => '',
    'state' => '',
    'zip' => 00000,
    'games_lvl' => false,
    'subscribed' => true,
    'first_reff' => '',
  );
  
  function setPerson($data) {
    foreach ($data as $key => $value) {
      if(isset($person[$key])) {
        $person[$key] = $value;
      }
    }
  }

  
}