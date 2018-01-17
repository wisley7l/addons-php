<?php
if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pass']))) {

    echo "<script>alert('Email enviado com Sucesso!');</script>";
    header("Location: ../index");
     exit;
 }
