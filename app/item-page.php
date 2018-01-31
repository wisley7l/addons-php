<?php
if (isset($_GET['id']) AND isset($_GET['app'])){
  echo $_GET['id'];
  echo PHP_EOL;
  echo $_GET['app'];
}
else {
  echo "error";
}




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
