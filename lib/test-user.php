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
    'image' => '../images/items/westeros_m.jpg',
    'image_partner' => 'http://bluebus-wp.s3.amazonaws.com/wp-content/uploads/2014/04/Mike-Mitchell-Marvel-Portraits-Time-mitchell_spiderman_press.jpg',
    'is_app'=> $app
  );
}
