<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$login = false;
// if login is true redirect index
//TODO: seccion
// TODO: treat login
// TODO: get the user name to treat the view

if (!empty($_GET['id']) AND !empty($_GET['user'])) {
  $id = (int)$_GET['id'];
  $email = $_GET['user'];
  echo PHP_EOL;
  echo $id;
  echo PHP_EOL;
  echo $email;
}else {
  # error redirect index
  header("Location: /index#ErrorRegister");
  exit;
}

$user = array(
  'id' => $id,
  'name' => '',
  'username' => $email
);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('password-create.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
    // test itens
  'user' => $user,
));
