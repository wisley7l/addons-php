<?php
header('Content-Type: text/html; charset=utf-8');
$dictionary = get_dictionary();
$login = false;
// if login is true redirect index
//TODO: seccion
// TODO: treat login
// TODO: get the user name to treat the view

if (!empty($_POST['email'])) {
  $email = $_POST['email'];
  /*
  // get in API
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://e-com.plus/api/v1/partners.json?email='. $email);
  // prevent execution timeout
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
  ));
  $output = curl_exec($ch);
  // all done, close cURL
  curl_close($ch);
  $json = json_decode($response_body, true);
  // count($json['result']) > 0
  // $json['result'][0]['id']
  if (count($json['result']) > 0) {
    $id_partner = (int) $json['result'][0]['id'];
    // if exists partner
    // OBS :
    // query check if it already exists in the DB
    // if there is a return, the user is already registered
    //otherwise request password
    /* TODO:
    $conn = $GLOBAL['conn'];
    // query search app and theme for index page
    $query = "SELECT `p.id` FROM `partners p`
      WHERE (`p.id` = $id_partner) LIMIT 1";
    if (mysqli_query(  $conn, $query )) {
      // message error (partner already has password)
      // redirect #Exists Register
    }
    */
    /* ?
  }else {
    // partner has no pre-registration
    echo "partner has no pre-registration";
    # error redirect index
    // header("Location: /index#ErrorRegister");
    // exit;
  }
  ? */
echo PHP_EOL;
echo $id_partner;
echo PHP_EOL;
echo $email;
}else {
  # error redirect index
  header("Location: /index#ErrorRegister");
  exit;
}

$user = array(
  'id' => $id_partner,
  'name' => '',
  'username' => $email
);

// intial twig and send varibles for template
$loader = new Twig_Loader_Filesystem(Addons\PATH_APP . '/views');
$twig = new Twig_Environment($loader);
echo $twig->render('password-create.twig', array(
  'dictionary' => $dictionary,
  'login' => $login,
  'info_footer' => $info_footer,
    // test itens
  'user' => $user,
));
