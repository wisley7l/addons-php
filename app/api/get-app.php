<?php

// Search app by id
$app_id = $_GET['id'];
// open in conection with db
$conn = mysqli_connect(Addons\MYSQL_HOST, Addons\MYSQL_USER, Addons\MYSQL_PASS, Addons\MYSQL_DB);
// check connection
if (mysqli_connect_errno()) {
    echo 'Connection failed: ';
    echo mysqli_connect_error();
    echo PHP_EOL;
    exit();
}
// convert string app_id for int and search app by id.
// String for query
$query = 'SELECT `id` FROM `apps` FROM `id` = ' . (int) $app_id;
// Send query for search
if (!$result = mysqli_query($conn, $query)) {
    // if querry error
    echo 'Failed to Search App';
    echo PHP_EOL;
    mysqli_error($conn);
} else {
    // check if the number of rows in the search is equal to zero, if yes there is no app with that id
    if (mysqli_num_rows($result) === 0) {
        http_response_code(404);
    } else {
        http_response_code(204);
    }
}
