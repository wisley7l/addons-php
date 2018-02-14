<?php
// get dictionary
$dictionary = get_dictionary();
// VARIABLES

// FUNCTIONS

// function handles item search to create view
function getAppTheme($id_app, $id_partner, $name_app, $image_app, $value_app,
  $name_partner, $image_partner, $dictionary,$app){
    return array(
      'id_app' => $id_app,
      'name' => $name_app,
      'id_partner' => $id_partner,
      'name_partner' => $name_partner,
      'value' => $value_app / $dictionary['mult_coin'], // value of the item multiplied by the currency of the country
      'star_on' => 3, // not implemented
      'star_off' => 2, // not implemented
      'image' => $image_app, // app image path
      'image_partner' => $image_partner, // partner image path
      'is_app'=> $app // if app is equal 1
    );
}
// QUERYS

// create connection to the database
$conn = mysqli_connect(Addon\MYSQL_HOST, Addon\MYSQL_USER, Addons\MYSQL_PASS, Addon\MYSQL_DB);
// check connection
if (mysqli_connect_errno()) {
  echo 'Connection failed: ';
  echo mysqli_connect_error();
  echo PHP_EOL;
  exit();
}
// function for index page get apps
function getAppIndex()
{
  $apps = array();
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`
    WHERE (`a.partner_id` = `p.id`)
    ORDER BY `a.title`
    LIMIT 25 ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = getAppTheme($row['a.id'], row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}
// function for index page get apps
function getThemeIndex()
{
  $themes = array();
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`
    WHERE (`t.partner_id` = `p.id`)
    ORDER BY `t.title`
    LIMIT 25 ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = getAppTheme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
        $row['p.username'], $row['p.path_image'], $dictionary, 0);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
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
