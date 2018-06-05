<?php
// get dictionary
$dictionary = get_dictionary();
// VARIABLES

// FUNCTIONS

// function handles item search to create view
function get_app_theme($id_app, $id_partner, $name_app, $image_app, $value_app,
  $name_partner, $image_partner, $dictionary,$app){
    if ($image_partner == NULL ) {
      $image_partner = "../images/avatars/avatar_01.jpg";

    }
    if ($image_app == NULL) {
      $image_app = "../images/items/westeros_m.jpg";
    }
    //$image_app =
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
  if ($path_image == NULL) {
    $path_image = "../images/avatars/avatar_01.jpg";
  }
    return array(
    'id' => $id,
    'name' => 'test', // get via API
    'location' => '',// get via API
    'occupation' => '',// get via API
    'member_since' => $member_since,
    //'total_sales' => 100, // sales quantity query // not implemted
    'web_site' => '',// get via API
    'path_image' => $path_image,
    'number_apps_themes' => 0 //, // quantity of items found, started with zero
    //'number_badges' => 1, //not implemented
    //'stars' => 1, // not implemented
    //'evaluations' => 5 // not implemented
  );
}

// QUERYS

// create connection to the database
function connect_db()
{
  $conn = mysqli_connect(Addons\MYSQL_HOST, Addons\MYSQL_USER, Addons\MYSQL_PASS, Addons\MYSQL_DB);
  // check connection
  if (mysqli_connect_errno()) {
    echo 'Connection failed: ';
    echo mysqli_connect_error();
    echo PHP_EOL;
    exit();
  }
  return $conn;
}

$conn = connect_db();

