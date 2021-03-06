<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
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
  // obs. check redirection on all pages
  header("Location: index");
  exit;
}
//(end) * Required on all pages *

if (isset($_GET['id']) AND isset($_GET['app'])){
  if ( $_GET['app'] == 1) {
    $app = 1;
    //search item in app
    $id_app = (int) $_GET['id'];
    $item = search_app_id($id_app);
    $_plans = json_decode($item['plans_json'],true);
    // var_dump($item);
    // var_dump($_plans);

    $app_info = array('id' => $id_app,
      'name' => $item['title'],
      'description' => $item['description'] ,
      'video' => $item['link_video'],
      'website' => $item['website'],
    );
    $plans = $_plans['plans'];
    $plans[0]['checked'] = 'checked';
    $plans[0]['desc'] = $plans[0]['desc'];

    for ($i=1; $i < $_plans['total_plans'] ; $i++) {
      $plans[$i]['checked'] = '';
      $plans[$i]['desc'] = $plans[$i]['desc'];
    }

    $json = json_decode($item['json_body'],true);
    $faqs = $json['faqs']['faqs'];

    //images app
    $array_images = getImagesApp($id_app);
    $image_main = $array_images[0];

  }
  else if ($_GET['app'] == 0){
    $id_app = (int) $_GET['id'];
    $app = 0;
    //search item in themes
    $item = search_theme_id($id_app);
    // var_dump($item);

    $app_info = array('id' => $id_app,
      'name' => $item['title'],
      'description' => $item['description'],
      'video' => $item['link_video'],
      'website' => $item['link_docomentation'],
    );

    $faqs = array();
    $json = json_decode($item['json_body'],true);

    $faqs = $json['faqs']['faqs'];
    $_templates = $json['templates'];
    $array_images = $_templates['templates'];
    $image_main = $array_images[0];

    $plans = array();

      $planBasic = array('id' => 1,
        'name' => 'Basic',
        'value' => treatNumber($item['value_license_basic']),
        'desc' => $json['plans']['plans'][0]['desc'],
        'checked' => 'checked',
      );
      array_push($plans, $planBasic);

      if ($item['value_license_extend'] != 0) {
        $planExtend = array('id' => 2,
          'name' => 'Extend',
          'value' => treatNumber($item['value_license_extend']),
          'desc' => $json['plans']['plans'][1]['desc'],
          'checked' => '',
        );
        array_push($plans, $planExtend);
      }

  }
  else {
    // redirect page error or information error
    echo "error";
  }

  //images theme (not implemted)
  //$array_images = getImagesTheme();
  //$image_main = $array_images[0];
}
else {
  // redirect page error
  header("Location: error-page");
  exit;
}

// exists diference page app and page theme
$info_page = array('app' => $app,
);

// TODO: delete
// $faqs = array();
// $i_faqs = array('id' => 1,
//   'question' => 'pergunta',
//   'answer' => 'Aqui sera a resposta das perguntas'
//  );
//  array_push($faqs, $i_faqs);


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

//*
// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('item-page.twig', array(
  'dictionary' => $dictionary,
  'login' => $_SESSION['login'],
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
  'faqs' => $faqs,
));
//*/
