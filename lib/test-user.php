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

function getAppThemeTest($id_app,$id_partner,$dictionary,$app)
{
  return array(
    'id_app' => $id_app,
    'name' => 'APP2',
    'id_partner' => $id_partner,
    'name_partner' => 'Partner 2',
    'value' => 20.03 / $dictionary['mult_coin'],
    'star_on' => 3, // not implemented
    'star_off' => 2, // not implemented
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
    'path_image' => 'https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_960_720.png',
    'number_apps_themes' => 3, // quantity of items found
    'number_badges' => 1, //not implemented
    'stars' => 1, // not implemented
    'evaluations' => 5 // not implemented
  );
}

function getImagesApp()
{
  $images = array();
  $i1 = array('id' => 1,
    'image' => 'https://lh3.googleusercontent.com/wIcl3tehFmOUpq-Jl3hlVbZVFrLHePRtIDWV5lZwBVDr7kEAgLTChyvXUclMVQDRHDEcDhY=w640-h400-e365',

  );

  $i2 = array('id' => 2,
    'image' => 'https://kaksimedia.com/kaxi/wp-content/uploads/2015/11/hacker-1024x480.jpg',
  );
  array_push($images,$i1);
  array_push($images,$i2);
  return $images;
}

function getImagesTheme($value='')
{
  $themes = array();
  $i1 = array('id' => 1,
    'image' => 'https://kaksimedia.com/kaxi/wp-content/uploads/2015/11/hacker-1024x480.jpg',
  );
  $i2 = array('id' => 2,
    'image' => 'https://lh3.googleusercontent.com/wIcl3tehFmOUpq-Jl3hlVbZVFrLHePRtIDWV5lZwBVDr7kEAgLTChyvXUclMVQDRHDEcDhY=w640-h400-e365',
  );
  array_push($themes,$i1);
  array_push($themes,$i2);
  return $themes;
}

// create connection to the database
$conn = mysqli_connect(Addon\MYSQL_HOST, Addon\MYSQL_USER, Addons\MYSQL_PASS, Addon\MYSQL_DB);
// check connection
if (mysqli_connect_errno()) {
  echo 'Connection failed: ';
  echo mysqli_connect_error();
  echo PHP_EOL;
  exit();
}
// query search app and theme for index page
$query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
  `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
  FROM `apps a`, `partners p`
  WHERE (`a.partner_id` = `p.id`)
  ORDER BY `a.title`
  LIMIT 25 ";

if ($result = mysqli_query(  $conn, $query )) {
  /* fetch associative array */
  while ($row = mysqli_fetch_assoc($result)) {
      // treat app
  }

  /* free result set */
  mysqli_free_result($result);

}



/*
In the index page search the highlights of themes and app.
*/



// create querys

// search all apps
// search all themes

// search all apps free
// search all themes free

// search apps with name
// search themes with name

// search apps with name and free
// search themes with name and free

// search apps with category
// search themes with category

// search apps with category  and free
// search themes with category and free

// search apps with name and category
// search themes with name and category

// search apps with name and free and category
// search themes with name and free and category
