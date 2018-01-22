<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// variable to check the user login, because some options are only allowed for online users
$login = false;
// check if there was a login attempt and treats error and success attempts
if (isset($_GET['EROORLOGIN'])) {
  // create hidden div to handle login error attempt
    print '<div class="addons-error-login" style="display:none">' . $dictionary['word_invalid_login'] . '</div>';
}
if (isset($_GET['SUCCESSLOGIN'])) {
    // create hidden div to handle login success attempt
    print '<div class="addons-sucess-login" style="display:none">' . $dictionary['word_sucess_login'] . '</div>';
}
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
  $user_login = array(
    'name_user' => $_SESSION['user_name'] ,
    'credits' => 10.0 / $dictionary['mult_coin'] ,
    'id_user' => $_SESSION['user_id'],
    'is_store' => $_SESSION['is_store']
  );
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
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
  'path_file' => $_SERVER['PATH_FILE']
);
//obs: query athor in db
$info_author = array(
  'id' => 001,
  'name' => 'Author',
  'location' => 'Brazil',
  'description' => 'dev',
  'member_since' => '1 Janary 2018',
  'total_sales' => 100,
  'web_site' => 'www.example.com',
  'path_image' => '../images/avatars/avatar_09.jpg',
  'number_apps_themes' => 3,
  'number_badges' => 1,
  'stars' => 3,
  'evaluations' => 5
);
// test apps  // Perform db query to obtain this information limit 2
$apps = array(
  array('name' => 'APP1', 'name_partner' => 'Author', 'value' => 12.03 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP2', 'name_partner' => 'Author', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP3', 'name_partner' => 'Author', 'value' => 5.50 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
);
// test themes  // Perform db query to obtain this information limit 2
$themes = array(
  array('name' => 'THEME1', 'name_partner' => 'Author', 'value' => 10.03 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME2', 'name_partner' => 'Author', 'value' => 18.50 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME3', 'name_partner' => 'Author', 'value' => 28.50 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
);
// test comments
// query comments in db



// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('profile-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'implemented' => false,
  'info_footer' => $info_footer,
    // test
  'user' => $user_login,
  'info_author' => $info_author,
  'apps' => $apps,
  'themes' => $themes
));
