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

if(empty($_POST)) { // not exist post
  echo "error post";
  // header("Location: ../");
} else if (!empty($_POST['is_app']) AND
    ((int) $_POST['is_app'] == 0 OR (int) $_POST['is_app'] == 1) ) {
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
       if (!in_array($type_module, $module_type)) {
         // print erro module_type
         // redirect dashboard-uploaditem?error=module_type
         echo "erro module_type";
       }
       echo $module_type;
     }


   }else if ($is_app = 0) { // if theme

   }else {
     // redirect dashboard-uploaditem?error=is_app
   }



}else {
  echo "erro2";
}


//   INSERT INTO `category_themes` (`name`) VALUES ("art_photography");
//apps
//themes
//relationship_category_apps
//relationship_category_themes

/*
 is_app == 1 create app, == 0 create theme
 name // name
 numversion // app and theme
 description // app and theme
 scripturl // app
 github // app
 website // app
 linkvideo // app and theme
 linkdoc // theme
 */
