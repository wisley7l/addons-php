<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// variable to check the user login, because some options are only allowed for online users
/*
// check if there was a login attempt and treats error and success attempts
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

if (!empty($_GET['id'])){
  // query partner items by id
  // and  info author
  // search the last 3 apps and themes
  // count app total and user themes
  //obs: query athor in db
  // TODO:
  $id_author = (int) $_GET['id'];
  // OBS: when you are ready to enable these functions below.
  $info_author = search_partner_id($id_author); // bring the query to this page
  $apps = search_apps_partner($id_author); // return all apps
  $themes = search_themes_partner($id_author); // return all themes
  $total_apps = count($apps);
  $total_themes = count($themes);
  $info_author['number_apps_themes'] = $total_themes + $total_apps;
}else {
  // redirect error page
  header("Location: error-page");
  exit;

}

if ($info_author == 404) {
  header("Location: error-page");
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
  'path_file' => $_SERVER['PATH_FILE'] . "?id=" . $_GET['id']
);
// test comments
// query comments in db limit in 2
// not implemted
$comments = array(
  array('name' => 'C 1', 'path_image' => '', 'date' => '22 January  2018', 'is_buyer' => true, 'comment' => 'Este é um comentário de teste '),
  array('name' => 'C 2', 'path_image' => '', 'date' => '25 January  2018', 'is_buyer' => false, 'comment' => 'Este é outro comentário de teste '),
);

// obs: Search all categories in db
// test all category  // Perform db query to obtain this information
$app_category = get_categories_app();
$theme_category = get_categories_theme();

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('profile-page.twig', array(
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
