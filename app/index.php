<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// test alert
if (isset($_GET['EROORLOGIN'])) {
    print '<script type="text/javascript">alert("Erro de LOGIN");</script>';
}
// TODO: parse twig template
// variable to check user login
$login = false;
// necessary variables for information
// number of partners and stores, and total apps and themes
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
//query user
//test user
$user_login = array(
  'name_user' => 'Wisley ',
  'credits' => 10.0 / $dictionary['mult_coin'] ,
  'id_user' => 1,
  'is_store' => false
);

// obs: Search all categories in db
// test all category  // Perform db query to obtain this information
$all_category = array(
  array('name' => 'All category' , 'value' => '0' ),
  array('name' => 'Category 1' , 'value' => '1' ),
  array('name' => 'Category 2' , 'value' => '2' )
);

// test apps  // Perform db query to obtain this information
$apps = array(
  array('name' => 'APP1', 'name_partner' => 'Partner 1', 'value' => 12.03 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP2', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP3', 'name_partner' => 'Partner 2', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 0, 'star_off' => 0, 'image' => '../images/items/westeros_m.jpg' )
);
// test themes // Perform db query to obtain this information
$themes = array(
  array('name' => 'THEME1', 'name_partner' => 'Partner 4', 'value' => 12.03 / $dictionary['mult_coin'], 'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME2', 'name_partner' => 'Partner 5', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 0, 'star_off' => 5, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME3', 'name_partner' => 'Partner 6', 'value' => 15.50 / $dictionary['mult_coin'], 'star_on' => 5, 'star_off' => 0, 'image' => '../images/items/westeros_m.jpg' )
);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('index.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'implemented' => false,
  'info_footer' => $info_footer,
    // test itens
  'all_category' => $all_category,
  'apps' => $apps,
  'themes' => $themes,
  'user' => $user_login
));
