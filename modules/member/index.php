<?php 
// var_dump($Member->isLogged());
// var_dump($_POST);
if( $Member->isLogged()  ):
    require_once "profile/index.php";
else:
   require_once "login.php";
endif;
?>