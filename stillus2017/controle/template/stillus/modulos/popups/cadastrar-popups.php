<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$titulo = addslashes($_POST['titulo']);
	
	$popup = $_FILES['popup'];
	$popup_arquivo = $popup['tmp_name'];
	$popup_nome = 'age_popup_'.date('YmdHis').'_'.$sis->slug($popup['name']);
	$upload = move_uploaded_file($popup_arquivo,p_UPLOADS.$popup_nome);
	if($upload){
		$campos = "
			titulo='$titulo',
			popup='$popup_nome'
		";
		$add = $sis->insert("popups",$campos);
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
				<h3 class="page-title"> popups <small>Cadastrar Nova</small> </h3>
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
							<h4><i class="icon-reorder"></i>Nova popup</h4>
						</div>
						<div class="portlet-body form"> 
							<?php if(isset($ok)){?><div class="alert alert-success"><?php echo $ok;?></div><?php }?>
							<?php if(isset($erro)){?><div class="alert alert-danger"><?php echo $erro;?></div><?php }?>
							
							<!-- BEGIN FORM-->
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="commentForm">
								<h2>Informações Básicas</h2>
								
								<div class="control-group">
									<label class="control-label">Titulo:</label>
									<div class="controls">
										<input type="text" name="titulo" value="<?php if(isset($_POST['titulo'])){echo $_POST['titulo'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Arquivo a popup:</label>
									<div class="controls">
										<input type="file" name="popup" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>						
								
								<div class="form-actions">
									<button type="submit" name="acao" value="cadastrar" class="btn blue">Salvar</button>
									<a href="<?php echo $sis->url_base()?>controle/popups/listar-popups" class="btn">Voltar</a>
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