<?php
header('Content-Type: text/html; charset=utf-8');

// TODO: parse twig template
$title = Addons\MKTP_TITLE;
$subtitle = Addons\MKTP_SUBTITLE;
// variable to check user login
$login = false;
// necessary variables for information
// number of partners and stores, and total apps and themes
// obs: query db for informations
$total_apps_and_themes = 0;
$count_stores = 0;
$count_partners = 0;
// obs: Search all categories in db
// test all category
$all_category = array(
  'All Category',
  'c1',
  'c2',
  'c3',
  'c4'
);
// obs: treat language
switch ($_SERVER['PATH_LANG']) {
  case 'pt_br':
    $welcome = 'Bem vindo a ';
    $Word_partner = 'Parceiros ';
    $word_stores = 'Lojas ';
    $word_app = 'Apps ';
    $word_theme = 'Temas ';
    $word_and = 'e ';
    $description_mkp = 'é o melhor marketplace de apps e temas para ecommerce ';
    $word_register = 'Registar-se ';

    break;

  default:
    $welcome = 'Welcome to ';
    $Word_partner = 'Partners ';
    $word_stores = 'Stores ';
    $word_app = 'Apps ';
    $word_theme = 'Themes ';
    $word_and = 'and ';
    $description_mkp = 'is the best app marketplace and themes for ecommerce ';
    $word_register = 'Register ';
    break;
}

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('index.twig', array(
  'title' => $title,
  'subtitle' => $subtitle,
  'login' => $login,
  'welcome' => $welcome,
  'e_com' => 'E-Com Plus ',
  'addons' => 'Adonns ',
  'word_partner' => $Word_partner,
  'word_stores' => $word_stores,
  'word_app' => $word_app,
  'word_theme' => $word_theme,
  'word_and' => $word_and,
  'description_mkp' => $description_mkp,
  'total_apps_and_themes' => $total_apps_and_themes,
  'count_stores' => $count_stores,
  'count_partners' => $count_partners,
  'all_category' => $all_category,
  'word_login' => 'Login ',
  'implemented' => false
));
