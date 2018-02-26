<?php
$login = false;
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
// close writing session, if it exists and intal session
session_write_close();
session_start();
// if the session exists
if (isset($_SESSION)) {
  $login = $_SESSION['login'];
}
// TODO: treat login redirect index
if (empty($_POST) OR $login == true) {
  // error redirect index
  header("Location: ../index#errorcreate");
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
    //message sucess
    //create login
  }
  */
  createLogin($id, $_POST['pass'],$email);

}else {
  // error redirect for index
  // redirect error page
  header("Location: ../error-page");
  exit;

}

function createLogin($id_partner,$pass,$email)
{
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
  //TODO:
  get name via API
  //*/

  // TEST
  $id = 1;
  $name = 'USER';
  $image = '';
  $credits = 1000.00;

  if ($login == false ){
    createSession($id,$email,$name,$credits,$image);
  }
  else {
    header("Location: ../#loginexists");
    exit;
  }
}
