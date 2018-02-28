<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$login = false;
//(init) * Required on all pages *
// close writing session, if it exists and intal session
session_write_close();
session_start();
// if the session exists
if (isset($_SESSION)) {
  //modify the value of the login variable, by the value saved in the session
  //var_dump($_SESSION);
  $login = $_SESSION['login'];
  // set values for user, with the values saved in the session
  // array used to set user panel parameters
  $user_login = getUserLogin($dictionary);
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
}
//(end) * Required on all pages *


if (isset($_GET['id']) AND isset($_GET['app'])){
  if ( $_GET['app'] == 1) {
    $app = 1;
    //search item in app
    $id_app = (int) $_GET['id'];

    $app_info = array('id' => $id_app,
      'name' => 'APP',
      'description' => '' ,
      'video' => 'https://www.youtube.com/embed/tgbNymZ7vqY"',
      'website' => 'https://apps.shopify.com/',
    );

    //images app
    //$array_images = getImagesApp();
    //$image_main = $array_images[0];
  }
  else if ($_GET['app'] == 0){
    $id_app = (int) $_GET['id'];
    $app = 0;
    //search item in themes
    $app_info = array('id' => $id_app,
      'name' => 'THEME',
      'description' => 'Esta é a Descrição do APP ou do TEMA',
      'video' => 'https://www.youtube.com/watch?v=zTBXfWf1Eew',
      'website' => 'https://themes.shopify.com/',
    );
  }
  else {
    // redirect page error or information error
    echo "error";
  }

  //images theme
  //$array_images = getImagesTheme();
  //$image_main = $array_images[0];
}
elseif (isset($_GET['term']) and isset($_GET['x']) ) {
  header("Location: search-page?term=" . $_GET['term']);
  exit;
}
else {
  // redirect page error
  header("Location: error-page");
  exit;
}

$info_page = array('app' => $app,
);

$plan1 = array('id' => 'licence-regular',
  'name' => 'License Regular',
  'price' => 16.00 ,
  'description' => 'Test description 1',
  'checked' => 'checked',
);

$plan2 = array('id' => 'extend-license',
  'name' => 'Extend License',
  'price' => 36.00,
  'description' => 'Test description 2',
  'checked' => '',
);
$plans = array();
array_push($plans, $plan1);
array_push($plans, $plan2);


//var_dump($array_images[0]);

// necessary variables for information
// number of partners and stores, and total apps and themes
// obs: query db for information or configure as static (avoid excessive queries)
$total_apps_and_themes = 0; // not implemented in the first moment
$count_partners = 0; // not implemented in the first moment
$info_footer = array(
  'total_apps_and_themes' => $total_apps_and_themes,
  'count_partners' => $count_partners,
  'path_file' => $_SERVER['PATH_FILE'] . '?id=' . $_GET['id'] . '&app=' . $_GET['app']
);

// obs: Search all categories in db
// test all category  // Perform db query to obtain this information
$app_category = get_categories_app();
$theme_category = get_categories_theme();


// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('item-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
  'info_page' => $info_page,
  'plans' => $plans,
  'app_category' => $app_category,
  'theme_category' => $theme_category,
  // test apps
  'user' => $user_login,
  'app_info' => $app_info,
  'array_images' => $array_images,
  'image_main' => $image_main,

));
