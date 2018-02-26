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
// TODO: treat login redirect index
if (empty($_POST)) {
  // error redirect index
  header("Location: ../index");
  exit;
}else if(!empty($_POST['id']) AND !empty($_POST['pass']) AND $_POST['user'] ){
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
  $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  // TODO: insert table partner, escape id and pass
  /*
  $conn = $GLOBAL['conn'];
  // query search app and theme for index page
  $query = "INSERT INTO `partners` (`id`, `password_hash`, `member_since`,
    `avg_stars`, `evaluations`, `path_image`, `profile_json`, `credit`)
    VALUES (`$id`, `$pass_hash`, NULL, NULL, NULL, NULL, NULL, NULL)";

  if (mysqli_query(  $conn, $query )) {
    // message sucess
  }
  */

}else {
  // error redirect for index

}
