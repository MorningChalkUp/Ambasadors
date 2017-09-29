 <?php 

require 'mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;

function sendContact($email, $text) {
  $mg = new Mailgun(MAILGUN_KEY);
  $domain = MAILGUN_DOMAIN;

  $result = $mg->sendMessage($domain, array(
    'from'    => 'Morning Chalk Up Ambassadors <info@mail.morningchalkup.com>',
    'h:Reply-To' => $email,
    'to'      => 'Morning Chalk Up <info@morningchalkup.com>',
    'subject' => 'Ambassador Question: ' . $email,
    'text'    => $text,
  ));
}

function sendLevelUpdate($aid, $sid) {
  global $con;
  $mg = new Mailgun(MAILGUN_KEY);
  $domain = MAILGUN_DOMAIN;
  $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE aid = ?", $aid);
  $to = $u['fullname'] . '<' . $u['email'] . '>';
  
  $status = $con->fetch("SELECT * FROM cu_amb_status WHERE sid = ?", $sid);

  $html = getEmail('levelup');

  $result = $mg->sendMessage($domain, array(
    'from'    => 'Morning Chalk Up Ambassadors <info@mail.morningchalkup.com>',
    'h:Reply-To' => 'Morning Chalk Up <info@morningchalkup.com>',
    'to'      => $to,
    'subject' => 'You\'ve Leveled Up to ' . $status['status'] . '!',
    'html'    => $html,
  ));


}

function sendPasswordReset($aid,$token,$site) {
  global $con;
  $mg = new Mailgun(MAILGUN_KEY);
  $domain = MAILGUN_DOMAIN;
  $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE aid = ?", $aid);
  $to = $u['fullname'] . '<' . $u['email'] . '>';

  $link = $site . '/reset/?token=' . $token;

  $html = getEmail('passwordreset');

  $result = $mg->sendMessage($domain, array(
    'from'    => 'Morning Chalk Up Ambassadors <info@mail.morningchalkup.com>',
    'h:Reply-To' => 'Morning Chalk Up <info@morningchalkup.com>',
    'to'      => $to,
    'subject' => 'Password Reset Morning Chalk Up Ambassadors',
    'html'    => $html,
  ));
}

function getEmail($template) {
  include 'emails/header.php';
  include 'emails/body_'.$template.'.php';
  include 'emails/footer.php';
}
