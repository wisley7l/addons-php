<?php
//*
$conn = connect_db();
//*/
// Occurs after clicking the login button now
// check if user and password are null, if null, redirect to index
if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pass']))){
  header("Location: ../error-page");
  exit;
}
// if they are not null, treat variables and query the database
else if(empty($_POST)) {
  header("Location: ../");
  exit;
}
else {
  // test user and password
  $email = $_POST['user'];
  $pass = $_POST['pass'];
  $id = getUserAPIid($email);

  // if exists partner
  // OBS :
  // query check if it already exists in the DB
  // if there is a return, the user is already registered
  //otherwise request password
  // TODO:
  $conn = $GLOBAL['conn'];
  // frist escape varables
  $id_user = 1;
  //$id_user = mysqli_real_escape_string($conn, $id_partner);
  //$pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  //$pass = mysqli_real_escape_string($conn,$pass_hash);
  // query search app and theme for index page
  //$query = "SELECT `p.id`,`p.path_image`, `p.credits`  FROM `partners p`
    //WHERE (`p.id` = $id_user AND `p.passowrd_hash` = $pass) LIMIT 1";
  // TODO: test
  $query = "SELECT `p.id`,`p.path_image`, `p.credits`  FROM `partners p`
    WHERE (`p.id` = $id_user) LIMIT 1";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $image = $row['path_image'];
      $credits = (float) $row['credits'];
    }
    // free result set
    mysqli_free_result($result);
  }else {
    // partner not found or error login
    // TODO: redirect error
  }
  //TODO: get name via API
  //*/

  // TEST
  //$id = 1;
  $name = 'USER' . $id;
  //$image = '';
  //$credits = 1000.00;

  if (!isset($_SESSION)){
    createSession($id,$email,$name,$credits,$image);
  }
  else {
    header("Location: ../#loginexists");
    exit;
  }
}

function getUserAPIid($email)
{

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
    return (int) $json['result'][0]['id'];

  }else {
    return 0;
  }
}
