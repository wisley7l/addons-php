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
  # Our new data
  $data = array(
      'user' => $email,
      'pass' => $_POST['pass']
  );
  $postString = http_build_query($data, '', '&');
  loginCurl($postString);

}else {
  // error redirect for index
  // redirect error page
  header("Location: ../error-page");
  exit;

}

function loginCurl($post)
{
  // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://market.e-com.plus/scripts/login");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_POST, 1);

  $headers = array();
  $headers[] = "Content-Type: application/x-www-form-urlencoded";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);
}
