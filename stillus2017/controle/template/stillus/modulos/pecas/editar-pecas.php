<?php if($url3){
	$id = (int)$url3;
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/pecas/listar-pecas";</script>';
	exit;
}?>
<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$titulo = addslashes($_POST['titulo']);
	$campos = "
		titulo='$titulo'
	";	
	$update = $sis->update("pecas",$campos,"id",$id);
	if($update){
		$_POST = NULL;
		
		$ok = "Cadastro atualizado com sucesso.";
	}else{
		$erro = "Não foi possível realizar a conexão com o banco de dados, tente novamente em instantes.";
	}	
}

$itens = $sis->select("pecas",NULL,NULL,"id='".$id."'");
if(is_array($itens) && count($itens)>0){
	$item = $itens['0'];
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/pecas/listar-pecas";</script>';
	exit;
}?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Peças <small>edição</small> </h3>
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
							<h4><i class="icon-reorder"></i>Editar Peça</h4>
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
										<input type="text" name="titulo" value="<?php if(isset($item['titulo'])){echo $item['titulo'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" name="acao" value="cadastrar" class="btn blue">Salvar</button>
									<a href="<?php echo $sis->url_base()?>controle/pecas/listar-pecas" class="btn">Voltar</a>
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