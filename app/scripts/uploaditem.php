<?php
// type app
$app_type = array(
  array('id' => 1 ,' name' =>  'dashboard'),
  array('id' => 2 ,' name' =>  'storefront '),
  array('id' => 3 ,' name' =>  'module_package'),
  array('id' => 4 ,' name' =>  'external')
);
// module type
$type_module = array(
  'al','pd','sc','sh', 'pa', 'ck', 'cf', 'rg', 'lg', 'ct', 'nw'
);
//*
// create connection to the database
$conn = mysqli_connect(Addons\MYSQL_HOST, Addons\MYSQL_USER, Addons\MYSQL_PASS, Addons\MYSQL_DB);
// check connection
if (mysqli_connect_errno()) {
  echo 'Connection failed: ';
  echo mysqli_connect_error();
  echo PHP_EOL;
  exit();
}else {
  //echo "CONNECTION OK!";
}
//*/
////header('Content-Type: text/html; charset=utf-8');
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
if ($_SESSION['login'] == false) { // if not connected
  //header("Location: ../#ERRORLOGIN");
  exit;
}
// var_dump($_POST);
// get id_partner
$id_partner = $_SESSION['user_id'];

if(empty($_POST)) { // not exist post
  //echo "error post";
  //header("Location: ../dashboard-uploaditem#ERRORSend");
  exit;
} else if ((int) $_POST['is_app'] == 0 OR (int) $_POST['is_app'] == 1)  {
  // obs: capture id partner
  $is_app  = (int) $_POST['is_app'];
  $name = $_POST['name']; // not null
  $categories = $_POST['categories_json'];
  $numversion = $_POST['numversion'];
  $description = $_POST['description'];
  $scripturl = $_POST['scripturl'];
  $github = $_POST['github'];
  $website = $_POST['website'];
  $linkvideo = $_POST['linkvideo'];
  $linkdoc  = $_POST['linkdoc']; // only theme
  $type_app = (int) $_POST['type_app']; // treat 1 a 4  // only app
  $module_type = $_POST['module_app']; // treat only type_app == 3 // only app
  $authentication = (int) $_POST['authentication']; // treat 0 or 1 // only app // if authentication != 1 or 0 error
  $category = json_decode($categories,true); // if (int) category['total'] <= 0  error
  $plans = json_decode($_POST['plans'],true); // app and theme
  $faqs = json_decode($_POST['faqs'],true); // app and theme (body_json)
  //var_dump($_POST);
  // echo $plans;
  //echo $faqs;
  // echo $categories;
  $body_json = json_encode(array('faqs' => $faqs));
  //$body_json = '';
   // treat category
   $categories = array();
   $num_category = (int) $category['total'];
   if ($num_category > 0) { // if (int) $category['total'] <= 0  error
     for ($i=0; $i < $num_category ; $i++) { // Search in arrays if id is not repeated
       $var = $category['categories'][$i]["id"];
       if (!in_array($var,$categories)) { // check if id is already in array
         array_push($categories, $var); // if not, let's add id in array
       }
     }
     // var_dump($categories);
   }else { // print error, if does not satisfy condition of categories
     // redirect dashboard-uploaditem?error=category
     //echo "erro category";
     //header("Location: ../dashboard-uploaditem#ERRORCategories");
     exit;
   }

   // treat if it's app or theme
   if ($is_app == 1) { // if app

     // treat authentication and type app
     if (($authentication != 0 AND $authentication != 1)
      OR ($type_app < 0 OR $type_app > 4)) {
       // print error authentication or type app
       // redirect dashboard-uploaditem?error=authetication
       echo "error authetication or type app";
       //header("Location: ../dashboard-uploaditem#ERRORAuthORType");
       exit;
     }
     // echo $authetication;
     // make sure it is module_package
     if ($type_app == 3 ) { // is module_package
       // valid (type_module)
       if (!in_array($module_type,$type_module)) {
         // print erro module_type
         // redirect dashboard-uploaditem?error=module_type
         //echo "erro module_type";
         //header("Location: ../dashboard-uploaditem#ERRORModule");
         exit;
       }
       // echo $module_type;
     }else {
       $module_type = NULL;
     }

     // treat plans
     $plan_basic = $plans['plans'][0]['value'];

     for ($i=0; $i < (int) $plans['total_plans'] ; $i++) {
       if ($plan_basic > $plans['plans'][$i]['value']) {
         $plan_basic = $plans['plans'][$i]['value'];
       }
       // echo PHP_EOL;
       // echo  $plans['plans'][$i]['value'];
     }
     //$plans_json = mysqli_real_escape_string($conn,json_encode($plans));
     $plans_json = json_encode($plans);
     // convert float to string and after convert string to int
     $plan_basic = (int) number_format($plan_basic, 2, '', '');


     // create query TODO:
     // verify sessin, get id and save id in id_partner
     /*
     `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
     `partner_id` SMALLINT UNSIGNED NOT NULL,
     `title` VARCHAR(70) NOT NULL DEFAULT '',
     `slug` VARCHAR(70) NOT NULL DEFAULT '',
     `thumbnail` VARCHAR(255) NULL,
     `description` TEXT NULL,
     `json_body` TEXT NULL,
     `paid` TINYINT NOT NULL DEFAULT 0,
     `version` VARCHAR(8) NOT NULL DEFAULT '1.0.0',
     `version_date` DATE NULL,
     `type` VARCHAR(14) NULL,
     `module` CHAR(2) NULL,
     `load_events` TEXT NULL,
     `script_uri` VARCHAR(255) NULL,
     `github_repository` VARCHAR(255),
     `authentication` TINYINT NOT NULL DEFAULT 0,
     `auth_callback_uri` VARCHAR(255),
     `auth_scope` TEXT NULL,
     `avg_stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
     `evaluations` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
     `website` VARCHAR(255) NULL,
     `link_video` VARCHAR(255) NULL,
     `plans_json` TEXT NULL,
     `value_plan_basic` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
     VALUES ($name,$id_partner,$description,$body_json,$numversion,$type_app,
     $module_type,$scripturl,$github,$authentication,$website,$linkvideo,$plans_json,$plan_basic)
     */

     //*
        $query =  "INSERT INTO `apps` (`title`, `partner_id`, `description`, `json_body`,`version`, `type`,`module`,
        `script_uri`,`github_repository`,`authentication`, `website`, `link_video`, `plans_json`, `value_plan_basic` )
        VALUES ('$name',1,'dasdas','body','dasdas','tipo',
        'mo','dasdasd','dasdas',1,'dasdas','dasdas','plan',$plan_basic);";
     //*/
     //*
     echo $name;
     echo PHP_EOL;
     echo gettype($id_partner);
     echo PHP_EOL;
     echo $description;
     echo PHP_EOL;
     echo $body_json;
     echo PHP_EOL;
     echo $numversion;
     echo PHP_EOL;
     echo $type_app;
     echo PHP_EOL;
     echo $module_type;
     echo PHP_EOL;
     echo $scripturl;
     echo PHP_EOL;
     echo $github;
     echo PHP_EOL;
     echo $authentication;
     echo PHP_EOL;
     echo $website;
     echo PHP_EOL;
     echo $linkvideo;
     echo PHP_EOL;
     echo $plans_json;
     echo PHP_EOL;
     echo $plan_basic;
     echo PHP_EOL;
     var_dump($categories);
     //*/
     //*

     // query search app and theme for index page


    if (!mysqli_query($conn, $query)) {
    // error INSERT // redirect
    echo PHP_EOL;
    echo "ERROR INSERT";
    echo PHP_EOL;
    echo mysqli_error($conn);
    }
     //$id_app = mysqli_insert_id($conn);
     //echo PHP_EOL;
     //echo $id_app;


     //*/
     /*
     $query = "";
     for ($i=0; $i < $num_category ; $i++) {
       $item = (int) $categories[$i];
       $query .= "INSERT INTO `relationship_category_apps` (`app_id`, `category_apps_id`) VALUES ($id_app , $item);";
     }
     if (mysqli_multi_query($conn, $query)) {
       // redirect with sucess
       // echo 'MySQL app inserted';
       // echo PHP_EOL;
       // echo 'All done successfully, saying goodbye...';
       // echo PHP_EOL;
       //header("Location: ../dashboard-uploaditem#SucessApp");
       // exit;
     } else {
       //redirect with failed
       // echo 'Failed to insert app';
       // echo PHP_EOL;
       // handle_msyql_error($conn);
       //header("Location: ../dashboard-uploaditem#ERRORInsertAPP");
       // exit;
     }
     */

   }else if ($is_app == 0) { // if theme
     // create query TODO:
     // verify sessin, get id and save id in id_partner
     $plan_basic = $plans['plans'][0]['value'];

     if ($plans['total_plans'] == 2) {
       $plan_extend = $plans['plans'][1]['value'];
     }

     $body_json = json_decode($body_json,true);
     $body_json['plans'] = $plans;
     $body_json = json_encode($body_json);
     // echo $body_json;

     /* $query =  "INSERT INTO `themes` (`title`, `partner_id`, `description`,
          `version`, `json_body`, `link_documentation`, `link_video`, `value_license_basic`, `value_license_extend` )
        VALUES ($name, $id_partner, $description,$body_json, $numversion,
        $linkdoc, $linkvideo,$plan_basic,$plan_extend)";
     */
     /*

     // query search app and theme for index page


    if (!mysqli_query($conn, $query)) {
    // error INSERT // redirect
    }
     // $id_app = mysqli_insert_id($conn);

     */
     /*
     $query = "";
     for ($i=0; $i < $num_category ; $i++) {
       $item = (int) $categories[$i];
       $query .= "INSERT INTO `relationship_category_themes` (`app_id`, `category_themes_id`) VALUES ($id_app , $item);";
     }
     if (mysqli_multi_query($conn, $query)) {
       // redirect with sucess
       // echo 'MySQL theme inserted';
       // echo PHP_EOL;
       // echo 'All done successfully, saying goodbye...';
       // echo PHP_EOL;
       //header("Location: ../dashboard-uploaditem#SucessTheme");
       // exit;
     } else {
       //redirect with failed
       // echo 'Failed to insert theme';
       // echo PHP_EOL;
       // handle_msyql_error($conn);l
       //header("Location: ../dashboard-uploaditem#ERRORInsert");
       // exit;
     }
     */
   }else {
     // redirect dashboard-uploaditem?error=is_app
   }

}else {
  // redirect with error
  // echo "erro2";
  //header("Location: ../dashboard-uploaditem#ERRORSend");
  // exit;
}
