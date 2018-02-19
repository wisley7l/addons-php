<?php
if (!empty($_POST['email'])) {
  $email = $_POST['email'];
  echo $email;

}else {
  echo "error";
}
