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

$id_store = (int) $_SESSION['user_id'];

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
$price = (int) number_format((float) $_POST['value'], 2, '', '');
$id_plan = (int) $_POST['id_plan'];

if (empty($_POST)) {
  var_dump($_GET); // get (page car)
  $is_app =  (int) $_GET['is_app'];
  $id_buy = (int) $_GET['id_buy'];
  $id_store = (int) $_GET['id_store'];

  $conn = $GLOBALS['conn']; // get varible global conn
  $query =  "SELECT b.theme_value, t.partner_id FROM buy_themes b, themes t
    WHERE (b.id = $id_buy AND  b.store_id = $id_store ) LIMIT 1;";

  if ( $result = mysqli_query($conn, $query)) {
    echo "string";
    if (mysqli_num_rows($result) > 0 ) {
      // header("Location: ../");
      // exit();
    }
    while ($row = mysqli_fetch_assoc($result)) {
      $price = $row['theme_value'];
      $id_partner = $row['partner_id'];
    }
    $transaction_code  = 'code' . uniqid();

    // free result set
    mysqli_free_result($result);
  }else {
    echo "errorrrrrr";
    echo PHP_EOL;
    echo mysqli_error($conn);
  }
  echo PHP_EOL;
  echo $price;
  echo PHP_EOL;
  echo $id_partner;
  echo PHP_EOL;
  echo $transaction_code;
  //insert_history_transaction ($id_partner, $id_store, NULL, $id_app, $price,
  //  $transaction_code, 'notes', 'description', NULL);
  /*
  payment_status
  id_transaction
  ////

  */

  // query  get id historic_transaction passed code_trasaction
  // query updadte buy_themes


}else if ((int) $_POST['is_app'] == 1) {
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
  // echo "THEME";
  // echo PHP_EOL;
  // echo $id_app;
  // echo PHP_EOL;
  // echo $price;
  // echo PHP_EOL;
  // echo $id_template;
  // echo PHP_EOL;
  // consult in bd and verify

  $conn = $GLOBALS['conn']; // get varible global conn
  $query =  "SELECT t.json_body
    FROM themes t
    WHERE (t.id = $id_app) LIMIT 1;";
    //*
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
      header("Location: ../item-page?id=" . $id_app . "&app=" .  (int) $_POST['is_app'] . "#ErrorConsult");
      exit;
    }

  $plans = $theme['plans']['plans'];
  // var_dump($plans);
  $templates = $theme['templates']['templates'];
  // var_dump($templates);

  if (!verify_plan($plans,$id_plan)) {
    header("Location: ../item-page?id=" . $id_app . "&app=" .  (int) $_POST['is_app'] . "&ErrorPlan");
    exit;
  }

  if (!verify_template($templates,$id_template)) {
    header("Location: ../item-page?id=" . $id_app . "&app=" .  (int) $_POST['is_app'] . "&ErrorTemplate");
    exit;
  }

  $query =  "SELECT id FROM buy_themes WHERE (theme_id = $id_app AND  store_id = $id_store and template_id = $id_template) LIMIT 1;";
  if ( $result = mysqli_query($conn, $query)) {

    if (mysqli_num_rows($result) > 0 ) {
      header("Location: ../item-page?id=" . $id_app . "&app=" .  (int) $_POST['is_app'] . "&InCar");
      exit();
    }
  }
  $query =  "INSERT INTO `buy_themes` (`theme_id`, `store_id`,`theme_value`,
   `payment_status`, `license_type`,`id_transaction`, `template_id` )
     VALUES ($id_app,$id_store,$price,0,$id_plan,NULL,$id_template);";
  //*/
  //*
  // query search app and theme for index page
  if (!mysqli_query($conn, $query)) {
    echo "ERROR";
    echo PHP_EOL;
    echo mysqli_error($conn);
    // // error INSERT // redirect
    // header("Location: ../dashboard-uploaditem#ERRORInsertApp");
    exit();
  }
  $id_buy = (int) mysqli_insert_id($conn);
  echo $id_buy;
//*/


}else {

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

function verify_template($array_template, $id_template)
{
  $r = 0;
  for ($i=0; $i < count($array_template) ; $i++) {
    if ($array_template[$i]['id'] == $id_template ) {
      $r = 1;
      break;
    }
  }
  return $r;
}
