dashboard-statement<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// variable to check the user login, because some options are only allowed for online users
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
  // query the user in db for more information to update
  // ex: about user, website, email
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
}
if ($login == false) {
  header("Location: error-page");
}
//(end) * Required on all pages *

// obtain the total number of items sold and the total amount collected from the user's sales
$sales_user = array(
  'total_items' => 100 ,
  'total_earnings' => 2000 / $dictionary['mult_coin']
);


// get categories
$app_category = get_categories_app();
$theme_category = get_categories_theme();

$total_cat_theme = count($theme_category);
$total_cat_app = count($app_category);
var_dump($app_category);
echo $total_cat_app;


// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('dashboard-uploaditem.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
  'total_cat_theme' => $total_cat_theme,
  'total_cat_app' => $total_cat_app,
    // test
  'user' => $user_login,
  'sales_user' => $sales_user,
  'is_app' => 1
));
