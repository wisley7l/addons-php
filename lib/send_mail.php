<?php
function send_mailjet($subject,$text,$msg)
{

  // Mailjet API
  $data = array(
    'FromEmail' => 'noreply@e-com.club',
    'FromName' => 'Market E-com Plus',
    'Subject' => $subject,
    'Text-part' => $text,
    'Html-part' => $msg,
    'Recipients' => array()
  );
  if ($reply != null) {
    $data['Headers'] = array('Reply-To' => $reply);
  }
  //
  // for ($i = 0; $i < count($mailJet); $i++) {
    $data['Recipients'][] = array('Email' => 'tiatenas7l@gmail.com');
  // }

  echo "send";
  echo PHP_EOL;
  var_dump($data);
  echo PHP_EOL;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.mailjet.com/v3/send');
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, Addons\USER_MAILJET . ':' . Addons\PWD_MAILJET);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  $result = curl_exec($ch);
  var_dump($result);
  curl_close($ch);
}