// APPS
function treatNumber($number)
{
  $value = strval ($number); // convert number for string
  $value = "0" . $value; // complet string
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
    $query = "SELECT a.id, a.partner_id,a.title, a.thumbnail,
      a.value_plan_basic,p.id as p_id, p.path_image
      FROM apps a, partners p
      WHERE (a.active = 1 AND a.partner_id = p.id)
      ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  $query = "SELECT a.id, a.partner_id,a.title, a.thumbnail,
    a.value_plan_basic,p.id AS p_id, p.path_image
    FROM apps a, partners p
    WHERE (a.active = 1 AND a.partner_id = p.id AND a.value_plan_basic = 0)
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  $query = "SELECT a.id, a.partner_id,a.title, a.thumbnail,
    a.value_plan_basic,p.id AS p_id, p.path_image
    FROM apps a, partners p
    WHERE (a.active = 1 AND a.partner_id = p.id AND a.value_plan_basic = 0 AND a.title LIKE '%$name%')
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  //echo $name;
  // query search app and theme for index page
  $query = "SELECT a.id, a.partner_id,a.title, a.thumbnail,
    a.value_plan_basic,p.id AS p_id, p.path_image
    FROM apps a, partners p
    WHERE (a.active = 1 AND a.partner_id = p.id AND a.title LIKE '%$name%')
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  $query = "SELECT t.id, t.partner_id,t.title, t.thumbnail,
    t.value_license_basic,p.id AS p_id, p.path_image
    FROM themes t, partners p
    WHERE (t.partner_id = p.id)
    ORDER BY t.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $query = "SELECT t.id, t.partner_id,t.title, t.thumbnail,
    t.value_license_basic,p.id AS p_id, p.path_image
    FROM themes t, partners p
    WHERE (t.partner_id = p.id AND t.value_license_basic = 0)
    ORDER BY t.title;";

  if ($result = mysqli_query(  $conn, $query )) {

    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $query = "SELECT t.id, t.partner_id, t.title, t.thumbnail,
    t.value_license_basic, p.id AS p_id, p.path_image
    FROM themes t, partners p
    WHERE (t.partner_id = p.id AND t.value_license_basic = 0 AND t.title LIKE '%$name%')
    ORDER BY t.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $query = "SELECT t.id, t.partner_id, t.title, t.thumbnail,
    t.value_license_basic,p.id AS p_id, p.path_image
    FROM themes t, partners p
    WHERE (t.partner_id = p.id AND t.title LIKE '%$name%')
    ORDER BY t.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $number = (int) $limit;
  // query search app and theme for index page
  $query = "SELECT a.id, a.partner_id, a.title, a.thumbnail,
    a.value_plan_basic,p.id AS p_id, p.path_image
    FROM apps a, partners p , category_apps c , relationship_category_apps r
    WHERE (a.active = 1 AND a.partner_id = p.id AND r.app_id = a.id AND r.category_apps_id = c.id AND c.id = $id_category)
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  $number = (int) $limit;
  // query search app and theme for index page
  $query = "SELECT a.id, a.partner_id, a.title, a.thumbnail,
    a.value_plan_basic, p.id AS p_id, p.path_image
    FROM apps a, partners p, category_apps c , relationship_category_apps r
    WHERE (a.active = 1 AND a.partner_id = p.id AND a.value_plan_basic = 0
      AND r.app_id = a.id AND r.category_apps_id = c.id AND c.id = $id_category)
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  $query = "SELECT a.id, a.partner_id, a.title, a.thumbnail,
    a.value_plan_basic,p.id AS p_id, p.path_image
    FROM apps a, partners p, category_apps c , relationship_category_apps r
    WHERE (a.active = 1 AND a.partner_id = p.id AND a.value_plan_basic = 0 AND a.title LIKE '%$name%'
      AND r.app_id = a.id AND r.category_apps_id = c.id AND c.id = $id_category)
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  $query = "SELECT a.id, a.partner_id, a.title, a.thumbnail,
    a.value_plan_basic,p.id AS p_id, p.path_image
    FROM apps a, partners p, category_apps c , relationship_category_apps r
    WHERE (a.active = 1 AND a.partner_id = p.id AND a.title LIKE '%$name%'
      AND r.app_id = a.id AND r.category_apps_id = c.id AND c.id = $id_category)
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_ID'], $row['path_image'], $dictionary, 1);
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
  $query = "SELECT t.id, t.partner_id,t.title, t.thumbnail,
    t.value_license_basic, p.id AS p_id, p.path_image
    FROM themes t, partners p, category_themes c , relationship_category_themes r
    WHERE (t.partner_id = p.id
      AND r.theme_id = t.id AND r.category_themes_id = c.id AND c.id = $id_category)
    ORDER BY t.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $id_category = (int) $category;
  $number = (int) $limit;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT t.id, t.partner_id,t.title, t.thumbnail,
    t.value_license_basic, p.id AS p_id, p.path_image
    FROM themes t, partners p, category_themes c , relationship_category_themes r
    WHERE (t.partner_id = p.id AND t.value_license_basic = 0
      AND r.theme_id = t.id AND r.category_themes_id = c.id AND c.id = $id_category)
    ORDER BY t.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $query = "SELECT t.id, t.partner_id,t.title, t.thumbnail,
    t.value_license_basic,p.id, p.username, p.path_image
    FROM themes t, partners p, category_themes c , relationship_category_themes r
    WHERE (t.partner_id = p.id AND t.value_license_basic = 0 AND t.title = $name
      AND r.theme_id = t.id AND r.category_themes_id = c.id AND c.id = $id_category)
    ORDER BY t.title;";

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
  $query = "SELECT t.id, t.partner_id,t.title, t.thumbnail,
    t.value_license_basic,p.id AS p_id, p.path_image
    FROM themes t, partners p, category_themes c , relationship_category_themes r
    WHERE (t.partner_id = p.id AND t.title = $name
      AND r.theme_id = t.id AND r.category_themes_id = c.id AND c.id = $id_category)
    ORDER BY t.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT t.id, t.partner_id,t.title, t.thumbnail,
    t.value_license_basic,p.id AS p_id, p.path_image
    FROM themes t, partners p
    WHERE (t.partner_id = p.id AND t.partner_id = $id_partner)
    ORDER BY t.title";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_license_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 0);
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
  $id_partner = (int) $partner;

  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT a.id, a.partner_id,a.title, a.thumbnail,
    a.value_plan_basic,p.id AS p_id, p.path_image
    FROM apps a, partners p
    WHERE (a.active = 1 AND a.partner_id = p.id AND a.partner_id = $id_partner)
    ORDER BY a.title;";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = get_app_theme($row['id'], $row['partner_id'], $row['title'],
        $row['thumbnail'], treatNumber($row['value_plan_basic']),
        $row['p_id'], $row['path_image'], $dictionary, 1);
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
  $query =  "SELECT p.id, p.member_since, p.path_image, p.profile_json
    FROM partners p
    WHERE (p.id = $id_partner) LIMIT 1;";

    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $partner = getInfoUser($row['id'],$row['member_since'],$row['path_image'],
        $row['profile_json']); // increment total items on profile page
      }
      // free result set
      mysqli_free_result($result);
    }
    else {
      echo "ERROR";
    }

    if (!is_array($partner)) {
        return 404;
    }
    else {
      return $partner;
    }

}

