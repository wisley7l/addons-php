<?php
require '../composer/vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
// TODO: parse twig template
$title = Addons\MKTP_TITLE;
$subtitle = Addons\MKTP_SUBTITLE;
// variable to check user login
$login = false;
$page = array(
        'title' => $title,
        'subtitle' => $subtitle,
        'login'=> $login
      );
// intial twig
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP.'/views');
$twig = new Twig_Environment($loader);
echo $twig->render('index.html',$page);
