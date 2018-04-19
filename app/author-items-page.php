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
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
  exit;
}
//(end) * Required on all pages *

// necessary variables for information
// number of partners and stores, and total apps and themes
// obs: query db for information or configure as static (avoid excessive queries)
$total_apps_and_themes = 0; // not implemented in the first moment
$count_partners = 0; // not implemented in the first moment
$info_footer = array(
  'total_apps_and_themes' => $total_apps_and_themes,
  'count_partners' => $count_partners,
  'path_file' => $_SERVER['PATH_FILE'] . "?id=" . $_GET['id']
);
if (!empty($_GET['id'])) {

  //obs: query athor in db
  $info_author = search_partner_id((int)$_GET['id']);
  // test apps  // Perform db query to obtain this information limit 3
  // query apps in db

  // query apps in db
  $apps = search_apps_partner((int)$_GET['id']);
  // query apps in db
  $themes = search_themes_partner((int)$_GET['id']);
  // test comments
  $total_apps = count($apps);
  $total_themes = count($themes);
  $info_author['number_apps_themes'] = $total_themes + $total_apps;
}
else {
  echo "ERROR";
}

// obs: Search all categories in db
// test all category  // Perform db query to obtain this information
$app_category = get_categories_app();
$theme_category = get_categories_theme();

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('author-items-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
  'implemented' => false,
  'info_footer' => $info_footer,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
    // test
  'user' => $user_login,
  'info_author' => $info_author,
  'apps' => $apps,
  'themes' => $themes,
  'comments' => $comments
));
