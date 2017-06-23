<?php 
require '../mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;
//Your credentials
$mg = new Mailgun(MAILGUN_KEY);
$domain = MAILGUN_DOMAIN;

//Customise the email - self explanatory
$mg->sendMessage($domain, array(
'from'=>'Morning Chalk Up <info@mail.morningchalkup.com>',
'to'=> 'John Doe <eric@morningchalkup.com>',
'subject' => 'Testing',
'text' => 'This a test',
    )
)





?>