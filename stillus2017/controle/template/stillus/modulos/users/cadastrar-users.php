<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$status = $_POST['status'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$senha_md5 = md5($senha);
	
	if(isset($_POST['modulo'])){
		$modulo = "";
		$modulos = $_POST['modulo'];
		$cModulos = count($modulos);
		for($i=0;$i<$cModulos;$i++){
			$modulo .= $modulos[$i].',';
		}
		$modulo = substr($modulo,0,-1);
	}else{
		$modulo = "";
	}
	
	$check_email = $sis->select("users","email",NULL,"email='$email'",NULL,NULL);
	if(is_array($check_email) && count($check_email) > 0){
		$erro = "Este e-mail já está cadastrado, tente outro.";
	}else{
		$campos = "
			status = '$status',
			permissoes = '$modulo',
			nome = '$nome',
			email = '$email',
			senha = '$senha_md5'
		";
		$qry = $sis->insert("users",$campos);
		
		if($qry > 0){
			$ok = "Cadastro concluído com sucesso.";
			unset($_POST);
		}else{
			$erro = "Não foi possível cadastrar, verifique as informações e tente novamente.";
		}
	}
}

?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Utilizadores <small>Cadastrar Novo</small> </h3>
				<ul class="breadcrumb">
					<li> <i class="icon-home"></i> <a href="<?php echo $sis->url_base()?>">Home</a> </li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB--> 
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<div id="dashboard">
			<div class="row-fluid">
				<div class="span12"> 
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<h4><i class="icon-reorder"></i>Novo Utilizador</h4>
						</div>
						<div class="portlet-body form"> 
							<?php if(isset($ok)){?><div class="alert alert-success"><?php echo $ok;?></div><?php }?>
							<?php if(isset($erro)){?><div class="alert alert-danger"><?php echo $erro;?></div><?php }?>
							
							<!-- BEGIN FORM-->
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="commentForm">
								<h2>Informações Básicas</h2>
								<div class="control-group">
									<label class="control-label">Status</label>
									<div class="controls">
										<select name="status" lass="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório.">
											<option value="1"<?php if(isset($_POST['status']) && $_POST['status']=='1'){echo ' selected="selected"';}?>>Ativo</option>
											<option value="0"<?php if(isset($_POST['status']) && $_POST['status']=='0'){echo ' selected="selected"';}?>>Inativo</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nome:</label>
									<div class="controls">
										<input type="text" name="nome" value="<?php if(isset($_POST['nome'])){echo $_POST['nome'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">E-mail:</label>
									<div class="controls">
										<input type="text" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Senha:</label>
									<div class="controls">
										<input type="text" name="senha" value="<?php if(isset($_POST['senha'])){echo $_POST['senha'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Permissões:</label>
									<div class="controls">
										<?php $qry = $sis->select("users_modulos",NULL,NULL,"parent='0'","ordem ASC",NULL);
										$conta_qry = count($qry);
										if(is_array($qry) && ($conta_qry > 0)){?>
											<div class="span6">
												<?php foreach($qry as $modulos){?>
													<div style="padding-bottom:20px; display:block">
														<input type="checkbox" name="modulo[]" id="modulo<?php echo $modulos['id']?>" value="<?php echo $modulos['id']?>">
														<label style="display:inline-block;" for="modulo<?php echo $modulos['id']?>"><?php echo $modulos['nome']?></label><br />
														<?php $qry_parent = $sis->select("users_modulos", NULL, NULL, "parent='".$modulos['id']."'", "ordem ASC", NULL);
														if(is_array($qry_parent) && (count($qry_parent) > 0)){
															foreach($qry_parent as $parent){?>
																<input type="checkbox" name="modulo[]" id="modulo<?php echo $parent['id']?>" value="<?php echo $parent['id']?>">
																<label style="display:inline-block;" for="modulo<?php echo $parent['id']?>"><?php echo $modulos['nome']?> - <?php echo $parent['nome']?></label><br />
															<?php }
														}?>
													</div>
												<?php }?>
											</div>
										<?php }?>
									</div>
								</div>						
								
								<div class="form-actions">
									<button type="submit" name="acao" value="cadastrar" class="btn blue">Salvar</button>
									<a href="<?php echo $sis->url_base()?>controle/produtos/listar-produtos" class="btn">Voltar</a>
								</div>
							</form>
							<!-- END FORM--> 
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET--> 
				</div>
			</div>
			<!--row-fluid-->
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- END PAGE CONTAINER--> 
</div>
<!-- END PAGE -->