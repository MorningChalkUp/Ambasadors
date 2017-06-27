<?php

  function getLeaders($num, $con) {
    $leaders = $con->fetchAll("SELECT * FROM cu_amb_usr ORDER BY points DESC");

    $return = array_slice($leaders, 0, $num);

    return $return;
  }