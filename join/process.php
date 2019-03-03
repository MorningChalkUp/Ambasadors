<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require_once '../inc/functions.php';
include('../inc/chalkup_db.php');
require_once '../inc/cm/csrest_subscribers.php';

/* Validate Info */

  $data['url']      = isset($_POST['URL']) ? $_POST['URL'] : '';
  $data['source']   = isset($_POST['UTM_SOURCE']) ? $_POST['UTM_SOURCE'] : '';
  $data['medium']   = isset($_POST['UTM_MEDIUM']) ? $_POST['UTM_MEDIUM'] : '';
  $data['campaign'] = isset($_POST['UTM_CAMP']) ? $_POST['UTM_CAMP'] : '';
  $data['gclid']    = isset($_POST['GCLID']) ? $_POST['GCLID'] : '';
  $data['content']  = isset($_POST['utm_content']) ? $_POST['utm_content'] : '';
  $data['term']     = isset($_POST['utm_term']) ? $_POST['utm_term'] : '';
  $data['reff']     = isset($_POST['reff']) ? $_POST['reff'] : '';

  $query = '';

  if (isset($data['source']) && $data['source'] != '') {
  $query .= 'utm_source=' . $data['source'] . '&';
  }
  if (isset($data['medium']) && $data['medium'] != '') {
  $query .= 'utm_medium=' . $data['medium'] . '&';
  }
  if (isset($data['campaign']) && $data['campaign'] != '') {
  $query .= 'utm_campaign=' . $data['campaign'] . '&';
  }
  if (isset($data['gclid']) && $data['gclid'] != '') {
  $query .= 'gclid=' . $data['gclid'] . '&';
  }
  if (isset($data['content']) && $data['content'] != '') {
  $query .= 'utm_content=' . $data['content'] . '&';
  }
  if (isset($data['term']) && $data['term'] != '') {
  $query .= 'utm_term=' . $data['term'] . '&';
  }
  if (isset($data['reff']) && $data['reff'] != '') {
  $query .= 'reff=' . $data['reff'] . '&';
  }

  $e = '';

  if (isset($_POST['full-name'])) {
    /* Full Name -> First and Last */
    if ($_POST['full-name'] && $_POST['full-name'] != '') {
      $data['full-name'] = $_POST['full-name'];
      $dat['full-name'] = $data['full-name'];
    
      $name = explode(' ',$data['full-name']);

      if (!isset($name[1])) {
        $name[1] = '';
      }

      $data['first-name'] = $name[0];
      $data['last-name'] = $name[1];
    } else {
      $error[] = 'full-name';
    }

  } elseif(isset($_POST['first-name']) || isset($_POST['last-name'])) {
    /* First Name */
    if ($_POST['first-name'] && $_POST['first-name'] != '') {
      $data['first-name'] = $_POST['first-name'];
      $dat['first-name'] = $data['first-name'];
      $data['full-name'] = $data['first-name'];
    } else {
      $error[] = 'first-name';
    }
    
    /* Last Name */
    if (isset($_POST['last-name']) && $_POST['last-name'] != '') {
      $data['last-name'] = $_POST['last-name'];
      $dat['last-name'] = $data['last-name'];
      if ($data['first-name']) {
        $data['full-name'] = $data['full-name'] . ' ' . $data['last-name'];
      } else {
        $data['full-name'] = $data['last-name'];
      }
    } else {
      $error[] = 'last-name';
    }


  } else {
    $error[] = 'full-name';
  }

  /* Address */
  if ($_POST['address'] && $_POST['address'] != '') {
    $data['address'] = $_POST['address'];
    $dat['address'] = $data['address'];
  } else {
    $error[] = 'address';
  }

  /* City */
  if ($_POST['city'] && $_POST['city'] != '') {
    $data['city'] = $_POST['city'];
    $dat['city'] = $data['city'];
  } else {
    $error[] = 'city';
  }

	/* State */
	if($_POST['country'] == 'United States') {
		if ($_POST['state'] && $_POST['state'] != '') {
			$data['state'] = $_POST['state'];
			$dat['state'] = $data['state'];
			$data['country'] = $_POST['country'];
			$dat['country'] = $data['country'];
		} else {
			$error[] = 'state';
		}
	} else {
		if ($_POST['state_text'] && $_POST['state_text'] != '') {
			$data['state'] = $_POST['state_text'];
			$dat['state'] = $data['state'];
			$data['country'] = $_POST['country'];
			$dat['country'] = $data['country'];
		} else {
			$error[] = 'state';
		}
	}
  

  /* Zip */
  if ($_POST['zip'] && $_POST['zip'] != '') {
    $data['zip'] = $_POST['zip'];
    $dat['zip'] = $data['zip'];
  } else {
    $error[] = 'zip';
  }

  if ($_POST['shirt_size'] && $_POST['shirt_size'] != '') {
    $data['shirt_size'] = $_POST['shirt_size'];
    $dat['shirt_size'] = $data['shirt_size'];
  } else {
    $error[] = 'shirt_size';
  }

  if ($_POST['shirt_type'] && $_POST['shirt_type'] != '') {
    $data['shirt_type'] = $_POST['shirt_type'];
    $dat['shirt_type'] = $data['shirt_type'];
  } else {
    $error[] = 'shirt_type';
  }

  /* Regex Email Address And Does email Exist */
  if ($_POST['email'] && $_POST['email'] != '') {
    if (validateEMAIL($_POST['email'])) {
      $data['email'] = $_POST['email'];
      $dat['email'] = $data['email'];
      $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE email = ?", $data['email']);
      if (isset($u) && $u != false) {
        $error[] = 'email-exists';
      }
/*      else {
        if (limitSignup($data['email'])) {
          $error[] = 'no-signup';
        }
      }*/
    } else {
      $error[] = 'email';
    }
  } else {
    $error[] = 'email';
  }

  /* password match */
  if ($_POST['password'] && $_POST['password'] != '') {
    $data['password']  = $_POST['password'];
  } else {
    $error[] = 'password';
  }
  if ($_POST['conf-password'] && $_POST['conf-password'] != '') {
    $data['conf-password']  = $_POST['conf-password'];
  } else {
    $error[] = 'conf-password';
  }
  if ($data['password'] && $data['conf-password']) {
    if ($data['password'] !== $data['conf-password']) {
      $error[] = 'no-match';
    }
  }

  /* Username Required and Doesn't Exist */
  if ($_POST['username'] && $_POST['username'] != '') {
    $data['username'] = $_POST['username'];
    $dat['username'] = $data['username'];

    if (validateUsername($data['username'])) {
      $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE username = ?", $data['username']);
      if (isset($u) && $u != false) {
        $error[] = 'username-exists';
      }
    } else {
      $error[] = 'username-format';
    }
  } else {
    $error[] = 'username';
  }

  /* If Errors - Return to signup page */
  if (isset($error)) {
    foreach ($error as $err) {
      $e .= 'e[' . $err . ']=1&';
    }
    foreach ($dat as $k => $v) {
      $d .= $k . '=' . $v . '&';
    }
    $location = 'Location: ' . $_POST['URL'] . '?' . $query . $d . trim($e, '&');
    header($location);
    die();
  }

