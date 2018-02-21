<?php
//header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$login = false;

//(init) * Required on all pages *
// close writing session, if it exists and intal session
session_write_close();
session_start();
// if the session exists
if (isset($_SESSION)) {
  //modify the value of the login variable, by the value saved in the session
  //var_dump($_SESSION);
  $login = $_SESSION['login'];
  // set values for user, with the values saved in the session
  // array used to set user panel parameters
  $user_login = getUserLogin($dictionary);
}
if ($login == false) { // if not connected
  header("Location: ../?EROORLOGIN");
  exit;
}
// var_dump($_POST);

if(empty($_POST)) { // not exist post
  echo "error post";
  // header("Location: ../");
} else{
  // obs: capture id partner
  $is_app  = (int) $_POST['is_app'];
  $name = $_POST['name'];
  $category = (int) $_POST['category'];
  $numversion = $_POST['numversion'];
  $description = $_POST['description'];
  $scripturl = $_POST['scripturl'];
  $github = $_POST['github'];
  $website = $_POST['website'];
  $linkvideo = $_POST['linkvideo'];
  $linkdoc  = $_POST['linkdoc'];
  $type_app = $_POST['type_app'];
  $module_type = $_POST['module_app'];
  /*
   is_app == 1 create app, == 0 create theme
   name // name
   category // relationship category and item
   numversion // app and theme
   description // app and theme
   scripturl // app
   github // app
   website // app
   linkvideo // app and theme
   linkdoc // theme
   */
   var_dump($_POST);

}

/*
type app
dashboard 1
string 2
storefront 3
string 4
module_package 4
string 6
external 7
string 8
*/
