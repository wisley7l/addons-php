<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
// if login is true redirect index
//TODO: seccion
// TODO: treat login
// TODO: get the user name to treat the view

if (!empty($_POST['email'])) {
  $email = $_POST['email'];
  $id_partner = (int) getUserAPI($email);
  // echo PHP_EOL;
  // echo $id_partner;
  // echo PHP_EOL;
  // echo $email;
}else {
  # error redirect index
  header("Location: /index#registererror");
  exit;
}

$user = array(
  //'id' => $id_partner,
  'id' => 1,// test
  'name' => 'USER',
  'username' => $email
);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('password-create.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
  'info_footer' => $info_footer,
    // test itens
  'user' => $user,
));
