<?php
echo Addons\EMAIL_SEND;
// // sendFile ();
$recipients = Addons\EMAIL_SEND;
$id_app = 1;
$id_partner = 10;
$subject = 'Sending a module-type application';
$text = '';
$msg = "<p>Hello!</p>" .
"<p> A module-type application was sent to the marketplace server. </p> " .
"<p> App ID: $id_app </p>" .
"<p> Partner ID: $id_partner </p>";
send_mailjet($subject,$text,$msg,$recipients);

// $email = $recipients;
// // get in API
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://e-com.plus/api/v1/partners.json?email='. $email);
// // prevent execution timeout
// curl_setopt($ch, CURLOPT_TIMEOUT, 10);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//   'Content-Type: application/json'
// ));
// $response_body = curl_exec($ch);
// // all done, close cURL
// curl_close($ch);
// $json = json_decode($response_body, true);
// echo $response_body;
// // var_dump($json);
