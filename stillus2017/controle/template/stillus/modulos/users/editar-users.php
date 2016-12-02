<?php if($url3){
	$id = (int)$url3;
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/users/listar-users";</script>';
	exit;
}?>
<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$status = $_POST['status'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	
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
	
	$campos = "
		status = '$status',
		permissoes = '$modulo',
		nome = '$nome',
		email = '$email'
	";
	
	if(!empty($senha)){
		$senha_md5 = md5($senha);
		$campos .= ", senha = '$senha_md5'";
	}
	
	$qry = $sis->update("users",$campos,"id",$id);
	if($qry){
		$ok = "Cadastro atualizado com sucesso.";
	}else{
		$erro = "Não foi possível atualizar, verifique as informações e tente novamente.";
	}
}

$itens = $sis->select("users",NULL,NULL,"id='".$id."'");
if(is_array($itens) && count($itens)>0){
	$item = $itens['0'];
	$permissoes = $item['permissoes'];
	$array_permissoes = explode(",",$permissoes);
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/users/listar-users";</script>';
	exit;
}?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Utilizadores <small>Editar Utilizador</small> </h3>
				<ul class="breadcrumb">
					<li> <i class="icon-home"></i> <a href="<?php echo $sis->url_base()?>controle">Home</a> </li>
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
							<h4><i class="icon-reorder"></i>Editar Utilizador</h4>
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
											<option value="1"<?php if(isset($item['status']) && $item['status']=='1'){echo ' selected="selected"';}?>>Ativo</option>
											<option value="0"<?php if(isset($item['status']) && $item['status']=='0'){echo ' selected="selected"';}?>>Inativo</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nome:</label>
									<div class="controls">
										<input type="text" name="nome" value="<?php if(isset($item['nome'])){echo $item['nome'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">E-mail:</label>
									<div class="controls">
										<input type="text" name="email" value="<?php if(isset($item['email'])){echo $item['email'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Senha:</label>
									<div class="controls">
										<input type="text" name="senha" maxlength="100" class="span6 m-wrap" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Permissões:</label>
									<div class="controls">
										<?php $qry = $sis->select("users_modulos",NULL,NULL,"parent='0'","ordem ASC",NULL);
										$conta_qry = count($qry);
										if($qry && ($conta_qry > 0)){?>
											<div class="col-sm-6">
												<?php foreach($qry as $modulos){?>
													<div style="padding-bottom:20px; display:block">
														<input type="checkbox" name="modulo[]" id="modulo<?php echo $modulos['id']?>" value="<?php echo $modulos['id']?>"<?php if(in_array($modulos['id'],$array_permissoes)){echo' checked="checked"';}?>>
														<label style="display:inline-block;" for="modulo<?php echo $modulos['id']?>"><?php echo $modulos['nome']?></label><br />
														<?php $qry_parent = $sis->select("users_modulos",NULL,NULL,"parent='".$modulos['id']."'","ordem ASC",NULL);;
														if(is_array($qry_parent) && (count($qry_parent) > 0)){
															foreach($qry_parent as $parent){?>
																<input type="checkbox" name="modulo[]" id="modulo<?php echo $parent['id']?>" value="<?php echo $parent['id']?>"<?php if(in_array($parent['id'],$array_permissoes)){echo' checked="checked"';}?>>
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
									<a href="<?php echo $sis->url_base()?>controle/users/listar-users" class="btn">Voltar</a>
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