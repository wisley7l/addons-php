<?php
// necessary index
function getUserLogin($dictionary)
{
  return array(
    'id_user' => $_SESSION['user_id'],
    'name_login' => $_SESSION['user_name'] ,
    'name' => $_SESSION['name'],
    'credits' => $_SESSION['credits'] / $dictionary['mult_coin'] ,
    'is_store' => $_SESSION['is_store'],
    'path_image' => $_SESSION['path_image']
  );
}

function getAppTheme($id_app,$id_partner,$dictionary,$app)
{
  return array(
    'id_app' => $id_app,
    'name' => 'APP2',
    'id_partner' => $id_partner,
    'name_partner' => 'Partner 2',
    'value' => 20.03 / $dictionary['mult_coin'],
    'star_on' => 3,
    'star_off' => 2,
    'image' => 'http://soucatequista.com.br/wp-content/uploads/2016/12/Christmas_night-250x150.jpg',
    'image_partner' => 'http://2.bp.blogspot.com/-7tydAWF_j7o/VbI736K_lTI/AAAAAAAADs4/vM0V-5nFTKw/s1600/boteco%2Bde%2Boa%2B%25285%2529.jpg',
    'is_app'=> $app
  );
}
// info partner for profile page
function getInfoUser($id)
{
  return array(
    'id' => $id,
    'name' => 'Partner 2',
    'location' => 'Brazil',
    'description' => 'dev',
    'member_since' => '1 Janary 2018',
    'total_sales' => 100, // sales quantity query
    'web_site' => 'www.example.com',
    'path_image' => 'http://bluebus-wp.s3.amazonaws.com/wp-content/uploads/2014/04/Mike-Mitchell-Marvel-Portraits-Time-mitchell_spiderman_press.jpg',
    'number_apps_themes' => 3, // quantity of items found
    'number_badges' => 1, //not implemented
    'stars' => 1, // not implemented
    'evaluations' => 5 // not implemented
  );
}
