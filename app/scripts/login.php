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
  // TODO:
  // query check if it already exists in the DB
  // if there is a return, the user is already registered
  //otherwise request password
  $conn = $GLOBALS['conn'];
  // frist escape varables
  $id_user = (int) $email;

  // query search app and theme for index page

  $query = "SELECT id,password_hash,path_image, credit  FROM partners
    WHERE (id = $id_user) LIMIT 1";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $image = treatImages($row['path_image']);
      $credits = treatNumber($row['credit']);
      $pass_hash = $row['password_hash'];
    }
    // free result set
    mysqli_free_result($result);
  }else {
    // partner not found or error login
    // TODO: redirect error
    header("Location: ../#errorlogin");
    exit;
  }
  // TODO: vefify password
  //TODO: get name via API
  // TEST
  $name = 'USER' . $id;

  if (!isset($_SESSION)){

    if (!password_verify($pass,$pass_hash)) {
      header("Location: ../#loginerror");
      exit;
    }
    else {
      // echo ":" . $credits ;
      createSession($id,$email,$name,$credits,$image,false);
    }
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
