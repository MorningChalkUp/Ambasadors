<?php 
require '../mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;
//Your credentials
$mg = new Mailgun("key-9fd239f9c4fd5b161fffb803c810908b");
$domain = "mail.morningchalkup.com";

//Customise the email - self explanatory
$mg->sendMessage($domain, array(
'from'=>'Morning Chalk Up <info@mail.morningchalkup.com>',
'to'=> 'John Doe <eric@morningchalkup.com>',
'subject' => 'Testing',
'text' => 'This a test',
    )
)





?>