// query search app with id

// body json app contains faqs, app contains plnas json
function search_app_id($id_app)
{
  $id = (int) $id_app;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT id, partner_id, title, slug, thumbnail, description,
    json_body, paid, version, version_date, type, module, load_events,
    script_uri, github_repository, authentication, auth_scope, avg_stars,
    evaluations,website,link_video,plans_json,value_plan_basic
    FROM apps
    WHERE ( active = 1 AND id = $id)
    LIMIT 1;";

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
        'value_plan_basic' => treatNumber($row['value_plan_basic']),
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
  $query = "SELECT id, partner_id, title, slug, thumbnail, description,
    json_body, paid, version, version_date, avg_stars, evaluations, link_documentation,
    link_video, value_license_basic,value_license_extend
    FROM themes
    WHERE ( id = $id)
    LIMIT 1;";

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

function search_transaction_id_theme($id_partner)
{
  echo "search_transaction_id";
  $id = (int) $id_partner;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT h.id, h.partner_id, h.store_id, h.theme_id ,
    h.transaction_code, h.notes, h.description, h.payment_value ,
    h.date_transaction, t.title
    FROM historic_transaction h, themes t
    WHERE ( h.partner_id = $id AND h.theme_id = t.id )";
    $transaction = array();

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = array(
        'id'=> $row['id'],
        'partner_id'=> $row['partner_id'],
        'store_id'=> $row['store_id'],
        'id_item'=> $row['theme_id'],
        'code'=> $row['transaction_code'],
        'notes'=> $row['notes'],
        'description'=> $row['description'],
        'price'=> treatNumber($row['payment_value']),
        'date_transaction'=> $row['date_transaction'],
        'name' =>  $row['title'],
      );
      array_push($transaction, $item);
    }
    // free result set
    mysqli_free_result($result);
  }
  // var_dump($transaction);
  return $transaction;
}

function search_transaction_id_app($id_partner)
{
  echo "search_transaction_id";
  $id = (int) $id_partner;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT h.id, h.partner_id, h.store_id, h.app_id ,
    h.transaction_code, h.notes, h.description, h.payment_value ,
    h.date_transaction, a.title
    FROM historic_transaction h, apps a
    WHERE ( h.partner_id = $id AND h.app_id = a.id )";
    $transaction = array();

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = array(
        'id'=> $row['id'],
        'partner_id'=> $row['partner_id'],
        'store_id'=> $row['store_id'],
        'id_item'=> $row['app_id'],
        'code'=> $row['transaction_code'],
        'notes'=> $row['notes'],
        'description'=> $row['description'],
        'price'=> treatNumber($row['payment_value']),
        'date_transaction'=> $row['date_transaction'],
        'name' =>  $row['title'],
      );
      array_push($transaction, $item);
    }
    // free result set
    mysqli_free_result($result);
  }
  // var_dump($transaction);
  return $transaction;
}

// TODO: Edit
function search_withdrawl_id($id_partner)
{
  $id = (int) $id_partner;
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT h.id, h.partner_id, h.date_withdrawal,
   h.value_withdrawal, h.transaction_code, h.notes
    FROM historic_withdrawal h
    WHERE ( h.partner_id = $id )";
    $transaction = array();

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = array(
      'id' => $row['id'],
      'id_partner' => $row['partner_id'],
      'code' => $row['date_withdrawal'],
      'value' => treatNumber($row['value_withdrawal']),
      'date' => $row['transaction_code'],
      'notes' => $row['notes']
      );
      array_push($transaction, $item);
    }
    // free result set
    mysqli_free_result($result);
  }
  return $transaction;
}


