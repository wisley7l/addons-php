<?php
header('Content-Type: text/html; charset=utf-8');
echo PHP_EOL;
var_dump($_POST);
echo PHP_EOL;
var_dump($_FILES);
// check if the (id) logged is equal to or (id) sent
$id = (int) $_POST['id'];

// save profile image with user id name

// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'image' ][ 'name' ] ) && $_FILES[ 'image' ][ 'error' ] == 0 ) {
    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'image' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'image' ][ 'type' ] . ' </strong ><br />';
    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'image' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho é: <strong>' . $_FILES[ 'image' ][ 'size' ] . '</strong> Bytes<br /><br />';

    $arquivo_tmp = $_FILES[ 'image' ][ 'tmp_name' ];
    $nome = $_FILES[ 'image' ][ 'name' ];

    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );

    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    //*
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        //$novoNome = uniqid ( time () ) . '.' . $extensao;
        $novoNome = $id . '.' . $extensao;

        // Concatena a pasta com o nome
        $destino = '/home/wisley/ ' . $novoNome;
        echo PHP_EOL;
        echo $destino;
        echo PHP_EOL;
        echo substr(sprintf('%o', fileperms(Addons\PATH_DATA)), -4);
        echo PHP_EOL;
        //*
        // tenta mover o arquivo para o destino
        if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            echo ' < img src = "' . $destino . '" />';
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
            //*/
    }

    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';

}
else
    echo 'Você não enviou nenhum arquivo!';
