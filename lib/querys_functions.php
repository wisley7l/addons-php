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
      'value' => $value_app / $dictionary['mult_coin'], // value of the item multiplied by the currency of the country
      'star_on' => 3, // not implemented
      'star_off' => 2, // not implemented
      'image' => $image_app, // app image path
      'image_partner' => $image_partner, // partner image path
      'is_app'=> $app // if app is equal 1
    );
}

// function to handle partner search and create view
function getInfoUser($id,$member_since,$path_image,$profile_json)
{
  $profile = json_decode($profile_json); // json decoding

  return array(
    'id' => $id,
    'name' => $profile['name'],
    'location' => $profile['address']['city'] . ',' . $profile['address']['country'],
    'occupation' => $profile['occupation'],
    'member_since' => $member_since,
    //'total_sales' => 100, // sales quantity query // not implemted
    'web_site' => $profile['public_contact'],
    'path_image' => $path_image,
    'number_apps_themes' => 3, // quantity of items found
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
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
function search_themes_partner($limit,$partner)
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
    ORDER BY `t.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['t.id'], $row['t.partner_id'], $row['t.title'], $row['t.thumbnail'], $row['t.value_license_basic'],
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($themes, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
  return $themes;
}

// (2) function to search partner apps with limit __OK__
function search_apps_partner($limit,$partner)
{
  $apps = array();
  $id_category = (int)$category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT `a.id`, `a.partner_id`,`a.title`, `a.thumbnail`,
    `a.value_plan_basic`,`p.id`, `p.username`, `p.path_image`
    FROM `apps a`, `partners p,
    WHERE (`a.partner_id` = `p.id` AND `t.partner_id` = $id_partner)
    ORDER BY `a.title`
    LIMIT $number ";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
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

}



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

//search apps with id partner OK --
//search themes with id partner OK --

// search app only with id
// search theme only with id

// search partner only with id


// ITEM PAGE

// Search the application or item by ID
// if theme, check if there is more than one template and return their respective id
// if there are only two plans, if possible return the description of each plan

// if app, fetch all app images
// check what plans you have, and return the description of each plan and the value.

// name and description of the theme or app are required
