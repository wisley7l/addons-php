<?php
// // sendFile ();
$recipients = 'wisback@gmail.com';
$id_app = 1;
$id_partner = 10;
$subject = 'Sending a module-type application';
$text = '';
$msg = "Hello \n" .
"A module-type application was sent to the marketplace server.\n " .
"App ID: $id_app \n" .
"Partner ID: $id_partner\n";
send_mailjet($subject,$text,$msg,$recipients);

// treatImages('a');
