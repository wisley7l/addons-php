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
  header("Location: index");
}

// filter price , filter categories redirect page category
if (isset($_GET['filter'])){
  if($_GET['filter'] == 'all'){
    header("Location: theme-page");
    exit;
  }
  if ($_GET['filter'] == 'free') {
    // filter items free
    // count the number of items found
    $number_found = 0;
  }
}
else if (isset($_GET['term']) and isset($_GET['x']) ){
  // fix search
  header("Location: ?term=" . $_GET['term'] . "&app=1");
  exit;
}
else if (isset($_GET['term']) and isset($_GET['app'])){
  echo $_GET['term'];
  echo PHP_EOL;
  echo $_GET['app'];
  // create query for search item by term
  // if app == 1 is app else theme

  // count the number of items found
  $number_found = 0;

} else {
  // count the number of items found
  $number_found = 2;
  // query all items

  // test apps  // Perform db query to obtain this information limit 3
  // query apps in db
  $item = getAppTheme(1001,2,$dictionary,1);
  $item2 = getAppTheme(1000,2,$dictionary,1);
  $apps = array();
  // add element in array
  array_push($apps, $item);
  array_push($apps, $item2);
}

//(end) * Required on all pages *

// obs: query db for informations
$total_apps_and_themes = 0;
$count_stores = 0;
$count_partners = 0;
$info_footer = array(
  'total_apps_and_themes' => $total_apps_and_themes,
  'count_stores' => $count_stores,
  'count_partners' => $count_partners,
  'path_file' => $_SERVER['PATH_FILE']
);

// obs: Search all categories in db
// test all category  // Perform db query to obtain this information
$all_category = get_categories_app();
var_dump($all_category);

if($all_category['id'] == 1) {
    echo 'encontrei';
}


//info search
$info_page = array(
  'name' => '',
  'number_found' => $number_found
);
// query filter itens
$filter_segment = array(
  array('name' => 'Test 1'),
  array('name' => 'Test 2' )
);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('search-category.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'segment' => $filter_segment,
  'all_category' => $all_category,
  // test apps
  'apps_themes' => $apps,
  'user' => $user_login,
  'search_id' => 1
));