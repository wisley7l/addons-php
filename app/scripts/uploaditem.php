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
/*
// create connection to the database
$conn = mysqli_connect(Addon\MYSQL_HOST, Addon\MYSQL_USER, Addons\MYSQL_PASS, Addon\MYSQL_DB);
// check connection
if (mysqli_connect_errno()) {
  echo 'Connection failed: ';
  echo mysqli_connect_error();
  echo PHP_EOL;
  exit();
}
*/
//header('Content-Type: text/html; charset=utf-8');
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
if ($login == false) { // if not connected
  header("Location: ../?EROORLOGIN");
  exit;
}
// var_dump($_POST);
// get id_partner
$id_partner = $_SESSION['user_id'];

if(empty($_POST)) { // not exist post
  echo "error post";
  // header("Location: ../");
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
   //var_dump($_POST);

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
     var_dump($categories);
   }else { // print error, if does not satisfy condition of categories
     // redirect dashboard-uploaditem?error=category
     echo "erro category";
   }

   // treat if it's app or theme
   if ($is_app == 1) { // if app

     // treat authentication and type app
     if (($authentication != 0 AND $authentication != 1)
      OR ($type_app < 0 OR $type_app > 4)) {
       // print error authentication or type app
       // redirect dashboard-uploaditem?error=authetication
       echo "error authetication or type app";
     }
     echo $authetication;
     // make sure it is module_package
     if ($type_app == 3 ) { // is module_package
       // valid (type_module)
       if (!in_array($module_type,$type_module)) {
         // print erro module_type
         // redirect dashboard-uploaditem?error=module_type
         echo "erro module_type";
       }
       echo $module_type;
     }else {
       $module_type = NULL;
     }

     // create query TODO:
     // verify sessin, get id and save id in id_partner

     /* $query =  "INSERT INTO `apps` (`title`, `partner_id`, `description`,`version`, `type`,`module`,
        `script_uri`,`github_repository`,`authentication`, `website`, `link_video` )
        VALUES ($name,$id_partner,$description,$numversion,$type_app,$module_type,$scripturl,$github,$authentication,$website,$linkvideo)";
     */
     /*

     // query search app and theme for index page


    if (!mysqli_query($conn, $query)) {
    // error INSERT // redirect
    }
     // $id_app = mysqli_insert_id($conn);

     */
     $query = "";
     for ($i=0; $i < $num_category ; $i++) {
       $item = (int) $categories[$i];
       $query .= "INSERT INTO `relationship_category_apps` (`app_id`, `category_apps_id`) VALUES ($id_app , $item);";
     }
     if (mysqli_multi_query($conn, $query)) {
       // redirect with sucess
       echo 'MySQL app inserted';
       echo PHP_EOL;
       echo 'All done successfully, saying goodbye...';
       echo PHP_EOL;
     } else {
       //redirect with failed
       echo 'Failed to insert app';
       echo PHP_EOL;
       handle_msyql_error($conn);
     }

   }else if ($is_app == 0) { // if theme
     echo  "<script>alert('Email enviado com Sucesso!);</script>";
     // create query TODO:
     // verify sessin, get id and save id in id_partner

     /* $query =  "INSERT INTO `themes` (`title`, `partner_id`, `description`,`version`, `link_documentation`, `link_video` )
        VALUES ($name, $id_partner, $description, $numversion, $linkdoc, $linkvideo)";
     */
     /*

     // query search app and theme for index page


    if (!mysqli_query($conn, $query)) {
    // error INSERT // redirect
    }
     // $id_app = mysqli_insert_id($conn);

     */
     $query = "";
     for ($i=0; $i < $num_category ; $i++) {
       $item = (int) $categories[$i];
       $query .= "INSERT INTO `relationship_category_themes` (`app_id`, `category_themes_id`) VALUES ($id_app , $item);";
     }
     if (mysqli_multi_query($conn, $query)) {
       // redirect with sucess
       echo 'MySQL theme inserted';
       echo PHP_EOL;
       echo 'All done successfully, saying goodbye...';
       echo PHP_EOL;
     } else {
       //redirect with failed
       echo 'Failed to insert theme';
       echo PHP_EOL;
       handle_msyql_error($conn);
     }

   }else {
     // redirect dashboard-uploaditem?error=is_app
   }

}else {
  // redirect with error
  echo "erro2";
}
