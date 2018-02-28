<?php

$plan1 = array('id' => 'licence-regular',
  'name' => 'License Regular',
  'price' => 16.00 ,
  'description' => 'Test description 1',
  'checked' => 'checked',
);


$app_info = array('id' => $id_app,
  'name' => 'APP',
  'description' => 'kljdasklkdakdasslasdlsadljaksdasdalkkdasdjakldklasklasffkasfsaklçaskldaskhfajskasdfhasdjkdsaasdfjkjdsfld',
  'json' => 'treat json'
);


// body json app contains faqs, app contains plnas json
// body json them contains faqs and plans, descreiption and name plans is necessary

// function search_apps_partner($partner)
// {
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
      $item = get_app_theme($row['a.id'], $row['a.partner_id'], $row['a.title'], $row['a.thumbnail'], $row['a.value_plan_basic'],
        $row['p.username'], $row['p.path_image'], $dictionary, 1);
      array_push($apps, $item); // add item in array
    }

    // free result set
    mysqli_free_result($result);

  }
//   return $apps;
// }
// 
// `id`
// `partner_id`
// `title`
// `slug`
// `thumbnail`
// `description`
// `json_body`
// `paid`
// `version`
// `version_date`
// `type`
// `module`
// `load_events`
// `script_uri`
// `github_repository`
// `authentication`
// `auth_callback_uri`
// `auth_scope`
// `avg_stars`
// `evaluations`
// `website`
// `link_video`
// `plans_json`
// `value_plan_basic`
