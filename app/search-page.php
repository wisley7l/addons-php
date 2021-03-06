<?php
//var_dump($_GET);

// varible select filter
$filter = array('all' => 'selected',
 'free' => '',
);

 if (!isset($_GET['app']) and !isset($_GET['term']) and !isset($_GET['filter'])){
  // app is empty
  //echo "error";
} else if (isset($_GET['term']) and isset($_GET['x']) ){
  // fix search
  header("Location: ?term=" . $_GET['term']);
  exit;
} elseif (isset($_GET['term'])) {
  $name_item = $_GET['term'];
  $number_found = 0;
  // OBS: when you are ready to enable these functions below.
  $apps = search_apps_all_name(12,$name_item); // return a maximum of 12 apps in the search
  $themes = search_themes_all_name(12,$name_item); // return a maximum of 12 apps in the search
  $apps_themes = array_merge($apps,$themes);
  $number_found = count($apps_themes);

} else if (isset($_GET['filter'])){
  if($_GET['filter'] == 'all'){
    header("Location: ?term=" . $_GET['name']);
    exit;
  }
  if ($_GET['filter'] == 'free') {
    // search items free
    // count the number of items found
    $filter['all'] = '' ;
    $filter['free'] = 'selected';
    $name_item = $_GET['name'];
    // filter items free
    // count the number of items found
    $number_found = 0;
    // OBS: when you are ready to enable these functions below.
    $apps = search_apps_free_name(12,$name_item); // return a maximum of 12 apps in the search
    $number_found = count($apps);
    $themes = search_themes_free_name(12,$name_item); // return a maximum of 12 apps in the search
    $apps_themes = array_merge($apps,$themes);
    $number_found = count($apps_themes);

  }
}else if ((int) $_GET['app'] == 1 and isset($_GET['name']) ) {
  // app is 1
  # seacrh app
  // redirect theme page term= name
  header("Location: apps-page?term=" . $_GET['name']);
  exit;
}else if ((int) $_GET['app'] == 0 and isset($_GET['name'])) {
  // app is 0
  # search theme
  // redirect theme page term= name
  header("Location: theme-page?term=" . $_GET['name']);
  exit;
}
// else {
//   // count the number of items found
//   $number_found = 2;
//   // query all items
//
//   // test apps  // Perform db query to obtain this information limit 3
//   // query apps in db
//   $item = getAppThemeTest(1001,2,$dictionary,1);
//   $item2 = getAppThemeTest(1000,2,$dictionary,1);
//   $apps = array();
//   // add element in array
//   array_push($apps, $item);
//   array_push($apps, $item2);
// }

// treat template page

header('Content-Type: text/html; charset=utf-8');
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
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  header("Location: index");
  exit;
}

//(end) * Required on all pages *

// obs: query db for informations
$total_apps_and_themes = 0;
$count_partners = 0;
$info_footer = array(
  'total_apps_and_themes' => $total_apps_and_themes,
  'count_partners' => $count_partners,
  'path_file' => $_SERVER['PATH_FILE']
);

// obs: Search all categories in db
// test all category  // Perform db query to obtain this information
$app_category = get_categories_app();
$theme_category = get_categories_theme();
// difine page





//info search
$info_page = array(
  'name' => $name_item,
  'number_found' => $number_found
);



// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('search-item.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
  'all_category' => $app_category,
  'filter' => $filter,
  // test apps
  'apps_themes' => $apps_themes,
  'user' => $user_login,
));
