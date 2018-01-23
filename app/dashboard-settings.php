<?php
header('Content-Type: text/html; charset=utf-8');
// get dictionary
$dictionary = get_dictionary();
// variable to check the user login, because some options are only allowed for online users
$login = false;

//(init) * Required on all pages *
// close writing session, if it exists and intal session
session_write_close();
session_start();
// if the session exists
if (isset($_SESSION)) {
  //modify the value of the login variable, by the value saved in the session
  //var_dump($_SESSION);
  $login = $_SESSION['login'];
  // set values for user, with the values saved in the session
  // array used to set user panel parameters
  $user_login = array(
    'id' => $_SESSION['user_id'],
    'name_user' => $_SESSION['user_name'] ,
    'credits' => 10.0 / $dictionary['mult_coin'] ,
    'id_user' => $_SESSION['user_id'],
    'is_store' => $_SESSION['is_store'],
    'image' => 'https://scontent.fplu1-1.fna.fbcdn.net/v/t1.0-9/22007860_1669412349777235_4400272234535034649_n.jpg?oh=e40ca78eb8dea885a958637b201503bd&oe=5ADF48F2'
    //'image' => '../images/dashboard/profile-default-image.png'
  );
  // query the user in db for more information to update
  // ex: about user, website, email
}
// check if logout attempt
if (isset($_GET['logout'])){
  // if attempt is true, destroy session values and redirect to index page
  session_destroy();
  // obs. check redirection on all pages
  header("Location: index");
}
//(end) * Required on all pages *

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('dashboard-settings.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'implemented' => false,
    // test
  'user' => $user_login,
));
