<?php
// // sendFile ();
$recipients = 'wisley7lagoas@yahoo.com.br';
$id_app = 1;
$id_partner = 10;
$subject = 'Sending a module-type application';
$text = '';
$msg = "<p>Hello!</p>" .
"<p> A module-type application was sent to the marketplace server. </p> " .
"<p> App ID: $id_app </p>" .
"<p> Partner ID: $id_partner </p>";
send_mailjet($subject,$text,$msg,$recipients);
