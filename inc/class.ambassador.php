<?php

class Ambassador
{

  public $ambassador =  array(
    'full-name' => '',
    'fname' => '',
    'lname' => '',
    'points' => 0,
    'username' => '',
    'sid' => 1,
    'status' => '',
    'id' => 0,
    'image' => '',
    'city' => '',
    'state' => '',
  );
  
  function setUser($username, $con) {

    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $username);

    if($u != false) {
      $this->ambassador['full-name'] = $u['fullname'];
      $this->ambassador['fname'] = $u['fname'];
      $this->ambassador['lname'] = $u['lname'];
      $this->ambassador['points'] = $u['points'];
      $this->ambassador['username'] = $username;
      $this->ambassador['id'] = $u['aid'];
      $this->ambassador['sid'] = $u['sid'];
      $this->ambassador['city'] = $u['city'];
      $this->ambassador['state'] = $u['state'];
      $this->ambassador['image'] = $u['image'];

      $status = $con->fetch("SELECT status FROM cu_amb_status WHERE sid = ?", $this->ambassador['sid']);

      if($status != false) {
        $this->ambassador['status'] = $status['status'];
      } else {
        echo 'There was a fatal error getting your status. PLease contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for assistance.';
        die();
      }
    } else {
      echo 'There was a fatal error getting your information. PLease contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for assistance.';
      die();
    }
  }

  function getValue($field) {
    if (isset($this->ambassador[$field])) {
      return $this->ambassador[$field];
    } else {
      return false;
    }
  }

  function getNextLevel($con) {
    $nextLevel = $con->fetch("SELECT status FROM cu_amb_status WHERE sid = ?", $this->ambassador['sid']+1);

      if($nextLevel != false) {
        $this->ambassador['next-status'] = $nextLevel['status'];
      } else {
        $this->ambassador['next-status'] = 'MAXED OUT';
      }
  }

  function getNextPoints($con) {
    $nextPoints = $con->fetch("SELECT points_min FROM cu_amb_status WHERE sid = ?", $this->ambassador['sid']+1);

    if($nextPoints != false) {
        return $nextPoints['points_min'] -  $this->ambassador['points'];
      }

    return 0;
  }

  function getRank($con) {

  }

}