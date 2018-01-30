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
  $user_login = getUserLogin($dictionary);
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
}
//(end) * Required on all pages *

if (isset($_GET['category_name']) AND isset($_GET['category_name'])){
  if ($_GET['category_name'] == '') {
    echo "category_name is empty";
  }else {
    echo $_GET['category_name'];    
  }
  if ($_GET['categories'] == 1) {
    echo "category is APP";
  }
  else {
    echo "category is THEME";
  }

  echo $_GET['category_name'];
  echo PHP_EOL;
  echo $_GET['categories'];
  // obs: treat search
  //  category_name=&categories=0
}
else if (isset($_GET['term']) and isset($_GET['x']) ){
  // fix search
  header("Location: ?term=" . $_GET['term']);
  exit;
}
else if (isset($_GET['term']) ){
  echo $_GET['term'];
  echo PHP_EOL;
  echo $_GET['app'];
  // create query for search item by term
  // search app and theme with term

} else {
  //
  // test apps  // Perform db query to obtain this information
  // query apps in db
  $item2 = getAppTheme(1000,1,$dictionary,1);
  // query apps in db
  $apps = array();
  // add element in array
  array_push($apps, $item2);
  // test themes // Perform db query to obtain this information
  $item = getAppTheme(1111,1,$dictionary,0);
  $themes = array();
  // add element in array
  array_push($themes, $item);
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

// search item for name
$search_item = array(
  array('id' => 1 , name => $dictionary['word_app'] ),
  array('id' => 0 , name => $dictionary['word_theme'] )
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
  'apps' => $apps,
  'themes' => $themes,
  'user' => $user_login,
  'search' => $search_item
));
