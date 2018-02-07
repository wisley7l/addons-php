<?php
var_dump($_POST);

if(empty($_POST)) { // not exist post
  echo "error post";
  // header("Location: ../");
} else{
  $is_app  = (int) $_POST['is_app'];
  $name = $_POST['name'];
  $category = (int) $_POST['category'];
  $numversion = $_POST['numversion'];
  $description = $_POST['description'];
  $scripturl = $_POST['scriptul'];
  $github = $_POST['github'];
  $website = $_POST['website'];
  $linkvideo = $_POST['linkvideo'];
  $linkdoc  = $_POST['linkdoc'];
  /*
   is_app == 1 create app, == 0 create theme
   name // name
   category // relationship category and item
   numversion // app and theme
   description // app and theme
   scripturl // app
   github // app
   website // app
   linkvideo // app and theme
   linkdoc // theme
   */
   if ($is_app == 1 ) {
     echo "Create app";
     echo PHP_EOL;
     // $name
     // $category
     // $numversion
     // $description
     // $scripturl
     // $github
     // $website
     // $linkvideo


   } elseif ($is_app == 0 ) {
     echo "create theme";
     // $name
     // $category
     // $numversion
     // $description
     // $linkvideo
     // $linkdoc

   } else {
     echo "Error";
   }

}
