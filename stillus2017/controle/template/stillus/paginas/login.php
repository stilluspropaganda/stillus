<?php @session_start();
require_once'core/class_sistema.php';
$sis = new sistema;
if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])){
	@header('Location:'.$sis->url_base().'controle/');
	exit;
}
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title><?php echo $sis->_PROJETO_TITULO?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="<?php echo $sis->_PROJETO_DESCRICAO?>" name="description" />
<meta content="<?php echo $sis->_PROJETO_AUTHOR?>" name="author" />
<meta content="<?php echo $sis->_PROJETO_KEYWORDS?>" name="keywords" />
<link rel="shortcut icon" href="<?php echo u_TEMPLATE;?>favicon.ico" />
<link href="<?php echo u_TEMPLATE;?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo u_TEMPLATE;?>assets/css/metro.css" rel="stylesheet" />
<link href="<?php echo u_TEMPLATE;?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="<?php echo u_TEMPLATE;?>assets/css/style.css" rel="stylesheet" />
<link href="<?php echo u_TEMPLATE;?>assets/css/style_responsive.css" rel="stylesheet" />
<link href="<?php echo u_TEMPLATE;?>assets/css/style_default.css" rel="stylesheet" id="style_color" />
<link href="<?php echo u_TEMPLATE;?>assets/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo"> <img src="<?php echo u_TEMPLATE;?>images/logo-stillus-preto.png" width="200" alt="" /> </div>
<!-- END LOGO --> 
<!-- BEGIN LOGIN -->
<div class="content"> 
	<!-- BEGIN LOGIN FORM -->
	<form class="form-vertical login-form" action="">
		<h3 class="form-title">Área Administrativa</h3>
		<div class="alert alert-error hide" id="erro_login">
			<button class="close" data-dismiss="alert"></button>
			<span id="erro_login_msg">Entre com seu e-mail e senha.</span> </div>
		<div class="control-group"> 
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">E-mail</label>
			<div class="controls">
				<div class="input-icon left"> <i class="icon-user"></i>
					<input class="m-wrap placeholder-no-fix" type="text" placeholder="E-mail" name="email" id="login_email" />
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label visible-ie8 visible-ie9">Senha</label>
			<div class="controls">
				<div class="input-icon left"> <i class="icon-lock"></i>
					<input class="m-wrap placeholder-no-fix" type="password" placeholder="Senha" name="senha" id="login_senha" />
				</div>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/>
				Lembrar-me </label>
			<button type="button" id="bt_entrar" class="btn green pull-right"> Entrar <i class="m-icon-swapright m-icon-white"></i> </button>
		</div>
		<div class="forget-password">
			<h4>Esqueceu sua senha ?</h4>
			<p> Clique <a href="javascript:;" class="" id="forget-password">aqui</a> e solicite-nos uma nova. </p>
		</div>
	</form>
	<!-- END LOGIN FORM --> 
	
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="form-vertical forget-form" action="" method="post">
		<h3 class="">Esqueceu sua senha ?</h3>
		<p>Entre com seu e-mail de cadastro que enviaremos outra.</p>
		<div class="control-group">
			<div class="controls">
				<div class="input-icon left"> <i class="icon-envelope"></i>
					<input class="m-wrap placeholder-no-fix" type="text" placeholder="E-mail" name="email" />
				</div>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn"> <i class="m-icon-swapleft"></i> Voltar </button>
			<button type="submit" class="btn green pull-right"> Enviar <i class="m-icon-swapright m-icon-white"></i> </button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM --> 
	
	<!-- BEGIN REGISTRATION FORM -->
	<form class="form-vertical register-form" action="">
		<h3 class="">Cadastro</h3>
		<p>Preecha os campos abaixo:</p>
		<div class="control-group">
			<label class="control-label visible-ie8 visible-ie9">E-mail</label>
			<div class="controls">
				<div class="input-icon left"> <i class="icon-user"></i>
					<input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="username"/>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label visible-ie8 visible-ie9">Senha</label>
			<div class="controls">
				<div class="input-icon left"> <i class="icon-lock"></i>
					<input class="m-wrap placeholder-no-fix" type="password" id="register_password" placeholder="Password" name="password"/>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label visible-ie8 visible-ie9">Confirme a Senha</label>
			<div class="controls">
				<div class="input-icon left"> <i class="icon-ok"></i>
					<input class="m-wrap placeholder-no-fix" type="password" placeholder="Re-type Your Password" name="rpassword"/>
				</div>
			</div>
		</div>
		<div class="control-group"> 
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Nome Completo</label>
			<div class="controls">
				<div class="input-icon left"> <i class="icon-envelope"></i>
					<input class="m-wrap placeholder-no-fix" type="text" placeholder="Nome Completo" name="email"/>
				</div>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="tnc"/>
					Aceito os <a href="#">termos de serviço</a> e <a href="#">política de privacidade</a>. </label>
				<div id="register_tnc_error"></div>
			</div>
		</div>
		<div class="form-actions">
			<button id="register-back-btn" type="button" class="btn"> <i class="m-icon-swapleft"></i> Voltar </button>
			<button type="submit" id="register-submit-btn" class="btn green pull-right"> Enviar <i class="m-icon-swapright m-icon-white"></i> </button>
		</div>
	</form>
	<!-- END REGISTRATION FORM --> 
</div>
<!-- END LOGIN --> 
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> <?php echo date('Y')?> &copy; Stillus Propaganda.<br></div>
<!-- END COPYRIGHT --> 
<!-- BEGIN JAVASCRIPTS --> 
<script src="<?php echo u_TEMPLATE;?>assets/js/jquery-1.8.3.min.js"></script> 
<script src="<?php echo u_TEMPLATE;?>assets/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?php echo u_TEMPLATE;?>assets/uniform/jquery.uniform.min.js"></script> 
<script src="<?php echo u_TEMPLATE;?>assets/js/jquery.blockui.js"></script> 
<script src="<?php echo u_TEMPLATE;?>assets/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script> 

<script>
	$("#forget-password").click(function(){
		$("form").css("display","none");
		$(".forget-form").css("display","block");
	});
	$("#register-btn").click(function(){
		$("form").css("display","none");
		$(".register-form").css("display","block");
	});
	$("#back-btn, #register-back-btn").click(function(){
		$("form").css("display","none");
		$(".login-form").css("display","block");
	});
	
	$("#bt_entrar").click(function(){
		$("#erro_login").hide();
		var email = $("#login_email").val();
		var senha = $("#login_senha").val();
		
		if(email=='' || senha==''){
			$("#erro_login").show();
		}else{
			$.post('<?php echo $sis->url_base().'controle/core/ajax/login.php'?>',{acao:'entrar',email:email, senha:senha},function(retorno){
				complete: if(retorno.retorno == true){
					window.location.href="<?php echo $sis->url_base();?>controle/";
				}else{
					$("#erro_login_msg").html(retorno.msg_erro);
					$("#erro_login").show();
				}
			},'JSON');
		}
	});
</script> 
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>