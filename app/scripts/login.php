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
    $conn = $GLOBAL['conn'];
    // frist escape varables
    $user = mysqli_real_escape_string($id_partner);
    $pass = $user = mysqli_real_escape_string($conn,$_POST['pass']);
    // query search app and theme for index page
    $query = "SELECT `p.id`,`p.path_image`, `p.credits`  FROM `partners p`
      WHERE (`p.id` = $id_partner AND `p.passowrd_hash` = $pass) LIMIT 1";
    if (mysqli_query(  $conn, $query )) {
      // sucess, treat partners
    }else {
      // partner not found or error login
      // TODO: redirect error
    }
    //*/
  }else {
    // partner not found
    // TODO: redirect error
  }

  if (!isset($_SESSION)){
    $id = 1;
    session_id($id);
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = $email; // get via API
    $_SESSION['name'] = 'User-Login'; // get via API
    $_SESSION['login'] = true;
    $_SESSION['is_store'] = false;
    $_SESSION['credits'] = 10000; // get via DB
    $_SESSION['path_image'] = 'https://www.ocf.berkeley.edu/~dblab/blog/wp-content/uploads/2012/01/icon-profile.png'; // Get via DB
    //var_dump($_SESSION);
    if (!is_writable(session_save_path())) {
    //echo 'Session path "'.session_save_path().'" is not writable for PHP!';
    }
    else {
      header("Location: ../#SUCESSOLOGIN");
      //header("Location: ../?SUCCESSLOGIN");
      exit;
    }
  }

}
