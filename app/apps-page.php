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
  var_dump($_SESSION);
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
  header("Location: ".$_SERVER['PATH_FILE']);
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

// query for apps
$number_found = 0;
//info search
$info_page = array(
  'app_store' => true,
  'number_found' => $number_found
);
// query filter itens
$filter_segment = array(
  array('name' => 'Test 1', 'href' => '#', 'active' => 'active'),
  array('name' => 'Test 2', 'href' => '#', 'active' => '' )
);
// query apps in db
$apps = array(
  array('name' => 'APP1', 'name_partner' => 'Partner 1', 'value' => 12.03 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP2', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP3', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 0, 'star_off' => 0, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP4', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP5', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP6', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP7', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP8', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP9', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP10', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP11', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP12', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP13', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP14', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP15', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP16', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP17', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP18', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP19', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP20', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP21', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' )
);
// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('apps-themes-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'segment' => $filter_segment,
  // test apps
  'apps_themes' => $apps,
  'user' => $user_login
));
