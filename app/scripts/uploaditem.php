<?php
var_dump($_POST);

if(empty($_POST)) { // not exist post
  echo "error post";
  //header("Location: ../");
} elseif (!empty($_POST) and (empty($_POST['is_app']) ) ) {
  // is app not defined
  //header("Location: ../");
  echo "erro is app ";
} elseif (!empty($_POST) and (!empty($_POST['is_app']) ) ) {
  // is app defined
  $is_app  = (int) $_POST['is_app'];
  /*
  is_app == 1 create app, == 0 create theme
  name // name
  category // relationship category and item
  numversion // app and theme
  description // app and theme
  scripturl // app
  github // app
  website // app
  linkvideo // app and theme
  linkdoc // theme
  */
  if ($is_app == 1 ) {
    echo "Create app";
  } elseif ($is_app == 0 ) {
    echo "create theme";
  } else {
    echo "Error";
  }

}else {
  echo "not error ";
}
