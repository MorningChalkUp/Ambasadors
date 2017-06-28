<?php

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/vars.php');
require_once(__ROOT__.'/inc/db/class.DBPDO.php');

try {
  $con = new DBPDO();
} catch (Exception $e) {
  echo 'There was an issue establishing a connection with the Database';
}