<?php
echo "page create password";
if (!empty($_GET['id'])) {
  $id = (int)$_GET['id'];
  echo PHP_EOL;
  echo "$id";
}else {
  # error redirect index
  header("Location: index");
  exit;
}
// TODO: treat login 

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('password-create.twig', array(
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
