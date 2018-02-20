<?php
if (empty($_POST)) {
  // error redirect index
  header("Location: ../index");
  exit;
}
else if (!empty($_POST['email'])) {
  $email = $_POST['email'];
  echo $email;
  // get in API
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://e-com.plus/api/v1/partners.json?email='. $email);
  // prevent execution timeout
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
  ));
  $output = curl_exec($ch);
  // all done, close cURL
  curl_close($ch);

  $json = json_decode($response_body, true);
  // count($json['result']) > 0
  // $json['result'][0]['id']
  if (count($json['result']) > 0) {
    $id_partner = (int) $json['result'][0]['id'];
    // if exists partner
    // OBS :
    // query check if it already exists in the DB
    // if there is a return, the user is already registered
    //otherwise request password
    /* TODO:
    // create connection to the database
    $conn = mysqli_connect(Addon\MYSQL_HOST, Addon\MYSQL_USER, Addons\MYSQL_PASS, Addon\MYSQL_DB);
    // check connection
    if (mysqli_connect_errno()) {
      echo 'Connection failed: ';
      echo mysqli_connect_error();
      echo PHP_EOL;
      exit();
    }
    // query search app and theme for index page
    $query = "SELECT `p.id` FROM `partners p`
      WHERE (`p.id` = $id_partner) LIMIT 1";

    if (mysqli_query(  $conn, $query )) {
      // message error (partner already has password)
    }else {
      // request password
      // TODO:
      // redirect to registration page
      header("Location: ../password-create?id=$id_partner");
      exit;
    }
    //*/
  }else {
    // partner has no pre-registration
    echo "partner has no pre-registration";
  }

}else if(!empty($_POST['id'])){
  echo "id: ";
  echo $_POST['id'];
  echo "\n";
  echo "Pass: ";
  echo $_POST['pass'];

}else {

}
