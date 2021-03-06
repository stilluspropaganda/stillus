<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$nome = addslashes($_POST['nome']);
	$cargo = addslashes($_POST['cargo']);
	$ordem = addslashes($_POST['ordem']);
	
	$foto = $_FILES['foto'];
	$foto_arquivo = $foto['tmp_name'];
	$foto_nome = 'equipe_'.date('YmdHis').'_'.$sis->slug($_POST['nome']).$sis->slug($foto['name']);
	$upload = move_uploaded_file($foto_arquivo,p_UPLOADS.$foto_nome);
	if($upload){
		$campos = "
			nome='$nome',
			cargo='$cargo',
			foto='$foto_nome',
			ordem='$ordem'
		";
		$add = $sis->insert("equipe",$campos);
		if($add > 0){
			$_POST = NULL;
			
			$ok = "Cadastro concluído com sucesso.";
		}else{
			$erro = "Não foi possível realizar a conexão com o banco de dados, tente novamente em instantes.";
		}		
	}else{
		$erro = "Não foi possível enviar a imagem, tente novamente.";
	}
	
}?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Equipe <small>Contratação</small> </h3>
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
							<h4><i class="icon-reorder"></i>Registrar Jogador</h4>
						</div>
						<div class="portlet-body form"> 
							<?php if(isset($ok)){?><div class="alert alert-success"><?php echo $ok;?></div><?php }?>
							<?php if(isset($erro)){?><div class="alert alert-danger"><?php echo $erro;?></div><?php }?>
							
							<div class="span4">
								<center><h3>Exemplo</h3><br />
								<img src="<?php echo u_TEMPLATE;?>images/avatar-example.png"></center>
							</div>
							<!-- BEGIN FORM-->
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal span8" id="commentForm">
								<h2>Informações Básicas</h2>
								
								<div class="control-group">
									<label class="control-label">Nome:</label>
									<div class="controls">
										<input type="text" name="nome" value="<?php if(isset($_POST['nome'])){echo $_POST['nome'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Cargo:</label>
									<div class="controls">
										<input type="text" name="cargo" value="<?php if(isset($_POST['cargo'])){echo $_POST['cargo'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><a href="#" class="text-hint" data-toggle="tooltip" title="Define a ordem que cada um aparece no site" style="text-decoration: none; color:#000;">Ordem</a></label>
									<div class="controls">
										<input type="text" name="ordem" value="<?php if(isset($_POST['ordem'])){echo $_POST['ordem'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Arquivo a Foto:</label>
									<div class="controls">
										<input type="file" name="foto" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>						
								
								<div class="form-actions span12">
									<button type="submit" name="acao" value="cadastrar" class="btn blue pull-right">Salvar</button>
									<a href="<?php echo $sis->url_base()?>controle/equipe/listar-equipe" class="btn pull-right">Voltar</a>
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