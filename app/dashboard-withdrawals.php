<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// variable to check the user login, because some options are only allowed for online users

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
  // query the user in db for more information to update
  // ex: about user, website, email
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
  exit;
}
if ($_SESSION['login'] == false) {
  header("Location: error-page");
}
//(end) * Required on all pages *

//TODO:


// $item = array();
$withdrawal = array(
  'id' => 1,
  'id_partner' => 3,
  'code' => 'EF001',
  'value' => 12,
  'date' => '2 de marco',
 );
 // array_push($item, $buy);
 // array_push($item, $buy);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('dashboard-withdrawls.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
    // test
  'user' => $user_login,
  'item' => $item,
  'limit_withdrawl' => $_SESSION['creadits']
));
