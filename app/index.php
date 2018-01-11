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
  array('name' => 'APP1', 'name_partner' => 'Partner 1', 'value' => 12.03 ,'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP2', 'name_partner' => 'Partner 2', 'value' => 15.50 ,'star_on' => 4, 'star_off' => 1, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'APP3', 'name_partner' => 'Partner 2', 'value' => 15.50 ,'star_on' => 0, 'star_off' => 0, 'image' => '../images/items/westeros_m.jpg' )
);
// test themes // Perform db query to obtain this information
$themes = array(
  array('name' => 'THEME1', 'name_partner' => 'Partner 4', 'value' => 12.03 ,'star_on' => 3, 'star_off' => 2, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME2', 'name_partner' => 'Partner 5', 'value' => 15.50 ,'star_on' => 0, 'star_off' => 5, 'image' => '../images/items/westeros_m.jpg' ),
  array('name' => 'THEME3', 'name_partner' => 'Partner 6', 'value' => 15.50 ,'star_on' => 5, 'star_off' => 0, 'image' => '../images/items/westeros_m.jpg' )
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
    $word_reputation = 'Reputação do Desenvolvedor';
    $word_language = 'Selecionar Idioma';
    $word_search_apps_themes = 'Buscar por Apps ou Temas ...';
    $word_buy_apps = 'Compre Apps facilmente';
    $description_buy_apps = '********';
    $word_secure_transation = 'Transação Segura';
    $description_secure_transation = 'xxxxxxxxxxx';
    $word_apps_control = 'Controle de APPS e Temas';
    $description_apps_control = '- - - - - ';
    $word_mkp_quality = 'Marketplace de Qualidade';
    $description_mkp_quality = '_ _ _ _ _ ';
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
    $word_reputation = 'Reputation of the Developer';
    $word_language = 'Select Language';
    $word_search_apps_themes = 'Search For apps or themes ...';
    $word_buy_apps = 'Buy Apps Easily';
    $description_buy_apps = '********';
    $word_secure_transation = 'Secure Transaction';
    $description_secure_transation = 'xxxxxxxxxxx';
    $word_apps_control = 'APPS and Themes Control';
    $description_apps_control = '- - - - - ';
    $word_mkp_quality = 'Quality Marketplace';
    $description_mkp_quality = '_ _ _ _ _ ';
    break;
}
// array dicionary
$dicionary = array(
  'title' => $title,
  'subtitle' => $subtitle,
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
  'word_login' => 'Login ',
  'word_register' => $word_register,
  'word_search'=> $word_search,
  'word_go_item' => $word_go_item,
  'word_favorate' => $word_favorate,
  'desc_promo_partners' => $desc_promo_partners,
  'desc_promo_store' => $desc_promo_store,
  'word_start' => $word_start,
  'word_now' => $word_now,
  'buy_now' => $buy_now,
  'word_buying' => $word_buying,
  'apps_trends' => $apps_trends,
  'themes_trends' => $themes_trends,
  'word_reputation' => $word_reputation,
  'word_language' => $word_language,
  'word_search_apps_themes' => $word_search_apps_themes,
  'word_buy_apps' => $word_buy_apps,
  'description_buy_apps' => $description_buy_apps,
  'word_secure_transation' => $word_secure_transation,
  'description_secure_transation' => $description_secure_transation,
  'word_apps_control' => $word_apps_control,
  'description_apps_control' => $description_apps_control,
  'description_mkp_quality' => $description_mkp_quality,
  'word_mkp_quality' => $word_mkp_quality
);
// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('index.twig', array(
  'dicionary' => $dicionary,
  'login' => $login,
  'implemented' => false,
    // test itens
  'all_category' => $all_category,
  'apps' => $apps,
  'themes' => $themes
));
