<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$name_item;
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
// varible select filter
$filter = array('all' => 'selected',
 'free' => '');
// filter categories and price
// filter categories and price
if (isset($_GET['filter'])){ // if exists filter
  if($_GET['filter'] == 'all'and !empty($_GET['name'])){ // filter is all and name item
    header("Location: theme-page?term=" . $_GET['name']);
    exit;

  }else if($_GET['filter'] == 'all'){ // filter is all and not name item
    header("Location: theme-page");
    exit;
  }else  if ($_GET['filter'] == 'free' and !empty($_GET['name'])) { // filter is free and name item
    $name_item = $_GET['name'];
    // search items free with name
    // count the number of items found
    $filter['all'] = '';
    $filter['free'] = 'selected';
    $number_found = 0;
    // OBS: when you are ready to enable these functions below.
    // $themes = search_themes_free_name(12,$name_item); // return a maximum of 12 themes in the search
    // $number_found = count($themes);

  }else if ($_GET['filter'] == 'free') { //filter is free and not name
    // search items all free
    // count the number of items found
    $filter['all'] = '';
    $filter['free'] = 'selected';
    $number_found = 0;
    // OBS: when you are ready to enable these functions below.
    // $themes = search_all_themes_free(12); // return a maximum of 12 themes in the search
    // $number_found = count($themes);
  }else {
    header("Location: theme-page");
    exit;
  }
}
else if (isset($_GET['term']) and isset($_GET['x']) ){
  // fix search
  header("Location: ?term=" . $_GET['term']);
  exit;
}
else if (isset($_GET['term'])){
  $name_item = $_GET['term'];
  // create query for search item by term
  // count the number of items found
  $number_found = 0;
  // OBS: when you are ready to enable these functions below.
  // $themes = search_themes_all_name(12,$name_item); // return a maximum of 12 themes in the search
  // $number_found = count($themes);

} else {
  // count the number of items found
  $number_found = 2;
  // query all items

  // test apps  // Perform db query to obtain this information limit 3
  // query apps in db
  $item = getAppThemeTest(1112,3,$dictionary,0);
  $item2 = getAppThemeTest(1110,3,$dictionary,0);
  $themes = array();
  // add element in array
  array_push($themes, $item);
  array_push($themes, $item2);
  // OBS: when you are ready to enable these functions below.
  // $themes = search_all_themes(12); // return a maximum of 12 apps in the search
  // $number_found = count($themes);

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

//info search
$info_page = array(
  'name' => $name_item,
  'app_store' => false,
  'search_id' => 0,
  'number_found' => $number_found
);
// query filter itens
$filter_segment = array(
  array('name' => 'Test 1'),
  array('name' => 'Test 2')
);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('apps-themes-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'segment' => $filter_segment,
  'filter' => $filter,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
  'all_category' => $theme_category,
  // test apps
  'apps_themes' => $themes,
  'user' => $user_login,

));
