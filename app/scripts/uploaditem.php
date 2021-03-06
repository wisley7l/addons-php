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
$conn = connect_db();
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
$id_partner = (int) $_SESSION['user_id'];

if(empty($_POST)) { // not exist post
  //echo "error post";
  //header("Location: ../dashboard-uploaditem#ERRORSend");
  exit;
} else if ((int) $_POST['is_app'] == 0 OR (int) $_POST['is_app'] == 1)  {
  // obs: capture id partner
  $is_app  = (int) $_POST['is_app'];
  $name =  limit_str($_POST['name'],70); // not null
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
  $slug = uniqid(NULL, true) . uniqid(NULL, true);
  //var_dump($_POST);
  // echo $plans;
  //echo $faqs;
  // echo $categories;
  $body_json = json_encode(array('faqs' => $faqs),JSON_UNESCAPED_UNICODE);
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
       $active = 0;
       // TODO::
       //SEND EMAIL
       if (!in_array($module_type,$type_module)) {
         // print erro module_type
         // redirect dashboard-uploaditem?error=module_type
         //echo "erro module_type";
         header("Location: ../dashboard-uploaditem#ERRORModule");
         exit;
       }
       // echo $module_type;
     }else {
       $module_type = NULL;
       $active = 1;
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
     $plans_json = json_encode($plans,JSON_UNESCAPED_UNICODE);
     // echo $plans_json;
     // convert float to string and after convert string to int
     $plan_basic = (int) number_format($plan_basic, 2, '', '');


     // create query TODO:
     // verify sessin, get id and save id in id_partner
     /*
     */

     $dist_img = Addons\PATH_DATA . '/images/apps/';
     $dist_zip = Addons\PATH_DATA . '/module/';
     $img = array();

     for ($i=1; $i <=6 ; $i++) {
       $tem_img = send_file($_FILES,'img'. $i,1,$dist_img);
       array_push($img, $tem_img);
     }
     $thumbnail = send_file($_FILES,'img0',1,$dist_img);
     $zip = send_file($_FILES,'tem1',0,$dist_zip);
     // add zip in the  body_json if exists
     if ($module_type == '') {
       $module_type = NULL;
     }
     else {
       $module_type = "$module_type";
       $body_json = json_decode($body_json,true);
       $body_json['zip'] = $zip;
       $body_json = json_encode($body_json,JSON_UNESCAPED_UNICODE);
       if ($zip == -1 || $zip == -2 || $zip == -3) {
         // error save
         echo 'error ZIP:' . $zip;
         exit();
       }

     }


     // /*
     $query =  "INSERT INTO `apps` (`title`, `slug`,`thumbnail`,`partner_id`, `description`, `json_body`,`version`, `type`,`module`,
     `script_uri`,`github_repository`,`authentication`, `website`, `link_video`, `plans_json`, `value_plan_basic`, `active` )
     VALUES ('$name','$slug','$thumbnail',$id_partner,'$description','$body_json','$numversion','$type_app','$module_type',
       '$scripturl','$github',$authentication,'$website','$linkvideo','$plans_json',$plan_basic,$active);";
       // TODO:
       // thumbnail in insert

     //*
     // query search app and theme for index page
    if (!mysqli_query($conn, $query)) {
    // error INSERT // redirect
    header("Location: ../dashboard-uploaditem#ERRORInsertApp");
    exit();
    }
     $id_app = (int) mysqli_insert_id($conn);
     //*/

     //echo PHP_EOL;
     //echo $id_app;

     // /*
     $query = "";
     for ($i=0; $i < 6 ; $i++) {
       if ($img[$i] != -1) {
         echo PHP_EOL;
         $with = getimagesize($img[$i])[0];
         $height = getimagesize($img[$i])[1];
         echo "$with,$height";
         $query .= "INSERT INTO image_apps (app_id,path_image,width_px,height_px) VALUES($id_app,'$img[$i]',$with,$height);";

       }
     }

     if (!mysqli_multi_query($conn, $query)) {
     // error INSERT // redirect
     echo PHP_EOL;
     echo "ERROR INSERT";
     echo PHP_EOL;
     echo mysqli_error($conn);
     }
     //*/
     mysqli_close($conn);
     $conn = connect_db();

     // /*
     $query = "";
     for ($i=0; $i < $num_category ; $i++) {
       $item = (int) $categories[$i];
       $query =  "INSERT INTO relationship_category_apps (app_id, category_apps_id) VALUES ($id_app , $item);";
    //  }
       // mysqli_close($conn);
       // $conn = connect_db();

       if (mysqli_query($conn, $query)) {
         // redirect with sucess
         echo 'MySQL app inserted';
         echo PHP_EOL;
         echo 'All done successfully, saying goodbye...';
         echo PHP_EOL;
         //header("Location: ../dashboard-uploaditem#SucessApp");
         // exit;
       } else {
         // redirect with failed
         echo 'Failed to insert app';
         echo PHP_EOL;
         echo mysqli_error($conn);
         // header("Location: ../dashboard-uploaditem#ERRORInsertCategory");
         exit();
       }
   }

   if ($type_app == 3 ) {
     // $id_app
     // // sendFile ();
     $subject = 'Sending a module-type application';
     $text = '';
     $msg = "<p>Hello!</p>" .
     "<p> A module-type application was sent to the marketplace server. </p> " .
     "<p> App ID: $id_app </p>" .
     "<p> Partner ID: $id_partner </p>";
     send_mailjet($subject,$text,$msg,Addons\EMAIL_SEND);

   }

   header("Location: ../dashboard-uploaditem#SUCESSInsert");
   exit();
     //*/

   }else if ($is_app == 0) { // if theme
     // create query TODO:
     // verify sessin, get id and save id in id_partner
     $plan_basic = $plans['plans'][0]['value'];

     if ($plans['total_plans'] == 2) {
       if ($plans['plans'][1]['value'] < $plans['plans'][0]['value']) {
         $plan_extend = $plans['plans'][0]['value'];
         $plan_basic = $plans['plans'][1]['value'];
       }else {
         $plan_extend = $plans['plans'][1]['value'];
       }
     }
     $dist_img = Addons\PATH_DATA . '/images/themes/';
     $dist_zip = Addons\PATH_DATA . '/template/';

     $n_template = $_POST['n_temp'];
     $tem = array();

     for ($i=1; $i <= $n_template ; $i++) {
       $img = send_file($_FILES,'img' . $i,1,$dist_img);
       $zip = send_file($_FILES,'tem' . $i,0,$dist_zip);

       if (($img != -1 AND $img != -2 AND $img != -3  ) AND
            ($zip != -1 AND $zip != -1 AND $zip != -3)) {
         $templates = array('id' => $i,
          'path_zip' => $zip,
          'path_img' => $img
          );
          array_push($tem, $templates);
          echo "$templates";
       }else {
         // TODO:
         // error
         echo "error ZIP : " . $zip . " img: " . $img;
         header("Location: ../dashboard-uploaditem#ERRORzip");
         exit();
       }
     }

     $body_json = json_decode($body_json,true);
     $body_json['plans'] = $plans;
     $body_json['templates'] = array('num_templates' => $n_template, 'templates' => $tem );
     $body_json = json_encode($body_json,JSON_UNESCAPED_UNICODE);
     $plan_basic = (int) number_format($plan_basic, 2, '', '');
     $plan_extend = (int) number_format($plan_extend, 2, '', '');

     // TODO:
     // thumbnail in insert
     //*
     $query =  "INSERT INTO themes (title,slug, partner_id, description,
          version, json_body, link_documentation, link_video, value_license_basic, value_license_extend )
        VALUES ('$name','$slug',$id_partner, '$description', '$numversion','$body_json',
        '$linkdoc', '$linkvideo',$plan_basic,$plan_extend);";

     // query search app and theme for index page

    if (!mysqli_query($conn, $query)) {
      echo PHP_EOL;
      echo "ERROR INSERT";
      echo PHP_EOL;
      echo mysqli_error($conn);
    }
     $id_app = (int) mysqli_insert_id($conn);

     //*/
     //*

     for ($i=0; $i < $num_category ; $i++) {

       $item = (int) $categories[$i];
       $query = "INSERT INTO relationship_category_themes (theme_id, category_themes_id) VALUES ($id_app , $item);";

       // mysqli_close($conn);
       // $conn = connect_db();

       if (mysqli_query($conn, $query)) {
         // redirect with sucess
         echo 'MySQL theme inserted';
         echo PHP_EOL;
         echo 'All done successfully, saying goodbye...';
         echo PHP_EOL;
       } else {
         // redirect with failed
         echo 'Failed to insert theme';
         echo PHP_EOL;
         handle_msyql_error($conn);
         // header("Location: ../dashboard-uploaditem#ERRORInsert");
         exit();
       }
    }
    header("Location: ../dashboard-uploaditem#SUCESSInsert");
    exit();
     //*/
   }else {
     // redirect dashboard-uploaditem?error=is_app
   }

}else {
  // redirect with error
  // echo "erro2";
  header("Location: ../dashboard-uploaditem#ERRORSend");
  exit;
}
