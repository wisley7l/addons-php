<?php
header('Content-Type: text/html; charset=utf-8');
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
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
}
//(end) * Required on all pages *





if (isset($_GET['id']) AND isset($_GET['app'])){
  echo $_GET['id'];
  echo PHP_EOL;
  echo $_GET['app'];
  if ( $_GET['app'] == 1) {
    $app = 1;
  }
  else{
    $app = 0;
  }
}
else {
  echo "<h1> error </h1>";
}

$info_page = array('app' => $app,
);

$plan1 = array('id' => 'licence-regular',
  'name' => 'License Regular',
  'price' => 16,
  'description' => 'Test description'
);

$plans = array();
array_push($plans, $plan1);

// necessary variables for information
// number of partners and stores, and total apps and themes
// obs: query db for information or configure as static (avoid excessive queries)
$total_apps_and_themes = 0; // not implemented in the first moment
$count_partners = 0; // not implemented in the first moment
$info_footer = array(
  'total_apps_and_themes' => $total_apps_and_themes,
  'count_partners' => $count_partners,
  'path_file' => $_SERVER['PATH_FILE']
);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('item-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
  'all_category' => $all_category,
  'filter' => $filter,
  'info_page' => $info_page,
  'plans' => $plans,
  // test apps
  'apps_themes' => $apps,
  'user' => $user_login,
  'search_id' => $id_category
));
