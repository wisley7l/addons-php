<?php
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
if ($login == false || $_SESSION['login'] == false) { // if not connected
  //header("Location: ../#ERRORLOGIN");
  exit;
}

var_dump($_POST);
//echo "Test";
/*
  treat variables for purchase

  check login and if you are a shopkeeper.
  if not logged in, redirect to login screen (create login screen obs: moblie)
  if it is app create query for plans
  if it's theme create want to buy_theme
*/
$id_app = (int) $_POST['id_app'];
$price = (float) $_POST['value'];

if ((int) $_POST['is_app'] == 1) {
  // mount query for app purchase
  echo "APP";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
  echo PHP_EOL;
}else if ((int) $_POST['is_app'] == 0) {
  $id_template = (int) $_POST['id_template'];
  // mount query for theme purchase
  echo "THEME";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
  echo PHP_EOL;
  echo $id_template;
}else {
  // redirect error page or alert error
}
