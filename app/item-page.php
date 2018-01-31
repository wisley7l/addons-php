<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$login = false;

if (isset($_GET['id']) AND isset($_GET['app'])){
  echo $_GET['id'];
  echo PHP_EOL;
  echo $_GET['app'];
}
else {
  echo "error";
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

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('item-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'segment' => $filter_segment,
  'all_category' => $all_category,
  'filter' => $filter,
  // test apps
  'apps_themes' => $apps,
  'user' => $user_login,
  'search_id' => $id_category
));
