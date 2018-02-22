<?php
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
} else if (!empty($_POST['is_app']) AND ((int) $_POST['is_app'] == 0 OR (int) $_POST['is_app'] == 1) ) {
  // obs: capture id partner
  $is_app  = (int) $_POST['is_app'];
  $name = $_POST['name']; // not null
  $category_json = $_POST['categories_json'];
  $numversion = $_POST['numversion'];
  $description = $_POST['description'];
  $scripturl = $_POST['scripturl'];
  $github = $_POST['github'];
  $website = $_POST['website'];
  $linkvideo = $_POST['linkvideo'];
  $linkdoc  = $_POST['linkdoc']; // only theme
  $type_app = (int) $_POST['type_app']; // treat 1 a 7  // only app
  $module_type = $_POST['module_app']; // treat only type_app == 3 // only app
  $authentication = (int) $_POST['authentication']; // treat 0 or 1 // only app // if authentication != 1 or 0 error
  $category = json_decode($category_json,true); // if (int) category['total'] <= 0  error
   //var_dump($_POST);
   // treat category
   $categories = array();
   $num_category = (int) $category['total'];
   echo $category['categories'][0]["id"];
   var_dump($category);
   if ($num_category > 0) {
     for ($i=0; $i <$num_category ; $i++) {
       $var = $category['categories'][$i]["id"];
       if (!in_array($var,$categories)) {
         array_push($categories, $var);
       }
     }
     var_dump($categories);
   }else {
     echo "erro category";
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

/*
type app
dashboard 1
string 2
storefront 3
string 4
module_package 4
string 6
external 7
string 8
*/
