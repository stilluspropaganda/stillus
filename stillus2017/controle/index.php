<?php @session_start();
set_time_limit(0);

require_once'core/class_sistema.php';
$sis = new sistema;
include'core/paths.php';

$paginas_sistema = array('sair','recuperar-senha','login');
$paginas_sistema_base = array('home','detalhes');

$s_paginas_modulos = $sis->select("users_modulos","modulo",NULL,"parent='0'");
$paginas_modulos = array();
foreach($s_paginas_modulos as $p_m){
	$paginas_modulos[] = $p_m['modulo'];
}

if(isset($_GET['url1'])){ $url1 = addslashes($_GET['url1']); }else{ $url1 = false; }
if(isset($_GET['url2'])){ $url2 = addslashes($_GET['url2']); }else{ $url2 = false; }
if(isset($_GET['url3'])){ $url3 = addslashes($_GET['url3']); }else{ $url3 = false; }
if(isset($_GET['url4'])){ $url4 = addslashes($_GET['url4']); }else{ $url4 = false; }

if($url2 && (in_array($url1,$paginas_modulos)) && (is_dir(p_TEMPLATE.'modulos/'.$url1)) && is_file(p_TEMPLATE.'modulos/'.$url1.'/'.$url2.'.php')){
	include(p_TEMPLATE.'bases/base_top.php');
	include(p_TEMPLATE.'modulos/'.$url1.'/'.$url2.'.php');
	include(p_TEMPLATE.'bases/base_bottom.php');
}elseif($url1){
	if(in_array($url1,$paginas_sistema)){
		include(p_TEMPLATE.'paginas/'.$url1.'.php');	

	}else{
		include(p_TEMPLATE.'bases/base_top.php');
		if(in_array($url1,$paginas_sistema_base)){
			include(p_TEMPLATE.'paginas/'.$url1.'.php');
		}else{
			include(p_TEMPLATE.'paginas/404.php');
		}
		include(p_TEMPLATE.'bases/base_bottom.php');
	}
}else{
	include(p_TEMPLATE.'bases/base_top.php');
	include(p_TEMPLATE.'paginas/home.php');
	include(p_TEMPLATE.'bases/base_bottom.php');
}
?>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>