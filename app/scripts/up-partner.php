<?php
//header('Content-Type: text/html; charset=utf-8');
echo PHP_EOL;
//var_dump($_POST);
echo PHP_EOL;
//var_dump($_FILES); // send image profile
// check if the (id) logged is equal to or (id) sent
$id = (int) $_POST['id'];
var_dump($_POST);

// save profile image with user id name
if (empty($_POST)) {
  header("Location: ../index");
  exit;
}else { // if exists POST
  if (!empty($_POST['pass'])) {
    $pass_hash = $_POST['pass'];
    echo $pass_hash;
    $pass = password_hash($pass_hash, PASSWORD_DEFAULT);
    echo $pass;
    // query without changing password
     //$query = "UPDATE `partners` SET `password_hash` = $pass_hash  WHERE `id`= $id";
  }else {
    # error
  }

}

// function upload partner //
/*
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
