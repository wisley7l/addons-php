<?php
$dictionary = get_dictionary();

$conn = connect_db();
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
if ($_SESSION['login'] == false || $_SESSION['is_store'] == false) { // if not connected
  header("Location: ../item-page?id=" . $_POST['id_app'] . "&app=".  $_POST['is_app'] . "#notbuy");
  exit;
}

// var_dump($_POST);
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
$id_plan = (int) $_POST['id_plan'];

if ((int) $_POST['is_app'] == 1) {
  // mount query for app purchase
  echo "APP";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
  echo PHP_EOL;
  // consult in bd and verify
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
  echo PHP_EOL;
  // consult in bd and verify

  $conn = $GLOBALS['conn']; // get varible global conn
  $query =  "SELECT t.json_body
    FROM themes t
    WHERE (t.id = $id_app) LIMIT 1;";

    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $theme =  json_decode($row['json_body'],true); // increment total items on profile page
      }
     // var_dump($theme);
      // free result set
      mysqli_free_result($result);
    }
    else {
      echo "error";
    }

  $plans = $theme['plans']['plans'];
  // var_dump($plans);
  $templates = $theme['templates']['templates'];

  if (!verify_plan($plans,$id_plan)) {
    header("Location: ../item-page?id=" . $id_app . "&app=" .  $_POST['is_app'] . "#plan");
    exit;
  }


}else {
  // redirect error page or alert error
}


function verify_plan($array_plan, $id_plan)
{
  $r = 0;
  for ($i=0; $i < count($array_plan) ; $i++) {
    if ($array_plan[$i]['id'] == $id_plan ) {
      $r = 1;
      break;
    }
  }
  return $r;
}
