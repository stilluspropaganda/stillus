<?php if(!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])){
	@header('Location:'.$sis->url_base().'controle/login');
	exit;
}
include(p_TEMPLATE.'bases/head.php');
include(p_TEMPLATE.'bases/css.php');
include(p_TEMPLATE.'bases/js_head.php');
include(p_TEMPLATE.'bases/header.php');
include(p_TEMPLATE.'bases/menu_lateral.php');
?>