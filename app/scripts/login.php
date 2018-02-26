<?php
/*
$conn = mysqli_connect(Addon\MYSQL_HOST, Addon\MYSQL_USER, Addons\MYSQL_PASS,Addon\MYSQL_DB);
if (mysqli_connect_errno()) {
  echo 'Connection failed: ';
  echo mysqli_connect_error();
  echo PHP_EOL;
  exit();
}
*/
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
  /* TODO:
  $conn = $GLOBAL['conn'];
  // frist escape varables
  $id_user = mysqli_real_escape_string($conn, $id_partner);
  $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  $pass = mysqli_real_escape_string($conn,$pass_hash);
  // query search app and theme for index page
  $query = "SELECT `p.id`,`p.path_image`, `p.credits`  FROM `partners p`
    WHERE (`p.id` = $id_user AND `p.passowrd_hash` = $pass) LIMIT 1";
  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['p.id'];
      $image = $row['p.path_image'];
      $credits = (float) $row['p.credits'];
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
  $id = 1;
  $name = 'USER';
  $image = '';
  $credits = 1000.00;

  if (!isset($_SESSION)){
    createSession($id,$email,$name,$credits,$image);
  }
  else {
    header("Location: ../#loginexists");
    exit;
  }
}

function createSession($id,$email,$name,$credits,$image)
{
  if ($image == '' || $image == NULL) {
    $image = 'https://www.ocf.berkeley.edu/~dblab/blog/wp-content/uploads/2012/01/icon-profile.png';
  }

  session_id($id);
  session_start();
  $_SESSION['user_id'] = (int) $id;
  $_SESSION['user_name'] = $email; // get via API
  $_SESSION['name'] = $name; // get via API
  $_SESSION['login'] = true;
  $_SESSION['is_store'] = false;
  $_SESSION['credits'] = (float) $credits; // get via DB
  $_SESSION['path_image'] = $image; // Get via DB
  if (!is_writable(session_save_path())) {
  //echo 'Session path "'.session_save_path().'" is not writable for PHP!';
  }
  else {
    header("Location: ../#sucesslogin");
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
