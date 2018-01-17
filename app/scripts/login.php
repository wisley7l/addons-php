<?php
if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pass']))) {

    header("Location: ../index");
     exit;
 }
