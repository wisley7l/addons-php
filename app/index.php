<?php
header('Content-Type: text/html; charset=utf-8');

// TODO: parse twig template
$title = Addons\MKTP_TITLE;
$subtitle = Addons\MKTP_SUBTITLE;
// variable to check user login
$login = false;
// obs: tratar idioma
$welcome = 'Bem vindo a';

// intial twig
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('index.twig', array(
  'title' => $title,
  'subtitle' => $subtitle,
  'login' => $login,
  'welcome' => $welcome,
  'e_com' => 'E-Com Plus',
  'addons' => 'Adonns'
));