/* Create User Referal ID */

  /* substr(md5(EMAIL),rand(0,26),5); */
  $data['ref'] = substr(md5($data['email']),rand(0,26),5);

/* Add to DB */
  
  /* Set User Info */
  $user = array(
    'fullname' => $data['full-name'],
    'fname' => $data['first-name'],
    'lname' => $data['last-name'],
    'address' => $data['address'],
    'city' => $data['city'],
    'state' => $data['state'],
		'zip' => $data['zip'],
		'country' => $data['country'],
    'email' => $data['email'],
    'password' => md5($data['password']),
    'username' => $data['username'],
    'shirt_size' => $_POST['shirt_size'],
    'shirt_type' => $_POST['shirt_type'],
    'join_time' => date("Y-m-d H:i:s"),
  );

  /* Execute Insert */
  $r = $con->execute("INSERT INTO cu_amb_usr(fullname, fname, lname, address, city, state, zip, country, email, password, username, shirt_size, shirt_type, join_time) VALUES(:fullname, :fname, :lname, :address, :city, :state, :zip, :country, :email, :password, :username, :shirt_size, :shirt_type, :join_time)", $user);

  /* Add To Campaign Monitor */

  $auth = array('api_key' => CM_API_KEY);
  $wrap = new CS_REST_Subscribers(CM_AMB_LIST_ID, $auth);

  $cm_data = array(
    'EmailAddress'    =>  $data['email'],
    'Name'            =>  $data['full-name'],
    'Resubscribe'     =>  true,
  );

  $fields = array(
    'Username' => $data['username'],
    'Points' => 0,
    'Points Needed' => 5,
    'Next Level Reward' => 'Congratulations! You\'re now an official ambassador.',
    'Is Ambassador' => 1,
  );

  $cm_custom_fields = array();

  foreach ($fields as $key => $value) {
    if (isset($value) && ($value != NULL || $value != '')) {
      array_push(
        $cm_custom_fields, 
        array('key' => $key, 'value' => $value)
      );
    }
  }

  $cm_data['CustomFields'] = $cm_custom_fields;

  $result = $wrap->add($cm_data);

  /* Add to Event DB */
  addEvent($data, 'ambassador');

/*Create User Cookie */
  
  mcuamb_setUserCookie($user['username'], $user['password']);

/* Send to Dashboard */
  
  $location = 'Location: /dashboard/';
  header($location);



/* Utility Functions */

function limitSignup($email) {
  global $con;

  $allowed = $con->fetchAll("SELECT email FROM cu_amb_allowed_signup");

  foreach ($allowed as $user) {
    if (strtolower($user['email']) == strtolower($email)) {
      echo 'in';
      return false;
    }
  }
  
  return true;

}