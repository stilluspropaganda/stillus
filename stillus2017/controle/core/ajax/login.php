<?php @session_start();
require_once'../class_sistema.php';
$sis = new sistema;

if(isset($_POST['acao'])){
	$retorno = array();
	if($_POST['acao']=='entrar'){
		$email = addslashes($_POST['email']);
		$senha = md5($_POST['senha']);
		
		$select = $sis->select("users",NULL,NULL,"status='1' AND email='$email'");
		if(is_array($select) && count($select)>0){
			
			$select = $sis->select("users",NULL,NULL,"status='1' AND email='$email' AND senha='$senha'");
			
			if(is_array($select) && count($select)>0){
				$retorno['retorno']=true;
				$_SESSION['id_user'] = $select[0]['id'];
				$_SESSION['user_dados'] = $select[0];
			}else{
				$retorno['retorno'] = false;
				$retorno['msg_erro'] = "Senha não confere com o e-mail digitado.";
			}
		}else{
			$retorno['retorno'] = false;
			$retorno['msg_erro'] = "E-mail não cadastrado.";
		}		
	}
	echo json_encode($retorno);
}