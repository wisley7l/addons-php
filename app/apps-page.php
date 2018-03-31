<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$name_item; // variable save term search

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
if ($_GET['filter'] == 'free') {
  $filter['all'] = '';
  $filter['free'] = 'selected';
  $_filter = '&filter=free';
}elseif ($_GET['filter'] == 'all') {
  $_filter = '&filter=all';
} else{
  $_filter = '';
}

if (!empty($_GET['category'])) {
  echo $_GET['category'];
  $category = '&category=' . $_GET['category'];
}else {
  $category = '';
}

$page = 'apps-page?type=' . $_GET['type'] . $category;

// redirect search page
if (!empty($_GET['term'])) {

}


if ($_GET['type'] == 'apps') {
  $title_page = $dictionary['word_apps_store'];


}elseif ($_GET['type'] == 'themes') {
  $title_page = $dictionary['word_themes_store'];

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

//info search
$info_page = array(
  'name' => $title_page . $name_item,
  'search_id' => 0, // sected category
  'number_found' => $number_found,
  'page' => $page
);
// query filter itens
$filter_segment = array(
  array('name' => 'Test 1'),
  array('name' => 'Test 2' )
);
// obs: Search all categories in db
// test all category  // Perform db query to obtain this information
$app_category = get_categories_app();
$theme_category = get_categories_theme();

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('apps-themes-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'segment' => $filter_segment,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
  'filter' => $filter,
  'all_category' => $app_category,
  // test apps
  'apps_themes' => $apps,
  'user' => $user_login
));