function getImagesApp($id)
{
  $id_app = (int) $id;
  $images = array();
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT id, path_image FROM image_apps WHERE app_id = $id_app";

  if ($result = mysqli_query(  $conn, $query )) {
    // fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
      $item = array(
      'id' => $row['id'],
      'path_img' => $row['path_image']
      );
      // var_dump($item);
      array_push($images, $item);
    }
    // free result set
    mysqli_free_result($result);
  }
  return $images;
}
//
function get_apps_buy($id)
{
  $id_store = (int) $id;

  $buys = array();
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT b.id, b.app_id, b.store_id,b.date_init, b.date_end,
  b.date_renovation,b.type_plan, b.payment_status, h.transaction_code,
  b.app_value, b.plan_id, a.partner_id, a.title, a.plans_json, a.json_body
    FROM buy_apps b, apps a, historic_transaction h
    WHERE ( b.app_id = a.id AND b.payment_status = 1 AND
      b.id_transaction =h.id AND b.store_id = $id_store); ";

    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $item = array(
        'id' => $row['id'],
        'id_app' => $row['app_id'],
        'id_partner' => $row['partner_id'], // id partner or name
        'title' => $row['title'],
        'date_init' => $row['date_init'],
        'date_end' => $row['date_end'], // info id plan or id template
        'price' => treatNumber($row['app_value']), // value theme or app
        'transaction' => $row['transaction_code'],
        'is_app' => 1
        );
        // var_dump($item);
        array_push($buys, $item);
      }
      // free result set
      mysqli_free_result($result);
    }
  return $buys;
}
//
function get_themes_buy($id)
{
  $id_store = (int) $id;
  echo $id_store;
  $buys = array();
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT b.id, b.theme_id, b.store_id, b.payment_status,
   b.license_type, h.transaction_code, b.theme_value, b.template_id,
   t.partner_id, t.title, t.json_body
    FROM buy_themes b, themes t, historic_transaction h
    WHERE (b.theme_id = t.id AND b.payment_status = 1 AND h.id = b.id_transaction
       AND b.store_id = $id_store); ";

    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $item = array(
        'id' => $row['id'],
        'id_app' => $row['theme_id'],
        'id_partner' => $row['partner_id'], // id partner or name
        'title' => $row['title'],
        'date_init' => '-',
        'date_end' => '-', // info id plan or id template
        'price' => treatNumber($row['theme_value']), // value theme or app
        'transaction' => $row['transaction_code'],
        'is_app' => 0
        );
        var_dump($item);
        array_push($buys, $item);
      }

      // free result set
      mysqli_free_result($result);
    }else {
      echo mysqli_error($conn);
    }
    return $buys;
}

