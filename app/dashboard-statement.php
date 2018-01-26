<?php
// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('dashboard-settings.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'implemented' => false,
    // test
  'user' => $user_login,
));
