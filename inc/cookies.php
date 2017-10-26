<?php

function cookie_create($name, $value, $timeout = 0) {
  setcookie($name, $value, $timeout,'/');
}

function cookie_read($name) {
  $cookie = isset($_COOKIE[$name]) ? $_COOKIE[$name] : '';
  if (isset($cookie) && $cookie != '') {
    return $cookie;
  }
  return false;
}

function cookie_expire($name) {
  cookie_create($name, NULL, time() - 1);
  unset($_COOKIE[$name]);
}