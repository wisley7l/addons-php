<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// setcookie("nonce","-");
// variable to check the user login, because some options are only allowed for online users
// check if there was a login attempt and treats error and success attempts
/*
if (isset($_GET['EROORLOGIN'])) {
  // create hidden div to handle login error attempt
    print '<div class="addons-error-login" style="display:none">' . $dictionary['word_invalid_login'] . '</div>';
}
if (isset($_GET['SUCCESSLOGIN'])) {
    // create hidden div to handle login success attempt
    print '<div class="addons-sucess-login" style="display:none">' . $dictionary['word_sucess_login'] . '</div>';
}
*/
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

if (isset($_GET['category_name']) AND isset($_GET['category_name'])){
  if (empty($_GET['category_name'])) {
    print '<h2 style= "text-align:center; color:blue">' . $dictionary['word_search_empty'] . '</h2>';
  }else if ((int) $_GET['categories'] == 1) {
    // seacrch for app with name category_name
    // redirect for search page with parameters
    header("Location: apps-page?type=apps"."&name=" . $_GET['category_name']);
  }
  else if ((int) $_GET['categories'] == 0) {
    // seacrch for theme with name category_name
    // redirect for search page with parameters
    header("Location: apps-page?type=themes" . "&name=" . $_GET['category_name']);
    exit;

  }
  else {
    // to try search error or redirect to error page
    header("Location: error-page");
    exit;
  }
  // obs: treat search
  //  category_name=&categories=0
}

//OBS: when you are ready to enable these functions below.
$apps = search_all_apps(24); // return a maximum of 25 apps in the search
$themes = search_all_themes(24); // return a maximum of 25 themes in the search

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

// option search item for name
$search_item = array(
  array('id' => 1 , name => $dictionary['word_app'] ),
  array('id' => 0 , name => $dictionary['word_theme'] )
);


// get categories
$app_category = get_categories_app();
$theme_category = get_categories_theme();

// echo session_id(); // test
// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('index.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
  'info_footer' => $info_footer,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
    // test itens
  'apps' => $apps,
  'themes' => $themes,
  'user' => $user_login,
  'search' => $search_item
));