function get_themes_car($id)
{
  $id_store = (int) $id;
  echo $id_store;
  $buys = array();
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT b.id, b.theme_id, b.store_id, b.payment_status,
   b.license_type, b.theme_value, b.template_id,
   t.partner_id, t.title, t.json_body
    FROM buy_themes b, themes t
    WHERE (b.theme_id = t.id AND b.payment_status = 0 AND b.store_id = $id_store); ";

    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $item = array(
        'id' => $row['id'],
        'id_app' => $row['theme_id'],
        'id_partner' => $row['partner_id'], // id partner or name
        'id_store' => $row['store_id'], // id partner or name
        'title' => $row['title'],
        'date_valid' => '-',
        'plan' => 'license' . $row['license_type'], // info id plan or id template
        'price' => treatNumber($row['theme_value']), // value theme or app
        'template' => 'Template' . $row['template_id'],
        'is_app' => 0
        );
        // var_dump($item);
        array_push($buys, $item);
      }

      // free result set
      mysqli_free_result($result);
    }else {
      echo mysqli_error($conn);
    }
    return $buys;
}
function get_apps_car($id)
{
  $id_store = (int) $id;
  echo $id_store;
  $buys = array();
  $conn = $GLOBALS['conn']; // get varible global conn
  // query search app and theme for index page
  $query = "SELECT b.id, b.app_id, b.store_id, b.payment_status,
    b.date_init,b.date_end,b.date_renovation,b.type_plan,b.app_value,
    b.payment_status,b.plan_id,b.id_transaction,
    a.partner_id, a.title, a.plans_json
    FROM buy_apps b, apps a
    WHERE (b.app_id = a.id AND b.payment_status = 0 AND b.store_id = $id_store); ";

    if ($result = mysqli_query(  $conn, $query )) {
      // fetch associative array
      while ($row = mysqli_fetch_assoc($result)) {
        $item = array(
        'id' => $row['id'],
        'id_app' => $row['theme_id'],
        'id_partner' => $row['partner_id'], // id partner or name
        'id_store' => $row['store_id'], // id partner or name
        'title' => $row['title'],
        'date_valid' => $row['date_end'],
        'plan' => 'Plan-' . $row['plan_id'], // info id plan or id template
        'price' => treatNumber($row['app_value']), // value theme or app
        'template' => '-',
        'is_app' => 1
        );
        // var_dump($item);
        array_push($buys, $item);
      }













      // free result set
      mysqli_free_result($result);
    }else {
      echo mysqli_error($conn);
    }
    return $buys;
}


function sendFile($filepath,$is_app)
{
   // Process download
   if(file_exists($filepath)) {
     header('Content-Description: File Transfer');
     header('Content-Type: application/octet-stream');
     header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
     header('Expires: 0');
     header('Cache-Control: must-revalidate');
     header('Pragma: public');
     header('Content-Length: ' . filesize($filepath));
     flush(); // Flush system output buffer
     readfile($filepath);
     exit;
   }
}

// function insert_history_transaction($id_partner, $id_store, $id_app, $id_theme,
//   $price, $transaction_code, $notes, $description, $date_transaction)
// {
//   $partner_id = (int) $id_partner;
//   $store_id = (int) $id_store;
//   $app_id = (int) $id_app;
//   $theme_id = (int) $id_theme;
//   $payment_value = (int) $price;// obs
//
//   $conn = $GLOBALS['conn']; // get varible global conn
//
//   $query =  "INSERT INTO historic_transaction (partner_id, store_id,theme_id,
//      transaction_code,notes, description, payment_value) VALUES ($partner_id,
//        $store_id, $theme_id,'$transaction_code','$notes','$description',$payment_value);";
//   //*/
//   //*
//   // query search app and theme for index page
//   if (!mysqli_query($conn, $query)) {
//     echo PHP_EOL;
//     echo "ERROR insert history";
//     echo PHP_EOL;
//     echo mysqli_error($conn);
//     // // error INSERT // redirect
//     // header("Location: ../dashboard-uploaditem#ERRORInsertApp");
//     // exit();
//   }
//   $id_buy = (int) mysqli_insert_id($conn);
//   echo $id_buy;
//   echo PHP_EOL;
//   return $id_buy;
// }

function insert_history_transaction($id_partner, $id_store, $id_app, $id_theme,
  $price, $transaction_code, $notes, $description, $date_transaction)
{
  $partner_id = (int) $id_partner;
  $store_id = (int) $id_store;
  $app_id = (int) $id_app;
  $theme_id = (int) $id_theme;
  $payment_value = (int) $price;// obs
  if ($app_id == 0 ) {
    $app_id = 'NULL';
  }
  if ($theme_id == 0 ) {
    $theme_id = 'NULL';
  }
  if ($date_transaction == '') {
    $date_transaction = 'NULL';
  }

  $conn = $GLOBALS['conn']; // get varible global conn
  $query =  "INSERT INTO historic_transaction (partner_id, store_id,app_id,theme_id,
     transaction_code,notes,description,payment_value,date_transaction)
      VALUES ($partner_id,$store_id,$app_id,$theme_id,'$transaction_code',
        '$notes','$description',$payment_value,$date_transaction);";
  echo PHP_EOL;
  echo $query;
  echo PHP_EOL;
  //*/
  //*
  // query search app and theme for index page
  if (!mysqli_query($conn, $query)) {
    echo PHP_EOL;
    echo "ERROR insert history";
    echo PHP_EOL;
    echo mysqli_error($conn);
    // // error INSERT // redirect
    // header("Location: ../dashboard-uploaditem#ERRORInsertApp");
    exit();
  }
  $id_buy = (int) mysqli_insert_id($conn);
  echo $id_buy;
  echo PHP_EOL;
  return $id_buy;
}

