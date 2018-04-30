<?php
// create connection to the database
$conn = connect_db();
//*/
////header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();

//(init) * Required on all pages *
// close writing session, if it exists and intal session
session_write_close();
session_start();
// if the session exists
if (isset($_SESSION)) {
  //modify the value of the login variable, by the value saved in the session
  //var_dump($_SESSION);
  // set values for user, with the values saved in the session
  // array used to set user panel parameters
  $user_login = getUserLogin($dictionary);
}
if ($_SESSION['login'] == false) { // if not connected
  //header("Location: ../#ERRORLOGIN");
  exit;
}
// var_dump($_POST);
// get id_partner
$id_store = (int) $_SESSION['user_id'];
echo $id_store;

var_dump($_POST);
