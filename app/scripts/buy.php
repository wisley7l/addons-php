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

  if ($is_app == 0) {

    $query =  "SELECT b.theme_value, b.theme_id, t.partner_id FROM buy_themes b, themes t
      WHERE (b.id = $id_buy AND  b.store_id = $id_store ) LIMIT 1;";

    if ( $result = mysqli_query($conn, $query)) {
      if (mysqli_num_rows($result) > 0 ) {
        // header("Location: ../");
        // exit();
      }
      while ($row = mysqli_fetch_assoc($result)) {
        $price = $row['theme_value'];
        $id_partner = $row['partner_id'];
        $id_app = $row['theme_id'];
      }
      $transaction_code  = 'code-' . uniqid();

      // free result set
      mysqli_free_result($result);
    }else {
      echo "errorrrrrr";
      echo PHP_EOL;
      echo mysqli_error($conn);
    }

    $id_transaction = insert_history_transaction ($id_partner, $id_store, NULL,
      $id_app, $price, $transaction_code, 'notes', 'description', NULL);
    echo PHP_EOL;
    echo $id_transaction;
    echo PHP_EOL;
    // query  get id historic_transaction passed code_trasaction
    // query updadte buy_themes
    //query updadte partner credits

    update_partner_credits($id_partner,$price);
    update_buy_themes($id_buy,$id_transaction);
    echo "SUCESS";
}
elseif ($is_app == 1) {
  $query =  "SELECT b.app_value, b.app_id, a.partner_id, a.plans_json FROM buy_apps b, apps a
    WHERE (b.id = $id_buy AND  b.store_id = $id_store ) LIMIT 1;";

  if ( $result = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($result) > 0 ) {
      // header("Location: ../");
      // exit();
    }
    while ($row = mysqli_fetch_assoc($result)) {
      $price = $row['app_value'];
      $id_partner = $row['partner_id'];
      $id_app = $row['app_id'];
      $id_plan = $row['plan_id'];
      $plans =  json_decode($row['plans_json'],true); // increment total items on profile page
    }
    $transaction_code  = 'code-' . uniqid();
    $duration_plan = (int) verify_plan($plans['plans'], $id_plan)['duration'];
    // free result set
    mysqli_free_result($result);
  }else {
    echo "errorrrrrr";
    echo PHP_EOL;
    echo mysqli_error($conn);
  }

  $id_transaction = insert_history_transaction_2 ($id_partner, $id_store,$id_app,
   NULL,$price, $transaction_code, '-', '-', NULL);
  echo PHP_EOL;
  echo $id_transaction;
  echo PHP_EOL;
  // query  get id historic_transaction passed code_trasaction
  // query updadte buy_themes
  //query updadte partner credits

  update_partner_credits($id_partner,$price);
  update_buy_apps($id_buy,$id_transaction,$duration_plan);
  echo "SUCESS";
}


}else if ((int) $_POST['is_app'] == 1) {
  // mount query for app purchase
  var_dump($_POST);
  echo "APP";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
  echo PHP_EOL;
  echo $id_plan;
  echo PHP_EOL;

  $conn = $GLOBALS['conn']; // get varible global conn
  $query =  "SELECT a.plans_json
    FROM apps a
    WHERE (a.id = $id_app) LIMIT 1;";
    //*
    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $plans =  json_decode($row['plans_json'],true); // increment total items on profile page
      }
     // var_dump($plans);
     // echo PHP_EOL;
      // free result set
      mysqli_free_result($result);
    }
    else {
      header("Location: ../item-page?id=" . $id_app . "&app=" .  (int) $_POST['is_app'] . "#ErrorConsult");
      exit;
    }
    $v = verify_plan($plans['plans'], $id_plan);

    if(!$v['verify'] OR $v['price'] != treatNumber($price)){
      echo "ERROR";
      exit();
    }
    // verifica se ja esta no carrinho, para nao comprar o mesmo produto
    $query =  "SELECT id FROM buy_apps WHERE (app_id = $id_app AND  store_id = $id_store AND plan_id = $id_plan
     AND payment_status = 0) LIMIT 1;";
    if ( $result = mysqli_query($conn, $query)) {
      if (mysqli_num_rows($result) > 0 ) {
        header("Location: ../item-page?id=" . $id_app . "&app=" .  (int) $_POST['is_app'] . "&InCar");
        exit();
      }
    }
    else {
      header("Location: ../item-page?id=" . $id_app . "&app=" .  (int) $_POST['is_app'] . "#ErrorQuery");
      exit();
    }
    // cria buy plan
    $date_duration = (int)$v['duration'];
    $day_add = (int)($date_duration/2);
    $date_init = time ();
    $date_end = $date_init + ($date_duration*30*24*60*60) + ($day_add*24*60*60);
    $date_renovation = $date_end - (15*24*60*60);
    $date_init = date("Y-m-d H:i:s",$date_init);
    $date_end = date("Y-m-d H:i:s",$date_end);
    $date_renovation = date("Y-m-d H:i:s",$date_renovation);
    // /*
    $query =  "INSERT INTO `buy_apps` (`app_id`, `store_id`,`date_init`,
     `date_end`,`date_renovation`,`type_plan`,`app_value`,`payment_status`,`plan_id`,`id_transaction`)
       VALUES ($id_app,$id_store,'$date_init','$date_end','$date_renovation',0,$price,0,$id_plan,NULL)";

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
  $v = verify_plan($plans,$id_plan);
  if (!$v['verify'] OR $v['price'] != treatNumber($price)) {
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
