<?php 

require 'mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;

function sendContact($email, $text) {
  $mg = Mailgun::create(MAILGUN_KEY);
  $domain = MAILGUN_DOMAIN;

  $result = $mg->messages()->send($domain, array(
    'from'    => 'Morning Chalk Up Ambassadors <info@mail.morningchalkup.com>',
    'h:Reply-To' => $email,
    'to'      => 'Morning Chalk Up <info@morningchalkup.com>',
    'subject' => 'Ambassador Question: ' . $email,
    'text'    => $text,
  ));
}

function sendLevelUpdate($aid, $sid, $site) {
  global $con;
  $mg = Mailgun::create(MAILGUN_KEY);
  $domain = MAILGUN_DOMAIN;
  $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE aid = ?", $aid);
  $to = $u['fullname'] . '<' . $u['email'] . '>';
  
  $status = $con->fetch("SELECT * FROM cu_amb_status WHERE sid = ?", $sid);
  $nextLevel = $con->fetch("SELECT * FROM cu_amb_status WHERE sid = ?", $sid+1);
  $points_needed = $nextLevel['points_min'] - $u['points'];

  $dashboard = $site . '/dashboard/';

  echo $dashboard;

  $leve_up = getLevelup($u['fname'], $u['points'], $nextLevel['points_min'], $points_needed, $dashboard);

  $html = getHeader() . $leve_up . getFooter();

  $result = $mg->messages()->send($domain, array(
    'from'    => 'Morning Chalk Up Ambassadors <info@mail.morningchalkup.com>',
    'h:Reply-To' => 'Morning Chalk Up <info@morningchalkup.com>',
    'to'      => $to,
    'subject' => 'Congratulations ' . $u['fname'] . '! You\'ve leveled up.',
    'html'    => $html,
  ));
}

function sendPasswordReset($aid,$token,$site) {
  global $con;
  $mg = Mailgun::create(MAILGUN_KEY);
  $domain = MAILGUN_DOMAIN;
  $u = $con->fetch("SELECT * FROM cu_amb_usr WHERE aid = ?", $aid);
  $to = $u['fullname'] . '<' . $u['email'] . '>';

  $link = $site . '/reset/?token=' . $token;

  $html = getHeader() . getPasswordreset($u['username'], $link) . getFooter();

  $result = $mg->messages()->send($domain, array(
    'from'    => 'Morning Chalk Up Ambassadors <info@mail.morningchalkup.com>',
    'h:Reply-To' => 'Morning Chalk Up <info@morningchalkup.com>',
    'to'      => $to,
    'subject' => 'Password Reset Morning Chalk Up Ambassadors',
    'html'    => $html,
  ));
}

function sendInvite($to, $type, $amb, $site) {
  $mg = Mailgun::create(MAILGUN_KEY);
  $domain = MAILGUN_DOMAIN;
  
  if ($type == 'amb') {
    $copy = getInviteAmb($amb->getValue('fname'), $amb->getValue('username'), $site);
    $subject = 'Join Me As A Morning Chalk Up Ambassadors';
  } elseif ($type == 'sub') {
    $copy = getInviteMCU($amb->getValue('full-name'), $amb->getValue('username'), $site);
    $subject = 'Check Out The Morning Chalk Up!';
  }

  $html = getHeader() . $copy . getFooter();

  $result = $mg->messages()->send($domain, array(
    'from'    => $amb->getValue('full-name') . ' <info@mail.morningchalkup.com>',
    'h:Reply-To' => 'Morning Chalk Up <info@morningchalkup.com>',
    // 'h:Reply-To' => $amb->getValue('full-name') . ' <' . $amb->getValue('email') . '>',
    'to'      => $to,
    'subject' => $subject,
    'html'    => $html,
  ));
}

