<?php if($url3){
	$id = (int)$url3;
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/popups/listar-popups";</script>';
	exit;
}?>
<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$titulo = addslashes($_POST['titulo']);
	
	$campos = "
		titulo='$titulo'
	";
	
	$popup = $_FILES['popup'];
	$popup_arquivo = $popup['tmp_name'];
	$popup_nome = 'age_popup_'.date('YmdHis').'_'.$sis->slug($popup['name']);
	if(!empty($popup_arquivo)){
		$upload = move_uploaded_file($popup_arquivo,p_UPLOADS.$popup_nome);
		if($upload){
			unlink(p_UPLOADS.$_POST['popup_atual']);
			$campos .= ", popup='$popup_nome'";
		}
	}
	
	$update = $sis->update("popups",$campos,"id",$id);
	if($update){
		$_POST = NULL;
		
		$ok = "Cadastro atualizado com sucesso.";
	}else{
		$erro = "Não foi possível realizar a conexão com o banco de dados, tente novamente em instantes.";
	}	
}

$itens = $sis->select("popups",NULL,NULL,"id='".$id."'");
if(is_array($itens) && count($itens)>0){
	$item = $itens['0'];
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/popups/listar-popups";</script>';
	exit;
}?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> popups <small>Editar</small> </h3>
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
							<h4><i class="icon-reorder"></i>Editar popup</h4>
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
									<label class="control-label">Arquivo da popup:</label>
									<div class="controls">

                                                <img src="<?php echo u_UPLOADS.'/'.$item['popup'];?>">
											<br />
										<input type="hidden" name="popup_atual" value="<?php echo $item['popup']?>" />
										Trocar popup: <input type="file" name="popup" class="span6 m-wrap" />
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