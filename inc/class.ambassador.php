<?php

class Ambassador
{

  public $ambassador =  array(
    'full-name' => '',
    'fullname' => '',
    'fname' => '',
    'lname' => '',
    'points' => 0,
    'username' => '',
    'password' => '',
    'sid' => 0,
    'status' => '',
    'id' => 0,
    'image' => '',
    'address' => '',
    'city' => '',
    'state' => '',
    'zip' => '',
    'email' => '',
    'shirt_size' => '',
    'shirt_type' => '',
  );
  
  function setUser($username, $con) {

    $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $username);

    if($u != false) {
      $this->ambassador['full-name'] = $u['fullname'];
      $this->ambassador['fullname'] = $u['fullname'];
      $this->ambassador['fname'] = $u['fname'];
      $this->ambassador['lname'] = $u['lname'];
      $this->ambassador['points'] = $u['points'];
      $this->ambassador['username'] = $username;
      $this->ambassador['password'] = $u['password'];
      $this->ambassador['id'] = $u['aid'];
      $this->ambassador['sid'] = $u['sid'];
      $this->ambassador['address'] = $u['address'];
      $this->ambassador['city'] = $u['city'];
      $this->ambassador['state'] = $u['state'];
      $this->ambassador['zip'] = $u['zip'];
      $this->ambassador['image'] = $u['image'];
      $this->ambassador['email'] = $u['email'];
      $this->ambassador['shirt_size'] = $u['shirt_size'];
      $this->ambassador['shirt_type'] = $u['shirt_type'];

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

      return $this->ambassador['next-status'];
  }
  function getNextReward($con) {
    $nextLevel = $con->fetch("SELECT reward FROM cu_amb_status WHERE sid = ?", $this->ambassador['sid']+1);

      if($nextLevel != false) {
        $this->ambassador['next-reward'] = $nextLevel['reward'];
      } else {
        $this->ambassador['next-reward'] = 'MAXED OUT';
      }

      return $this->ambassador['next-reward'];
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

  function getActivityList($con) {
    $id = $this->getValue('id');

    $query = "SELECT cu_form_event.eid, cu_form_event.id, cu_form_event.id_type, cu_amb_point_value.points, cu_form_event.su_time, cu_amb_point_value.description 
      FROM cu_amb_points 
        JOIN cu_form_event ON cu_amb_points.eid = cu_form_event.eid 
        JOIN cu_amb_point_value ON cu_amb_points.pvalid = cu_amb_point_value.pvalid
      WHERE cu_amb_points.aid = ?
      ORDER BY cu_form_event.su_time DESC";

    $activity = $con->fetchAll($query,$id);

    if ($activity) {
      foreach ($activity as $key => $action) {
        if ($action['id_type'] == 'pid') {
          $table = 'cu_people';
        }
        if ($action['id_type'] == 'aid') {
          $table = 'cu_amb_usr';
        }
        $query = "SELECT email FROM " . $table . " WHERE " . $action['id_type'] . " = ?";

        $r = $con->fetch($query, $action['id']);
        $activity[$key]['email'] = $r['email'];

      }
    }

    return $activity;
  }

  function getActivityCount($before,$con) {
    $id = $this->getValue('id');

    $query = "SELECT cu_signup.su_time FROM cu_signup 
      JOIN cu_amb_points ON cu_amb_points.suid = cu_signup.suid
      WHERE cu_amb_points.aid = ? AND cu_signup.su_time < ?";

    $activity = $con->fetchAll($query,array($id,date("Y-m-d H:i:s",$before)));

    return count($activity);

  }

}