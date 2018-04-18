<?php
// Search app by id
$app_id = (int)$_GET['id'];
if ($app_id > 0) {
  // open in conection with db
  $conn = connect_db();

  // String for query
  $query = 'SELECT `id` FROM `apps` WHERE `id` = ' . $app_id . ' LIMIT 1';
  // Send query for search
  if (!$result = mysqli_query($conn, $query)) {
    // if querry error
    echo 'Failed to Search App';
    echo PHP_EOL;
    echo mysqli_error($conn);
    echo PHP_EOL;
  } else {
    // echo "OK";
    // check if the number of rows in the search is equal to zero, if yes there is no app with that id
    if (mysqli_num_rows($result) === 0) {
      echo http_response_code(404);
    } else {
      echo http_response_code(204);
    }
  }
} else {
  echo http_response_code(400);
}
