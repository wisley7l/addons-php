<?php
if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pass']))) {

    header("location:javascript:alert(\"Email enviado com Sucesso!\");location.href=\"../index.php\";");
    // header("Location: ../index");
     exit;
 }
