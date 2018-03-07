<?php
// get dictionary
$dictionary = get_dictionary();
// VARIABLES

// FUNCTIONS

// function handles item search to create view
function get_app_theme($id_app, $id_partner, $name_app, $image_app, $value_app,
  $name_partner, $image_partner, $dictionary,$app){
    return array(
      'id_app' => $id_app,
      'name' => $name_app,
      'id_partner' => $id_partner,
      'name_partner' => $name_partner,
      'value' => $value_app, // value of the item multiplied by the currency of the country
      'star_on' => 0, // not implemented
      'star_off' => 0, // not implemented
      'image' => $image_app, // app image path
      'image_partner' => $image_partner, // partner image path
      'is_app'=> $app // if app is equal 1
    );
}

// function to handle partner search and create view
function getInfoUser($id,$member_since,$path_image,$profile_json)
{


  return array(
    'id' => $id,
    'name' => '', // get via API
    'location' => '',// get via API
    'occupation' => '',// get via API
    'member_since' => $member_since,
    //'total_sales' => 100, // sales quantity query // not implemted
    'web_site' => '',// get via API
    'path_image' => $path_image,
    'number_apps_themes' => 0, // quantity of items found, started with zero
    //'number_badges' => 1, //not implemented
    //'stars' => 1, // not implemented
    //'evaluations' => 5 // not implemented
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
// APPS
function treatNumber($number)
{
  $value = strval ($number); // length number
  $part = strlen ( $value ) - 2; // the last two digits are equivalent to cents
  $real = substr($value, 0, $part); // value without the cents
  $cents = substr($value, $part); // value only the cents
  $value = $real . "." . $cents; // value complet (string)
  return (float) $value;
}

// (1) function to fetch all apps with limit __OK__
function search_all_apps($limit)
{
  $apps = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`
    WHERE (`a.partner_id` = `p.id`)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

//(2) function to fetch all apps free with limit __OK__
function search_all_apps_free($limit)
{
  $apps = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`
    WHERE (`a.partner_id` = `p.id` AND `a.value_plan_basic` = 0)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

//(3) function to search free apps by name with limit __OK__
function search_apps_free_name($limit,$search)
{
  $apps = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string

  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`
    WHERE (`a.partner_id` = `p.id` AND `a.value_plan_basic` = 0 AND `a.title` = $name)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

//(4) function to search apps by name with limit __OK__
function search_apps_all_name($limit,$search)
{
  $apps = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`
    WHERE (`a.partner_id` = `p.id` AND `a.title` = $name)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

// THEMES

//(1) function to fetch all themes with limit __OK__
function search_all_themes($limit)
{
  $themes = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`
    WHERE (`t.partner_id` = `p.id`)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}
//(2) function to fetch all apps free with limit __OK__
function search_all_themes_free($limit)
{
  $themes = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`
    WHERE (`t.partner_id` = `p.id` AND `t.value_license_basic` = 0)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

//(3) function to search free themes by name with limit __OK__
function search_themes_free_name($limit,$search)
{
  $themes = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`
    WHERE (`t.partner_id` = `p.id` AND `t.value_license_basic` = 0 AND `t.title` = $name)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

//(4) function to search apps by name with limit __OK__
function search_themes_all_name($limit,$search)
{
  $themes = array();
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`
    WHERE (`t.partner_id` = `p.id` AND `t.title` = $name)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}
// APPS BY CATEGORY

// (1) function to fetch all apps with limit __OK__
function search_apps_category($limit,$category)
{
  $apps = array();
  $id_category = (int)$category;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p` , `category_apps c` , `relationship_category_apps r`
    WHERE (`a.partner_id` = `p.id` AND `r.app_id` = `a.id` AND `r.category_apps_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

//(2) function to fetch all apps free with limit __OK__
function search_apps_free_category($limit,$category)
{
  $apps = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`, `category_apps c` , `relationship_category_apps r`
    WHERE (`a.partner_id` = `p.id` AND `a.value_plan_basic` = 0
      AND `r.app_id` = `a.id` AND `r.category_apps_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

//(3) function to search free apps by name with limit __OK__
function search_apps_free_name_category($limit,$search,$category)
{
  $apps = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`, `category_apps c` , `relationship_category_apps r`
    WHERE (`a.partner_id` = `p.id` AND `a.value_plan_basic` = 0 AND `a.title` = $name
      AND `r.app_id` = `a.id` AND `r.category_apps_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

//(4) function to search apps by name with limit __OK__
function search_apps_name_category($limit,$search,$category)
{
  $apps = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`, `category_apps c` , `relationship_category_apps r`
    WHERE (`a.partner_id` = `p.id` AND `a.title` = $name
      AND `r.app_id` = `a.id` AND `r.category_apps_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

// THEME BY CATEGORY

//(1) function to fetch all themes with limit __OK__
function search_themes_category($limit,$category)
{
  $themes = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`, `category_themes c` , `relationship_category_themes r`
    WHERE (`t.partner_id` = `p.id`
      AND `r.theme_id` = `t.id` AND `r.category_themes_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

//(2) function to fetch all apps free with limit __OK__
function search_themes_free_category($limit,$category)
{
  $themes = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`, `category_themes c` , `relationship_category_themes r`
    WHERE (`t.partner_id` = `p.id` AND `t.value_license_basic` = 0
      AND `r.theme_id` = `a.id` AND `r.category_themes_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

//(3) function to search free themes by name with limit __OK__
function search_themes_free_name_category($limit,$search,$category)
{
  $themes = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p`, `category_themes c` , `relationship_category_themes r`
    WHERE (`t.partner_id` = `p.id` AND `t.value_license_basic` = 0 AND `t.title` = $name
      AND `r.theme_id` = `t.id` AND `r.category_themes_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

//(4) function to search apps by name with limit __OK__
function search_themes_name_category($limit,$search,$category)
{
  $themes = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  $name = mysqli_real_escape_string($conn, $search); // escape string
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p, `category_themes c` , `relationship_category_themes r`
    WHERE (`t.partner_id` = `p.id` AND `t.title` = $name
      AND `r.theme_id` = `t.id` AND `r.category_themes_id` = `c.id` AND `c.id` = $id_category)
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

// PROFILE PAGE

//(1) function to search partner themes with limit __OK__
function search_themes_partner($partner)
{
  $themes = array();
  $id_partner = (int) $partner;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `t.id`, `t.partner_id`,`t.title`, `t.thumbnail`,
    `t.value_license_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `themes t`, `partners p,
    WHERE (`t.partner_id` = `p.id` AND `t.partner_id` = $id_partner)
    ORDER BY `t.title`";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'],
        $row['t.thumbnail'], treatNumber($row['t.value_license_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

// (2) function to search partner apps with limit __OK__
function search_apps_partner($partner)
{
  $apps = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p`,
    WHERE (`a.partner_id` = `p.id` AND `t.partner_id` = $id_partner)
    ORDER BY `a.title`";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'],
        $row['a.thumbnail'], treatNumber($row['a.value_plan_basic']),
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $apps;
}

// query for partner search
function search_partner_id($partner)
{
  $id_partner = (int) $partner; // escape id partner
  $conn = $GLOBALS['conn']; // get varible global conn
  $number = 1; // limit

  $query =  "SELECT `p.id`, `p.member_since`, `p.path_image`, `p.profile_json`
    FROM `partners p`
    WHERE (`p.id` = '$id_partner')
    LIMIT '$number' ";

    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $partner = getInfoUser($row['id'],$row['member_since'],$row['path_image'],
        $row['profile_json']); // increment total items on profile page
      }
      // free result set
      mysqli_free_result($result);
    }
    return $partner;
}

// query search app with id

// body json app contains faqs, app contains plnas json
function search_app_id($id_app)
{
  $id = (int) $id_app;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `id`, `partner_id`, `title`, `slug`, `thumbnail`, `description`,
    `json_body`, `paid`, `version`, `version_date`, `type`, `module`, `load_events`,
    `script_uri`, `github_repository`, `authentication`, `auth_scope`, `avg_stars`,
    `evaluations`,`website`,`link_video`,`plans_json`,`value_plan_basic`
    FROM `apps`
    WHERE ( `id` = $id)";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = array(
        'id'=> $row['id'],
        'partner_id'=> $row['partner_id'],
        'title'=> $row['title'],
        'slug'=> $row['slug'],
        'thumbnail'=> $row['thumbnail'],
        'description'=> $row['description'],
        'json_body'=> $row['json_body'],
        'paid'=> $row['paid'],
        'version'=> $row['version'],
        'version_date'=> $row['version_date'],
        'type' => $row['type'],
        'module' => $row['module'],
        'load_events' => $row['load_events'],
        'script_uri' => $row['script_uri'],
        'github_repository' => $row['github_repository'],
        'authentication' => $row['authentication'],
        'auth_scope' => $row['auth_scope'],
        'avg_stars' => $row['avg_stars'],
        'evaluations' => $row['evaluations'],
        'website' => $row['website'],
        'link_video' => $row['link_video'],
        'plans_json' => $row['plans_json'],
        'value_plan_basic' => $row['value_plan_basic'],
      );
    }

    // free result set
    mysqli_free_result($result);

  }
  return $item;
}


// query search theme with id
// body json them contains faqs and plans, descreiption and name plans is necessary
function search_theme_id($id_theme)
{
  $id = (int) $id_theme;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `id`, `partner_id`, `title`, `slug`, `thumbnail`, `description`,
    `json_body`, `paid`, `version`, `version_date`, `avg_stars`, `evaluations`, `link_documentation`,
    `link_video`, `value_license_basic`,`value_license_extend`
    FROM `themes`
    WHERE ( `id` = $id)
    LIMIT 1";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = array(
        'id'=> $row['id'],
        'partner_id'=> $row['partner_id'],
        'title'=> $row['title'],
        'slug'=> $row['slug'],
        'thumbnail'=> $row['thumbnail'],
        'description'=> $row['description'],
        'json_body'=> $row['json_body'],
        'paid'=> $row['paid'],
        'version'=> $row['version'],
        'version_date'=> $row['version_date'],
        'avg_stars' => $row['avg_stars'],
        'evaluations' => $row['evaluations'],
        'link_documentation' => $row['link_documentation'],
        'link_video' => $row['link_video'],
        'value_license_basic' => $row['value_license_basic'],
        'value_license_extend' => $row['value_license_extend'],
      );
    }

    // free result set
    mysqli_free_result($result);

  }
  return $item;
}

// FUNCTION item page
function item_page($id_item, $is_app)
{
  // body json app contains faqs, app contains plnas json
  // body json them contains faqs and plans, descreiption and name plans is necessary
  if ((int) $is_app == 1) { // is app
    $item = search_app_id($id_item);

    // $faqs =
    // treat plans for view
    $plans_json = json_decode($item['plans_json'],true);
    $plans = array();
    for ($i=0; $i < $plans_json['total_plans'] ; $i++) {
      $plan = array(
        'id' => $plans_json['plans'][$i]['id'],
        'name' => $plans_json['plans'][$i]['name'],
        'price' => $plans_json['plans'][$i]['value'],
        'description' => $plans_json['plans'][$i]['desc'],
        'checked'=> ''
      );
      if ($i == 0) {
        $plan['checked'] = 'checked';
      }
      array_push($plans, $plan);
    }

    $desc = ' ' . $item['description'] .  ',Version: ' . $item['version'] .
      'Date version: ' . $item['version_date'] . ',Type: ' . $item['type'] .
      ', Module: ' . $item['module'];

    $app = array(
        'id' => $item['id'],
        'name' => $item['title'],
        'description' => $desc,
        'video' => $item['link_video'],
        'website' => $item['website']
    );

    // return in function
    return array(
      'item' => $app ,
      'plans' => $plans,
      'faqs' => $faqs
    );

  }elseif ((int) $is_app == 0) { // is theme
    $item = search_theme_id($id_item);
    /*
    `id`, `partner_id`, `title`, `slug`, `thumbnail`, `description`,
      `json_body`, `paid`, `version`, `version_date`, `avg_stars`, `evaluations`, `link_documentation`,
      `link_video`, `value_license_basic`,`value_license_extend`
    */
    $faqs_json = json_decode($item['json_body'],true);
    $plans_json = $faqs_json['plans'];

    // treat plans
    $plans = array();
    for ($i=0; $i < $plans_json['total_plans'] ; $i++) {
      $plan = array(
        'id' => $plans_json['plans'][$i]['id'],
        'name' => $plans_json['plans'][$i]['name'],
        'price' => $plans_json['plans'][$i]['value'],
        'description' => $plans_json['plans'][$i]['desc'],
        'checked'=> ''
      );
      if ($i == 0) {
        $plan['checked'] = 'checked';
      }
      array_push($plans, $plan);
    }

    $desc = ' ' . $item['description'] .  ',Version: ' . $item['version'] .
      'Date version: ' . $item['version_date'];

    $theme = array(
        'id' => $item['id'],
        'name' => $item['title'],
        'description' => $desc,
        'video' => $item['link_video'],
        'website' => $item['link_documentation']
    );

    return array(
      'item' => $theme,
      'plans' => $plans,
      'faqs' => $faqs
    );

  }
}

function search_transaction_id($id_partner)
{
  $id = (int) $id_partner;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `h.id`, `h.partner_id`, `h.store_id`, `h.app_id`, `h.theme_id`,
    `h.transaction_code`, `h.notes`, `h.description`, `h.payment_value` ,
    `h.date_transaction`, `t.title`, `a.title`
    FROM `historic_transaction h`, `themes t`, `apps a`
    WHERE ( `partner_id` = $id AND (`h.app_id` = `a.id` OR `h.app_id` = `t.id`) )";
    $transaction = array();

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row[`h.app_id`] == NULL) {
        $name = $row['t.title'];
        $id_item = $row['h.theme_id'];
      }else {
        $name = $row['a.title'];
        $id_item = $row['h.app_id'];
      }
      $item = array(
        'id'=> $row['h.id'],
        'partner_id'=> $row['h.partner_id'],
        'store_id'=> $row['h.store_id'],
        'id_item'=> $id_item,
        'code'=> $row['h.transaction_code'],
        'notes'=> $row['h.notes'],
        'description'=> $row['h.description'],
        'price'=> $row['h.payment_value'],
        'date_transaction'=> $row['h.date_transaction'],
        'name' => $name,
      );
      array_push($transaction, $item);
    }
    // free result set
    mysqli_free_result($result);
  }
  return $transaction;
}



/*
$item = array(
  'id_item' => 1000,
  'price' => 12,
  'date' => '2 de marco',
  'code' => 'EF001',
  'is_app' => 'app',
  'id_shopkeeper' => 3,
  'note' => 'nothing'
 );
*/

/*
In the index page search the highlights of themes and app.
*/



// create querys

// search all apps OK--
// search all themes OK--

// search all apps free OK--
// search all themes free OK --

// search apps with name OK--
// search themes with name OK--

// search apps with name and free OK--
// search themes with name and free OK--

// search apps with category OK--
// search themes with category OK --

// search apps with category  and free OK--
// search themes with category and free OK --

// search apps with name and category OK--
// search themes with name and category OK --

// search apps with name and free and category OK--
// search themes with name and free and category OK --

//search apps with id partner OK --value_license_extend
//search themes with id partner OK --

// search app only with id
// search theme only with id

// search partner only with id ok --


// ITEM PAGE

// Search the application or item by ID
// if theme, check if there is more than one template and return their respective id
// if there are only two plans, if possible return the description of each plan

// if app, fetch all app images
// check what plans you have, and return the description of each plan and the value.

// name and description of the theme or app are required
