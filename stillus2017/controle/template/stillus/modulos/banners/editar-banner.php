<?php if($url3){
	$id = (int)$url3;
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/banners/listar-banner";</script>';
	exit;
}?>
<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$titulo = addslashes($_POST['titulo']);
	$descricao = addslashes($_POST['descricao']);
	$ordem = addslashes($_POST['ordem']);
	
	$campos = "
		titulo='$titulo',
		descricao='$descricao',
		ordem='$ordem'
	";
	
	$foto = $_FILES['foto'];
	$foto_arquivo = $foto['tmp_name'];
	$foto_titulo = 'banner_'.date('YmdHis').'_'.$sis->slug($titulo).'_'.$sis->slug($foto['name']);
	if(!empty($foto_arquivo)){
		$upload = move_uploaded_file($foto_arquivo,p_UPLOADS.$foto_titulo);
		if($upload){
			unlink(p_UPLOADS.$_POST['foto_atual']);
			$campos .= ", foto='$foto_titulo'";
		}
	}
	
	$update = $sis->update("banners",$campos,"id",$id);
	if($update){
		$_POST = NULL;
		
		$ok = "Cadastro atualizado com sucesso.";
	}else{
		$erro = "Não foi possível realizar a conexão com o banco de dados, tente novamente em instantes.";
	}	
}

$itens = $sis->select("banners",NULL,NULL,"id='".$id."'");
if(is_array($itens) && count($itens)>0){
	$item = $itens['0'];
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/banners/listar-banner";</script>';
	exit;
}?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Banner <small>edição</small> </h3>
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
							<h4><i class="icon-reorder"></i>Editar Banner</h4>
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
								<div class="control-group">
									<label class="control-label">Descrição:</label>
									<div class="controls">
										<input type="text" name="descricao" value="<?php if(isset($item['descricao'])){echo $item['descricao'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><a href="#" class="text-hint" data-toggle="tooltip" title="Define a ordem que cada um aparece no site" style="text-decoration: none; color:#000;">Ordem</a></label>
									<div class="controls">
										<input type="text" name="ordem" value="<?php if(isset($item['ordem'])){echo $item['ordem'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Arquivo da Foto:</label>
									<div class="controls">

                                                <img src="<?php echo u_UPLOADS.'/'.$item['foto'];?>" style="max-width:50%;">
											<br />
										<input type="hidden" name="foto_atual" value="<?php echo $item['foto']?>" />
										Trocar Foto: <input type="file" name="foto" class="span6 m-wrap" />
									</div>
								</div>							
								
								<div class="form-actions">
									<button type="submit" name="acao" value="cadastrar" class="btn blue">Salvar</button>
									<a href="<?php echo $sis->url_base()?>controle/banners/listar-banner" class="btn">Voltar</a>
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
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>