<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$login = true;
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
  'app_store' => false,
  'number_found' => $number_found
);
// query apps in db
$apps = array(
  array('name' => 'THEME1', 'name_partner' => 'Partner 1', 'value' => 12.03 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME2', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME3', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 0, 'star_off' => 0, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME4', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME5', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME6', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME7', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME8', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME9', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME10', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME11', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME12', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME13', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME14', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME15', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME16', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME17', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME18', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME19', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME20', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME21', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' )
);
// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('apps-themes-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  // test apps
  'apps_themes' => $apps
));
