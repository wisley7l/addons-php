<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$name_item; // variable save term search
// test all category  // Perform db query to obtain this information
$app_category = get_categories_app();
$theme_category = get_categories_theme();

//(init) * Required on all pages *
// close writing session, if it exists and intal session
session_write_close();
session_start();
// if the session exists
if (isset($_SESSION)) {
  //modify the value of the login variable, by the value saved in the session
  //var_dump($_SESSION);
  // set values for user, with the values saved in the session
  // array used to set user panel parameters
  $user_login = getUserLogin($dictionary);
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  header("Location: index");
  exit;
}
// varible select filter
$filter = array('all' => 'selected',
 'free' => '');
// filter categories and price
if ($_GET['filter'] == 'free') {
  $filter['all'] = '';
  $filter['free'] = 'selected';
  $_filter = '&filter=free';
}elseif ($_GET['filter'] == 'all') {
  $_filter = '&filter=all';
} else{
  $_filter = '';
}

if (!empty($_GET['category'])) {
  $category = '&category=' . $_GET['category'];
}else {
  $category = '';
}

$page = 'apps-page?type=' . $_GET['type'] . $category;

// redirect search page
if (!empty($_GET['term'])) {

}
// treat querys
$id_category = 0;

if ($_GET['type'] == 'apps') {
  $title_page = $dictionary['word_apps_store'];
  $_category = $app_category;

  if (!empty($_GET['category'])) {
    $id_category = (int) $_GET['category'];
    $title_page = $app_category[$id_category]['name'];
    // search item by caategory and free
    if ($_GET['filter'] == 'free') {
      if (!empty($_GET['name'])) {
        // search item by category and freee and name
        $name_item = $_GET['name'];
        $apps = search_apps_free_name_category(12,$name_item,$id_category);
        $number_found = count($apps);
      }else {
          // search item by category and free
          $apps = search_apps_free_category(12,$id_category);
          $number_found = count($apps);
      }
    }elseif (isset($_GET['filter']) OR !empty($_GET['filter']) OR  $_GET['filter'] == 'all') {
      if (!empty($_GET['name'])) {
        // search item by category and name
        $name_item = $_GET['name'];
        $apps = search_apps_name_category(12,$name_item,$id_category);
        $number_found = count($apps);
      }else {
        // search item by category all
        $apps = search_apps_category(12,$id_category);
        $number_found = count($apps);
      }
    }
    else {
      // search item by category all
      $apps = search_apps_category(12,$id_category);
      $number_found = count($apps);
    }
  }else {
    if ($_GET['filter'] == 'free' OR empty($_GET['filter']) ) {
      echo 'teste' ;
      if (!empty($_GET['name'])) {
        // search item  and freee and name
        $apps = search_apps_free_name(12,$search);
        $number_found = count($apps);
      }else {
          // search item and free
          $apps = search_all_apps_free(12);
          $number_found = count($apps);
      }
    }elseif (!empty($_GET['filter']) OR  $_GET['filter'] == 'all') {
      if (!empty($_GET['name'])) {
        // search item and name
        $apps = search_apps_all_name($limit,$search);
        $number_found = count($apps);
      }else {
        // search item  all
        $apps = search_all_apps(12);
        $number_found = count($apps);
      }
    }else {
      echo "error";
      // search item  all
      $apps = search_all_apps(12);
      $number_found = count($apps);
    }
  }


}elseif ($_GET['type'] == 'themes') {
  $title_page = $dictionary['word_themes_store'];
  $_category = $theme_category;
  if (!empty($_GET['category'])) {
    $id_category = (int) $_GET['category'];
    $title_page = $theme_category[$id_category]['name'];
    // search item by caategory and free
    if ($_GET['filter'] == 'free') {
      if (!empty($_GET['name'])) {
        // search item by category and freee and name
        $name_item = $_GET['name'];
        $apps = search_themes_free_name_category(12,$name_item,$id_category);
        $number_found = count($apps);
      }else {
          // search item by category and free
          $apps = search_themes_free_category(12,$id_category);
          $number_found = count($apps);
      }
    }elseif (isset($_GET['filter']) OR !empty($_GET['filter']) OR  $_GET['filter'] == 'all') {
      if (!empty($_GET['name'])) {
        // search item by category and name
        $name_item = $_GET['name'];
        $apps = search_themes_name_category(12,$name_item,$id_category);
        $number_found = count($apps);
      }else {
        // search item by category all
        $apps = search_themes_category(12,$id_category);
        $number_found = count($apps);
      }
    }
    else {
      // search item by category all
      $apps = search_themes_category(12,$id_category);
      $number_found = count($apps);
    }
  }else {
    if ($_GET['filter'] == 'free') {
      if (!empty($_GET['name'])) {
        // search item  and freee and name
        $apps = search_themes_free_name(12,$search);
        $number_found = count($apps);
      }else {
          // search item and free
          $apps = search_all_themes_free(12);
          $number_found = count($apps);
      }
    }elseif (!empty($_GET['filter']) OR  $_GET['filter'] == 'all') {
      if (!empty($_GET['name'])) {
        // search item and name
        $apps = search_themes_all_name($limit,$search);
        $number_found = count($apps);
      }else {
        // search item  all
        $apps = search_all_themes(12);
        $number_found = count($apps);
      }
    }else {
      // search item  all
      $apps = search_all_themes(12);
      $number_found = count($apps);
    }
  }

}




//(end) * Required on all pages *

// obs: query db for informations
$total_apps_and_themes = 0;
$count_partners = 0;
$info_footer = array(
  'total_apps_and_themes' => $total_apps_and_themes,
  'count_partners' => $count_partners,
  'path_file' => $_SERVER['PATH_FILE']
);

// obs: Search all categories in db

//info search
$info_page = array(
  'name' => $title_page . $name_item,
  'search_id' => $id_category, // sected category
  'number_found' => $number_found,
  'page' => $page,
  'search' => $name_item,
);

// obs: Search all categories in db


// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('apps-themes-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
  'filter' => $filter,
  'all_category' => $_category,
  // test apps
  'apps_themes' => $apps,
  'user' => $user_login
));
