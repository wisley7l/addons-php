<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$login = false;
$name_item; // variable save term search
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
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
}
//(end) * Required on all pages *
// search  bar
if (isset($_GET['term']) and isset($_GET['x']) ){
  // fix search menu
  header("Location: ?term=" . $_GET['term']);
  exit;
}
else if (isset($_GET['term']) ){
  if (empty($_GET['term'])) {
    print '<h2 style= "text-align:center; color:blue">' . $dictionary['word_search_empty'] . '</h2>';
  }else {
    // search app and theme with term
    // redirect for search page with parameters
    header("Location: search-page?term=" . $_GET['term']);
    exit;
  }
}else if (!empty($_GET['email'])) {
  // redirect to check email
  //header("Location: scripts/create-password?email=" . $_GET['email']);
  //exit;
}

// if user is already logged in, redirects to error page
if ($login == true) {
  header("Location: error-page" );
  exit;
}

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


// get categories
$app_category = get_categories_app();
$theme_category = get_categories_theme();

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('register.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
    // test itens
  'themes' => $themes,
  'user' => $user_login,
  'search' => $search_item
));
