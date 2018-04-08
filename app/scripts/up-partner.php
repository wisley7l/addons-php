<?php

// function upload partner //
//*
// create connection to the database
$conn = connect_db();
//*/

//header('Content-Type: text/html; charset=utf-8');
echo PHP_EOL;
//var_dump($_POST);
echo PHP_EOL;
//var_dump($_FILES); // send image profile
// check if the (id) logged is equal to or (id) sent
$id = (int) $_POST['id'];
$conn = connect_db();

// save profile image with user id name
if (empty($_POST) AND $_FILES[ 'arquivo' ][ 'size' ] == 0) {
  //header("Location: ../index");
  //exit;
}else { // if exists POST
  if (!empty($_POST['pass'])) {
    $pass_hash = $_POST['pass'];
    // echo $pass_hash;
    $pass = password_hash($pass_hash, PASSWORD_DEFAULT);
    echo $pass;
    // escape id and password
    // TODO: insert table partner, escape id and pass
    /*

    // query without changing password
    //$query = "UPDATE `partners` SET `password_hash` = $pass_hash  WHERE `id`= $id";
    if (mysqli_query(  $conn, $query )) {
     // message sucess
   }
   else {
     # error
   }
    //*/
  }
  if (!empty($_FILES)) {
    // verifica se foi enviado um arquivo
    if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
        echo 'Você enviou o arquivo:'. $_FILES[ 'arquivo' ][ 'name' ] ;
        echo PHP_EOL;
        echo 'Este arquivo é do tipo: ' . $_FILES[ 'arquivo' ][ 'type' ] ;
        echo PHP_EOL;
        echo 'Temporáriamente foi salvo em: ' . $_FILES[ 'arquivo' ][ 'tmp_name' ] ;
        echo PHP_EOL;
        echo 'Seu tamanho é: ' . $_FILES[ 'arquivo' ][ 'size' ] ;
        echo PHP_EOL;

        $file_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
        $name = $_FILES[ 'arquivo' ][ 'name' ];
        $length = $_FILES[ 'arquivo' ][ 'size' ];

        // Pega a extensão
        $extension = pathinfo ( $name, PATHINFO_EXTENSION );

        // Converte a extensão para minúsculo
        $extension = strtolower ( $extension );

        // Somente imagens, .jpg;.jpeg;.gif;.png
        // Aqui eu enfileiro as extensões permitidas e separo por ';'
        // Isso serve apenas para eu poder pesquisar dentro desta String
        if ( strstr ( '.jpg;.jpeg;.gif;.png', $extension ) AND $length <= 1960000 ) {
            // Cria um nome único para esta imagem
            // Evita que duplique as imagens no servidor.
            // Evita nomes com acentos, espaços e caracteres não alfanuméricos
            $new_name = 'profile_'. $id . '.' . $extension;

            // Concatena a pasta com o nome
            $dist = Addons\PATH_DATA . '/images/profile/' . $new_name;
            echo $dist;

            // tenta mover o arquivo para o destino
            if ( @move_uploaded_file ( $file_tmp, $dist ) ) {

                // TODO: insert table partner, escape id and pass
                //*

                // query without changing password
                $query = "UPDATE partners SET path_image = '$dist'  WHERE id = $id;";

                if (mysqli_query(  $conn, $query )) {
                 echo "Sucess ";
                 $_SESSION['path_image'] = $dist;
                 echo $_SESSION['path_image'];
                 // redirect dashboard
               }
               else {
                 // remove image
                 echo 'remove image';
               }
                //*/

            }
            else
                echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
        }
        else
            echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
    }
    else
        echo 'Você não enviou nenhum arquivo!';
  }
}
