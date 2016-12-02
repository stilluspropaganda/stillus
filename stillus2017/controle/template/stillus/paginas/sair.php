<?php 
unset($_SESSION['id_user']);
unset($_SESSION['user_dados']);
header('Location:'.$sis->url_base());
?>