function getHeader() {
  return '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o=urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="x-apple-disable-message-reformatting"><title></title><!--[if mso]><style>* {font-family: sans-serif !important;}</style><![endif]--><!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel=stylesheet" type="text/css"><!--<![endif]--><style>html,body {margin: 0 auto !important;padding: 0 !important;height: 100% !important;width: 100% !important;}* {-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;}div[style*="margin: 16px 0"] {margin: 0 !important;}table,td {mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;}table {border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;}table table table {table-layout: auto;}img {-ms-interpolation-mode:bicubic;}*[x-apple-data-detectors],.x-gmail-data-detectors,.x-gmail-data-detectors *,.aBn {border-bottom: 0 !important;cursor: default !important;color: inherit !important;text-decoration: none !important;font-size: inherit !important;font-family: inherit !important;font-weight: inherit !important;line-height: inherit !important;}.a6S {display: none !important;opacity: 0.01 !important;}img.g-img + div {display: none !important;}.button-link {text-decoration: none !important;}@media only screen and (min-device-width: 375px) and (max-device-width:413px) {.email-container {min-width: 375px !important;}}</style><style>.button-td,.button-a {transition: all 100ms ease-in;}.button-td:hover,.button-a:hover {background: #555555 !important;border-color: #555555 !important;}@media screen and (max-width: 600px) {.email-container p {font-size: 18px !important;line-height: 27px !important;}}</style><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--></head><body width="100%" bgcolor="#ffffff" style="margin: 0; mso-line-heigh-rule: exactly;"><center style="width: 100%; background: #ffffff; text-align: left;"><div style="max-width: 600px; margin: auto;" class="email-container"><!--[if mso]><table role="presentation" cellspacing="0" cellpadding="0" border="0"width="600" align="center"><tr><td><![endif]--><table role="presentation" cellspacing="0" cellpadding="0" border="0"align="center" width="100%" style="max-width: 600px;"><tr><td style="padding: 20px 0; text-align: center"><img src="https://morningchalkup.com/wp-content/uploads/2017/10/mcu-normal.png" width="362" height="63" alt="Morning Chalk Up" border="0" align="center" style="max-width: 100%; height: auto; font-family: Roboto, sans-serif; font-size: 24px; line-height: 36px; color: #555555; margi: auto;" class="g-img"></td></tr></table>';
}

function getFooter() {
  return '<!--[if mso]></td></tr></table><![endif]--></div><table role="presentation" bgcolor="#3d5ba9" cellspacing="0" cellpadding="0" border="0" align="center" width="100%"><tr><td valign="top" align="center"><div style="max-width: 600px; margin: auto;" class="email-container"><!--[if mso]><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center"><tr><td><![endif]--><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td style="padding: 40px 0 0 0; text-align: center; font-family: Roboto, sans-serif; font-size: 15px; line-height: 20px; color: #ffffff;"><img src="https://morningchalkup.com/wp-content/uploads/2017/10/mcu-white.png" width="362" height="63" alt="Morning Chalk Up" border="0" align="center" style="max-width: 100%; height: auto; font-family: Roboto, sans-serif; font-size: 24px; line-height: 36px; color: #fff; margin: auto;" class="g-img"></td></tr><tr><td align="center" style="padding: 0 40px 60px 40px;font-family: Roboto, sans-serif; font-size: 12px; line-height: 24px; color: #ffffff;">This automated email was sent to you by the Morning Chalkup Ambassador program.</td></tr></table><!--[if mso]></td></tr></table><![endif]--></div></td></tr></table></center></body></html>';
}

function getPasswordreset($username, $link) {
  return '<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td align="center" style="padding: 0 40px ;font-family: Roboto, sans-serif; font-size: 18px; line-height: 27px;  color: #333333;"><p>We have received a request to reset your password on Morning Chalk Up Ambassadors for username <strong>' . $username . '</strong>. If you did not make this request feel free to ignore it. If you did make this request your reset will expire in 24 hours.</p></td></tr><tr><td style="padding: 40px 40px; font-family: Roboto, sans-serif; font-size: 15px; line-height: 20px; color: #555555;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;"><tr><td style="border-radius: 3px; background: #3d5ba9; text-align: center;" class="button-td"><a href="' . $link . '" style="background: #3d5ba9; border: 15px solid #3d5ba9; font-family: Roboto, sans-serif; font-size: 16px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"><span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp; Reset Your Password &nbsp;&nbsp;&nbsp;&nbsp;</span></a></td></tr></table></td></tr></table></td></tr><tr><td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">&nbsp;</td></tr></table>';
}

