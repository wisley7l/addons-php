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
if(empty($_POST) OR ((int)$_POST['is_app'] == 1)) { // not exist post
  // echo "error post";
  header("Location: ../history-transaction#");
  exit;
}else {
  // var_dump($_POST);
  $id_store = (int) $_SESSION['user_id'];
  $id_buy = (int) $_POST['id_buy'];
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT b.template_id, t.json_body FROM buy_theme b, themes t
    WHERE (b.theme_id = t.id AND b.payment_status = 1 AND b.store_id = $id_store
       AND b.id = $id_buy) LIMIT 1; ";

}

// download only themes
