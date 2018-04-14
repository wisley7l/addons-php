<?php

function send_file($file,$title,$type,$dist)
{
  $_FILES = $file;
  
  // verifica se foi enviado um arquivo
  if ( isset( $_FILES[ $title ][ 'name' ] ) && $_FILES[ $title ][ 'error' ] == 0 ) {
      echo 'Você enviou o arquivo:'. $_FILES[ $title ][ 'name' ] ;
      echo PHP_EOL;
      echo 'Este arquivo é do tipo: ' . $_FILES[ $title ][ 'type' ] ;
      echo PHP_EOL;
      echo 'Temporáriamente foi salvo em: ' . $_FILES[ $title ][ 'tmp_name' ] ;
      echo PHP_EOL;
      echo 'Seu tamanho é: ' . $_FILES[ $title ][ 'size' ] ;
      echo PHP_EOL;

      $file_tmp = $_FILES[ $title ][ 'tmp_name' ];
      $name = $_FILES[ $title ][ 'name' ];
      $length = $_FILES[ $title ][ 'size' ];

      // Pega a extensão
      $extension = pathinfo ( $name, PATHINFO_EXTENSION );

      // Converte a extensão para minúsculo
      $extension = strtolower ( $extension );

      // Somente imagens, .jpg;.jpeg;.gif;.png
      // Aqui eu enfileiro as extensões permitidas e separo por ';'
      // Isso serve apenas para eu poder pesquisar dentro desta String

      if ($type == 1){
        $extension_file = '.jpg;.jpeg;.gif;.png';
        $length_file = 1960000;
      }else {
        $extension_file ='.zip';
        $length_file = 1960000;
      }

      if ( strstr ( $extension_file, $extension ) AND $length <= $length_file ) {
          // Cria um nome único para esta imagem
          // Evita que duplique as imagens no servidor.
          // Evita nomes com acentos, espaços e caracteres não alfanuméricos
          $new_name =  uniqid ( time () ) . '.' . $extension;

          // Concatena a pasta com o nome
          $dist = $dist . $new_name;

          // tenta mover o arquivo para o destino
          if ( @move_uploaded_file ( $file_tmp, $dist ) ) {
            echo $dist;
            return $dist;

          }
          else
              return -1;
      }
      else
          return -2;
  }
  else
      return 0;
}

function getUserAPI($email)
{

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
      header("Location: /index#existsregister");
      exit;
    }
    */
    return $id_partner;
  }else {
    // partner has no pre-registration
    //echo "partner has no pre-registration";
    # error redirect index TODO:
    // header("Location: /index#usernotfound");
    // exit;
  }
}
//
function createSession($id,$email,$name,$credits,$image)
{
  if ($image == '' || $image == NULL) {
    $image = 'https://www.ocf.berkeley.edu/~dblab/blog/wp-content/uploads/2012/01/icon-profile.png';
  }

  session_id($id);
  session_start();
  $_SESSION['user_id'] = (int) $id;
  $_SESSION['user_name'] = $email; // get via API
  $_SESSION['name'] = $name; // get via API
  $_SESSION['login'] = true;
  $_SESSION['is_store'] = false; // false is partner, true is store
  $_SESSION['credits'] = (float) $credits; // get via DB
  $_SESSION['path_image'] = $image; // Get via DB
  if (!is_writable(session_save_path())) {
  //echo 'Session path "'.session_save_path().'" is not writable for PHP!';
  }
  else {
    header("Location: ../#sucesslogin");
    exit;
  }
}

//
// necessary index
function getUserLogin($dictionary)
{
  return array(
    'id_user' => $_SESSION['user_id'],
    'name_login' => $_SESSION['user_name'] ,
    'name' => $_SESSION['name'],
    'credits' => $_SESSION['credits'],
    'is_store' => $_SESSION['is_store'],
    'path_image' => $_SESSION['path_image']
  );
}

function getAppThemeTest($id_app,$id_partner,$dictionary,$app)
{
  return array(
    'id_app' => $id_app,
    'name' => 'APP2',
    'id_partner' => $id_partner,
    'name_partner' => 'Partner 2',
    'value' => 20.03,
    'star_on' => 3, // not implemented
    'star_off' => 2, // not implemented
    'image' => '',
    'image_partner' => '',
    'is_app'=> $app
  );
}
// info partner for profile page
function getInfoUserTest($id)
{
  return array(
    'id' => $id,
    'name' => 'Partner 2',
    'location' => 'Brazil',
    'occupation' => 'Programmer',
    'member_since' => '1 Janary 2018',
    'total_sales' => 100, // sales quantity query
    'web_site' => 'www.example.com',
    'path_image' => '', // empty
    'number_apps_themes' => 3, // quantity of items found
    'number_badges' => 1, //not implemented
    'stars' => 1, // not implemented
    'evaluations' => 5 // not implemented
  );
}

function getImagesApp()
{
  $images = array();
  $i1 = array('id' => 1,
    'image' => 'https://lh3.googleusercontent.com/wIcl3tehFmOUpq-Jl3hlVbZVFrLHePRtIDWV5lZwBVDr7kEAgLTChyvXUclMVQDRHDEcDhY=w640-h400-e365',

  );

  $i2 = array('id' => 2,
    'image' => 'https://kaksimedia.com/kaxi/wp-content/uploads/2015/11/hacker-1024x480.jpg',
  );
  array_push($images,$i1);
  array_push($images,$i2);
  return $images;
}

function getImagesTheme()
{
  $themes = array();
  $i1 = array('id' => 1,
    'image' => 'https://kaksimedia.com/kaxi/wp-content/uploads/2015/11/hacker-1024x480.jpg',
  );
  $i2 = array('id' => 2,
    'image' => 'https://lh3.googleusercontent.com/wIcl3tehFmOUpq-Jl3hlVbZVFrLHePRtIDWV5lZwBVDr7kEAgLTChyvXUclMVQDRHDEcDhY=w640-h400-e365',
  );
  array_push($themes,$i1);
  array_push($themes,$i2);
  return $themes;
}