function getLevelup($fname, $points, $next_level, $points_needed, $dashboard) {
  return '<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td align="center" style="padding: 40px 40px 20px 40px; font-family: Roboto, sans-serif; font-size: 18px; line-height: 27px; color: #555555;"><h2 style="margin: 0 0 10px 0; font-family: Roboto, sans-serif; font-size: 32px; line-height: 48px; color: #333333; font-weight: bold;">Congratulations ' . $fname . '! You\'ve leveled up.</h2><div style="height:3px; line-height:3px; background-color:#3d5ba9; width:100%; max-height: 3px;">&nbsp;</div></td></tr><tr><td align="center" style="padding: 0 40px ;font-family: Roboto, sans-serif; font-size: 16px; line-height: 24px; color: #333333;"><p>Your hard work has paid off and to reward you, we\'ll be sending you a prize! Be on the lookout. In the meantime, why not try sharing the Morning Chalk Up on your CrossFit box\'s Facebook group?</p></td></tr><tr><td align="center" height="100%" valign="top" width="100%" style="padding: 40px 40px 20px;"><table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:560px;"><tr><td bgcolor="#3d5ba9" align="center" valign="middle" width="50%" style="border:3px solid #3d5ba9;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td style="text-align: center;font-family: sans-serif; font-size: 69px; line-height: 69px; color: #ffffff; padding: 20px 10px 0;" class="stack-column-center">' . $points . '</td></tr><tr><td style="text-align: center;font-family: sans-serif; font-size: 15px; line-height: 15px; color: #ffffff; padding: 10px 10px 20px 10px;" class="stack-column-center"><p style="margin: 0;">Points</p></td></tr></table></td><td align="center" valign="middle" width="50%" style="border:3px solid #3d5ba9;text-align: center;font-family: sans-serif; font-size: 18px; line-height: 27px; color: #333333; padding: 10px;" class="stack-column-center"><p style="margin: 0;">Next Level: <span style="font-weight:bold">' . $next_level . ' points</span><br>Points Needed: <span style="font-weight:bold">' . $points_needed . '<br></p></td></tr></table></td></tr><tr><td style="padding: 40px 40px; font-family: Roboto, sans-serif; font-size: 15px; line-height: 20px; color: #555555;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;"><tr><td style="border-radius: 3px; background: #3d5ba9; text-align: center;" class="button-td"><a href="' . $dashboard . '" style="background: #3d5ba9; border: 15px solid #3d5ba9; font-family: Roboto, sans-serif; font-size: 16px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"><span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp; View Dashboard &nbsp;&nbsp;&nbsp;&nbsp;</span></a></td></tr></table></td></tr><tr><td align="center" style="padding: 0 40px ;font-family: Roboto, sans-serif; font-size: 18px; line-height: 27px;  color: #333333;"><p>Congratulations and thank you again for being our ambassador.</p></td></tr></table></td></tr><tr><td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">&nbsp;</td></tr></table>';
}

function getInviteAmb($name, $username, $site) {
  return '<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td style="padding: 0 40px ;font-family: Roboto, sans-serif; font-size: 18px; line-height: 27px;  color: #333333;"><p>Hey,</p><p>Your buddy ' . $name . ' is a Morning Chalk Up Ambassadors and thinks you should join too.</p><p>What’s the big deal?</p><p>Morning Chalk Up Ambassadors are more than just fans -- they wake up daily with a cup of coffee reading the Morning Chalk Up. And here’s the thing: you’re already talking about it anyways so you might as well get points and free things like t-shirts, laptop stickers, and tickets to the CrossFit Games while you’re at it, right?</p><p>So what do you say, are you in?</p></td></tr><tr><td style="padding: 40px 40px; font-family: Roboto, sans-serif; font-size: 15px; line-height: 20px; color: #555555;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;"><tr><td style="border-radius: 3px; background: #3d5ba9; text-align: center;" class="button-td"><a href="' . $site . '/join/?reff=' . $username . '" style="background: #3d5ba9; border: 15px solid #3d5ba9; font-family: Roboto, sans-serif; font-size: 16px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"><span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp; Join the Team &nbsp;&nbsp;&nbsp;&nbsp;</span></a></td></tr></table></td></tr></table></td></tr><tr><td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">&nbsp;</td></tr></table>';
}

function getInviteMCU($name, $username, $site) {
  return '<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;"><tr><td bgcolor="#ffffff"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td style="padding: 0 40px ;font-family: Roboto, sans-serif; font-size: 18px; line-height: 27px;  color: #333333;"><p>Hey,</p><p>Your friend ' . $name . ', thinks you might be interested in reading our five minute morning newsletter covering what’s going on in the CrossFit world.</p><p>Why should you join?</p><p>If you want to scroll through Instagram to find out what’s going on in the CrossFit world then be our guest. If you’d rather grab a nice hot cup of coffee and wake up to the funnest, punniest (that’s a word), pure piece of motivation on the planet that will kick start your day and ensure you know everything happening when you hit the box, then we’re probably for you.</p></td></tr><tr><td style="padding: 40px 40px; font-family: Roboto, sans-serif; font-size: 15px; line-height: 20px; color: #555555;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;"><tr><td style="border-radius: 3px; background: #3d5ba9; text-align: center;" class="button-td"><a href="' . $site . '/subscribe/?reff=' . $username . '" style="background: #3d5ba9; border: 15px solid #3d5ba9; font-family: Roboto, sans-serif; font-size: 16px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a"><span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp; Start Reading &nbsp;&nbsp;&nbsp;&nbsp;</span></a></td></tr></table></td></tr></table></td></tr><tr><td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">&nbsp;</td></tr></table>';
}
