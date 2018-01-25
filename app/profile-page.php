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
    'id_user' => $_SESSION['user_id'],
    'name_login' => $_SESSION['user_name'] ,
    'name' => $_SESSION['name'],
    'credits' => $_SESSION['credits'] / $dictionary['mult_coin'] ,
    'is_store' => $_SESSION['is_store'],
    'path_image' => $_SESSION['path_image']
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

if (isset($_GET['id'])){
  //echo $_GET['id'];
  // query partner items by id
  // and  info author
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
//obs: query athor in db
$info_author = array(
  'id' => 1,
  'name' => 'Partner 2',
  'location' => 'Brazil',
  'description' => 'dev',
  'member_since' => '1 Janary 2018',
  'total_sales' => 100, // sales quantity query
  'web_site' => 'www.example.com',
  'path_image' => 'http://bluebus-wp.s3.amazonaws.com/wp-content/uploads/2014/04/Mike-Mitchell-Marvel-Portraits-Time-mitchell_spiderman_press.jpg',
  'number_apps_themes' => 3, // quantity of items found
  'number_badges' => 1, //not implemented
  'stars' => 1, // not implemented
  'evaluations' => 5 // not implemented
);
// test apps  // Perform db query to obtain this information limit 3
// query apps in db
$item2 = array(
  'id_app' => 1100,
  'name' => 'APP2',
  'id_partner' => 1,
  'name_partner' => 'Partner 2',
  'value' => 20.03 / $dictionary['mult_coin'],
  'star_on' => 3,
  'star_off' => 2,
  'image' => '../images/items/westeros_m.jpg',
  'image_partner' => 'http://bluebus-wp.s3.amazonaws.com/wp-content/uploads/2014/04/Mike-Mitchell-Marvel-Portraits-Time-mitchell_spiderman_press.jpg',
  'is_app'=> 1
);
// query apps in db
$apps = array();
// add element in array
array_push($apps, $item2);
// test themes  // Perform db query to obtain this information limit 3
// query apps in db
$item = array(
  'id_app' => 1000,
  'name' => 'THEME2',
  'id_partner' => 1,
  'name_partner' => 'Partner 2',
  'value' => 20.03 / $dictionary['mult_coin'],
  'star_on' => 3,
  'star_off' => 2,
  'image' => '../images/items/westeros_m.jpg',
  'image_partner' => 'http://bluebus-wp.s3.amazonaws.com/wp-content/uploads/2014/04/Mike-Mitchell-Marvel-Portraits-Time-mitchell_spiderman_press.jpg',
  'is_app'=> 0
);
$themes = array();
// add element in array
array_push($themes, $item);
// test comments
// query comments in db limit in 2
$comments = array(
  array('name' => 'C 1', 'path_image' => '', 'date' => '22 January  2018', 'is_buyer' => true, 'comment' => 'Este é um comentário de teste '),
  array('name' => 'C 2', 'path_image' => '', 'date' => '25 January  2018', 'is_buyer' => false, 'comment' => 'Este é outro comentário de teste '),
);


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
  'themes' => $themes,
  'comments' => $comments
));