function update_partner_credits($id_partner,$credits)
{
  $id = (int) $id_partner;
  $credit = (int) $credits;
  $conn = $GLOBALS['conn']; // get varible global conn

  $query = "UPDATE partners SET credit = credit + $credit WHERE id =  $id;";
  if (!mysqli_query($conn, $query)) {
    echo "ERROR update partner";
    echo PHP_EOL;
    echo mysqli_error($conn);
    // // error INSERT // redirect
    // header("Location: ../dashboard-uploaditem#ERRORInsertApp");
    // exit();
  }
}

function update_buy_themes($id,$transaction)
{
  $id_transaction = (int) $transaction;
  $id_buy = (int) $id;

  $conn = $GLOBALS['conn']; // get varible global conn
  $query =  "UPDATE buy_themes SET payment_status = 1, id_transaction = $id_transaction
    WHERE id = $id_buy; ";

  if (!mysqli_query($conn, $query)) {
    echo "ERROR update buy";
    echo PHP_EOL;
    echo mysqli_error($conn);
    // // error INSERT // redirect
    // header("Location: ../dashboard-uploaditem#ERRORInsertApp");
    // exit();
  }

}

function update_buy_apps($id,$transaction,$duration_plan)
{
  echo "string: $duration_plan\n ";
  $date_duration = (int)$duration_plan;
  $day_add = (int)($date_duration/2);
  $date_init = time ();
  $date_end = $date_init + ($date_duration*30*24*60*60) + ($day_add*24*60*60);
  $date_renovation = $date_end - (15*24*60*60);
  $date_init = date("Y-m-d H:i:s",$date_init);
  $date_end = date("Y-m-d H:i:s",$date_end);
  $date_renovation = date("Y-m-d H:i:s",$date_renovation);

  $id_transaction = (int) $transaction;
  $id_buy = (int) $id;

  $conn = $GLOBALS['conn']; // get varible global conn
  $query =  "UPDATE buy_apps SET payment_status = 1, id_transaction = $id_transaction,
    date_init = '$date_init', date_end = '$date_end', date_renovation = '$date_renovation'
    WHERE id = $id_buy; ";
  echo PHP_EOL;
  echo $query;
  echo PHP_EOL;

  if (!mysqli_query($conn, $query)) {
    echo "ERROR update buy";
    echo PHP_EOL;
    echo mysqli_error($conn);
    // // error INSERT // redirect
    // header("Location: ../dashboard-uploaditem#ERRORInsertApp");
    // exit();
  }

}


function verify_plan($array_plan, $id_plan)
{
  $r['verify'] = 0;
  for ($i=0; $i < count($array_plan) ; $i++) {
    if ($array_plan[$i]['id'] == $id_plan ) {
      $r['verify'] = 1;
      $r['price'] = $array_plan[$i]['value'];
      $r['duration'] = $array_plan[$i]['duration'];
      echo $r['duration'];
      break;
    }
  }
  return $r;
}

function verify_template($array_template, $id_template)
{
  $r['verify'] = 0;
  for ($i=0; $i < count($array_template) ; $i++) {
    if ($array_template[$i]['id'] == $id_template ) {
      $r['verify'] = 1;
      $r['path_zip'] = $array_template[$i]['path_zip'];
      $r['path_img'] = $array_template[$i]['path_img'];
      break;
    }
  }
  return $r;
}

function treatImages($path)
{
  echo strlen ( Addons\PATH_DATA );
  // $real = substr($value, 0, $part); // value without the cents
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
