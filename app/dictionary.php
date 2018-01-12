<?php
function get_dictionary()
{
  $title = Addons\MKTP_TITLE;
  $subtitle = Addons\MKTP_SUBTITLE;
  // obs: treat language
  switch ($_SERVER['PATH_LANG']) {
    case 'pt_br':
      $welcome = 'Bem vindo a ';
      $Word_partner = 'Parceiros ';
      $word_stores = 'Lojas ';
      $word_app = 'Apps ';
      $word_theme = 'Temas ';
      $word_and = 'e ';
      $description_mkp = 'é o melhor marketplace de apps e temas para e-commerce, criado para possibilitar que lojistas que não tem grande capacidade de investimento tenham acesso a um layout personalizado de qualidade pelo melhor preço. ';
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
      $word_community = 'Community';
      $description_community = 'Confira a avaliação de outros lojistas sobre os apps ou temas comprados. ';
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
      $description_mkp = 'is the best e-commerce theme and app marketplace designed to enable retailers who do not have large investment capacity to access a customized quality layout at the best price. ';
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
      $word_community = 'Community ';
      $description_community = 'Check the evaluation of other shopkeepers about the products purchased ';
      $word_mkp_quality = 'Quality Marketplace';
      $description_mkp_quality = '_ _ _ _ _ ';
      break;
  }
  // array dictionary
  $dictionary = array(
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
    'word_community' => $word_community,
    'description_community' => $description_community,
    'description_mkp_quality' => $description_mkp_quality,
    'word_mkp_quality' => $word_mkp_quality
  );
  return $dictionary;
}
