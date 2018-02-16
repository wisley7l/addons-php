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
    'address' => array('city' => $_POST['ciy'] , 'country' => $_POST['country'] ),
    'about_us' => $_POST['about']
  );
  $profile_json = json_encode($profile);

  if ($_POST['pass'] == 'empty') {
    // query without changing password
    //echo "Não Muda senha";
    echo $profile_json;
     //$query = "UPDATE `partners` SET `profile_json` =  WHERE id=$id";
  }else {
    // password is changed
    //echo "Muda senha";
    echo $profile_json;
  }

}


/* table partners

`id` SMALLINT UNSIGNED NOT NULL,
`username` VARCHAR (30) NOT NULL,
`password_hash` VARCHAR (255) NULL,
`member_since` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`avg_stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
`evaluations` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
`path_image` VARCHAR(255) NULL,
`profile_json` TEXT NULL,
`credit` MEDIUMINT NOT NULL DEFAULT 0,

*/
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
