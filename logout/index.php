<?php

require '../inc/mcuamb_cookies.php';


mcuamb_logout();

$loggedin = mcuamb_loginState();

if ($loggedin) {
  echo 'ERROR: There was an issue logging you out. Please contace <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> with details about this issue.';
  die();
}

$location = 'Location: /';
header($location);