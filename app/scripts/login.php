<?php
// Occurs after clicking the login button now
// check if user and password are null, if null, redirect to index
if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pass']))){
  header("Location: ../?EROORLOGIN");
  exit;
}
// if they are not null, treat variables and query the database
else if(empty($_POST)) {
  header("Location: ../");
  exit;
}
else {
  // test user and password
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  // query DB find user
  /*
  $conn = mysqli_connect(Addon\MYSQL_HOST, Addon\MYSQL_USER, Addons\MYSQL_PASS,Addon\MYSQL_DB);
  if (mysqli_connect_errno()) {
    echo 'Connection failed: ';
    echo mysqli_connect_error();
    echo PHP_EOL;
    exit();
  }
  // frist escape varables
  $user = mysqli_real_escape_string($conn,$_POST['user']);
  $pass = $user = mysqli_real_escape_string($conn,$_POST['pass']);
  // then query the user in db
  $query = "SELECT `id`, `username`, `path_image` FROM `partners` WHERE (`username` = '".$usero ."') AND (`password_hash` = '". $pass ."')  LIMIT 1";

  */
  if (!isset($_SESSION)){
    $id = 1;
    session_id($id);
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = $user;
    $_SESSION['name'] = 'User-Login';
    $_SESSION['login'] = true;
    $_SESSION['is_store'] = false;
    $_SESSION['credits'] = 9;
    $_SESSION['path_image'] = '../images/dashboard/profile-default-image.png';
    //$SESSION['path_image'] = 'https://scontent.fplu1-1.fna.fbcdn.net/v/t1.0-9/22007860_1669412349777235_4400272234535034649_n.jpg?oh=e40ca78eb8dea885a958637b201503bd&oe=5ADF48F2'
    //var_dump($_SESSION);
    if (!is_writable(session_save_path())) {
    //echo 'Session path "'.session_save_path().'" is not writable for PHP!';
    }
    else {
      header("Location: ../?SUCCESSLOGIN");
      exit;
    }
  }

}
