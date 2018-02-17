<?php
//header('Content-Type: text/html; charset=utf-8');
echo PHP_EOL;
//var_dump($_POST);
echo PHP_EOL;
//var_dump($_FILES); // send image profile
// check if the (id) logged is equal to or (id) sent
$id = (int) $_POST['id'];

// save profile image with user id name
if (empty($_POST)) {
  header("Location: ../index");
  exit;
}else { // if exists POST
  $profile = array(
    'name' => $_POST['name'],
    'public_contact' => $_POST['website'],
    'occupation' => $_POST['occupation'],
    'address' => array('city' => $_POST['city'] , 'country' => $_POST['country'] ),
    'about_us' => $_POST['about']
  );
  $profile_json = json_encode($profile);

  if ($_POST['pass'] == 'empty') {
    // query without changing password
    echo $profile_json;
     //$query = "UPDATE `partners` SET `profile_json` = $profile_json  WHERE `id`= $id";
  }else {
    // password is changed
    // check pass is equal rp-pass
    //$query = "UPDATE `partners` SET `profile_json` = $profile_json, `password_hash` = $password   WHERE `id`= $id";
    echo $profile_json;
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
