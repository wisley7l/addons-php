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
// test all category  // Perform db query to obtain this information
$all_category = array(
  'All Category',
  'c1',
  'c2',
  'c3',
  'c4'
);
// test apps  // Perform db query to obtain this information
$apps = array(
  array('name' => 'APP1', 'name_partner' => 'Partner 1', 'value' => 12.03 ,'star_on' => 3, 'star_off' => 2 ),
  array('name' => 'APP2', 'name_partner' => 'Partner 2', 'value' => 15.50 ,'star_on' => 4, 'star_off' => 1 ),
  array('name' => 'APP3', 'name_partner' => 'Partner 2', 'value' => 15.50 ,'star_on' => 4, 'star_off' => 1 )
);
// test themes // Perform db query to obtain this information
$themes = array(
  array('name' => 'THEME1', 'name_partner' => 'Partner 4', 'value' => 12.03 ,'star_on' => 3, 'star_off' => 2 ),
  array('name' => 'THEME2', 'name_partner' => 'Partner 5', 'value' => 15.50 ,'star_on' => 2, 'star_off' => 3 ),
  array('name' => 'THEME3', 'name_partner' => 'Partner 6', 'value' => 15.50 ,'star_on' => 5, 'star_off' => 0 )
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
    $word_search = 'Buscar ';
    $word_go_item = 'Ir até item';
    $word_favorate = 'Add Favourito';
    $desc_promo_partners = 'Divulgue sua APP ou tema aqui com ';
    $desc_promo_store = 'Encontre os melhores apps e tema para sua ecommerce ';
    $word_start = 'Começar ';
    $word_now = 'Agora ';
    $buy_now = 'Comprar Agora ';
    $word_buying = 'Comprar ';
    $apps_trends = 'Tendências de Apps ';
    $themes_trends = 'Tendências de Temas ';
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
    $word_search = 'Search ';
    $word_go_item = 'Go to item';
    $word_favorate = 'Favourites +';
    $desc_promo_partners = 'Advertise your APP or theme here with ';
    $desc_promo_store = 'Find the best apps and theme for your ecommerce ';
    $word_start = 'Start ';
    $word_now = 'Now ';
    $buy_now = 'Buy Now ';
    $word_buying = 'Buying ';
    $apps_trends = 'Apps Trends ';
    $themes_trends = 'Themes Trends ';
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
  'word_register' => $word_register,
  'implemented' => false,
  'word_search'=> $word_search,
  'word_go_item' => $word_go_item,
  'word_favorate' => $word_favorate,
  'desc_promo_partners' => $desc_promo_partners,
  'desc_promo_store' => $desc_promo_store,
  'word_start' => $word_start,
  'word_now' => $word_now,
  'buy_now' => $buy_now,
  'apps_trends' => $apps_trends,
  'themes_trends' => $themes_trends,
  // test itens
  'apps' => $apps,
  'themes' => $themes
));
