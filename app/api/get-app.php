<?php

// Search app by id
$app_id = (int)$_GET['id'];
if ($app_id > 0) {
  // open in conection with db
  $conn = mysqli_connect(Addons\MYSQL_HOST, Addons\MYSQL_USER, Addons\MYSQL_PASS, Addons\MYSQL_DB);
  // check connection
  if (mysqli_connect_errno()) {
    echo 'Connection failed: ';
    echo mysqli_connect_error();
    echo PHP_EOL;
    exit();
  }

  // String for query
  $query = 'SELECT `id` FROM `apps` FROM `id` = ' . $app_id;
  // Send query for search
  if (!$result = mysqli_query($conn, $query)) {
    // if querry error
    echo 'Failed to Search App';
    echo PHP_EOL;
    echo mysqli_error($conn);
  } else {
    // check if the number of rows in the search is equal to zero, if yes there is no app with that id
    if (mysqli_num_rows($result) === 0) {
      http_response_code(404);
    } else {
      http_response_code(204);
    }
  }
}

