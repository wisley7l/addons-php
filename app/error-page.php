<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('error-page.twig', array(
  'dictionary' => $dictionary,
));
