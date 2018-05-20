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
if ($_SESSION['login'] == false OR $_SESSION['is_store'] == 0) { // if not connected
  //header("Location: ../#ERRORLOGIN");
  exit;
}
// $_SESSION['user_id']
// $_SESSION['is_store']
$id_user = (int) $_SESSION['user_id'];

var_dump($_GET);

if ((int)$_GET["is_app"] == 0) {
  $conn = $GLOBALS['conn']; // get varible global conn
  $id_buy = (int)$_GET['id'];
  $query = "SELECT b.id, b.store_id, b.payment_status, b.license_type,
    b.template_id, t.json_body
    FROM buy_themes b, themes t
    WHERE b.id = $id_buy AND b.store_id = $id_user AND b.payment_status = 1
    AND t.id = b.theme_id;";

  if ( $result = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
      $id_template = (int) $row['template_id'];
      $templates = json_decode($row['json_body'],true)['templates'];
    }
    // free result set
    mysqli_free_result($result);
  }else {
    echo "errorrrrrr";
    echo PHP_EOL;
    echo mysqli_error($conn);
  }

  var_dump($id_template);
  var_dump($templates);
  $filepath = verify_template($templates['templates'], $id_template)["path_zip"];
  var_dump($filepath);
  sendFile($filepath,0);
}
