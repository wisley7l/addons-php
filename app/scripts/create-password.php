<?php
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
*/
if (isset($_SESSION)){
  header("Location: ../error-page#login");
  exit;
}
// TODO: treat login redirect index
if (empty($_POST)) {
  // error redirect index
  header("Location: ../index");
  exit;
}else if(!empty($_POST['id']) AND !empty($_POST['pass']) AND !empty($_POST['user']) ){
  echo "id: ";
  echo $_POST['id'];
  echo "\n";
  echo "Pass: ";
  echo $_POST['pass'];
  echo "\n";
  echo "User: ";
  echo $_POST['user'];
  $email = $_POST['user'];
  $id = (int)$_POST['id'];
  //TODO:
  /*
  if ($id != (int) getUserAPI($email)) {
    // redirect index error PASSWORD
    header("Location: /index#errorpartnerid");
    exit;
  }
  */
  $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  // TODO: insert table partner, escape id and pass
  /*
  $conn = $GLOBAL['conn'];
  // query search app and theme for index page
  $query = "INSERT INTO `partners` (`id`, `username`, `password_hash`, `member_since`,
    `avg_stars`, `evaluations`, `path_image`, `profile_json`, `credit`)
    VALUES (`$id`, `$email`, `$pass_hash`, NULL, NULL, NULL, NULL, NULL, NULL)";

  if (mysqli_query(  $conn, $query )) {
    // message sucess
    // create login
  }
  */

}else {
  // error redirect for index
  // redirect error page
  header("Location: ../error-page");
  exit;

}
