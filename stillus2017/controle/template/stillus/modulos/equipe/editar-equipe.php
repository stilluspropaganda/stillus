<?php if($url3){
	$id = (int)$url3;
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/equipe/listar-equipe";</script>';
	exit;
}?>
<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	$nome = addslashes($_POST['nome']);
	$cargo = addslashes($_POST['cargo']);
	$ordem = addslashes($_POST['ordem']);
	
	$campos = "
		nome='$nome',
		cargo='$cargo',
		ordem='$ordem'
	";
	
	$foto = $_FILES['foto'];
	$foto_arquivo = $foto['tmp_name'];
	$foto_nome = 'equipe_'.date('YmdHis').'_'.$sis->slug($_POST['nome']).$sis->slug($foto['name']);
	if(!empty($foto_arquivo)){
		$upload = move_uploaded_file($foto_arquivo,p_UPLOADS.$foto_nome);
		if($upload){
			unlink(p_UPLOADS.$_POST['foto_atual']);
			$campos .= ", foto='$foto_nome'";
		}
	}
	
	$update = $sis->update("equipe",$campos,"id",$id);
	if($update){
		$_POST = NULL;
		
		$ok = "Cadastro atualizado com sucesso.";
	}else{
		$erro = "Não foi possível realizar a conexão com o banco de dados, tente novamente em instantes.";
	}	
}

$itens = $sis->select("equipe",NULL,NULL,"id='".$id."'");
if(is_array($itens) && count($itens)>0){
	$item = $itens['0'];
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/equipe/listar-equipe";</script>';
	exit;
}?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Equipe <small>Editar</small> </h3>
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
							<h4><i class="icon-reorder"></i>Editar Jogador</h4>
						</div>
						<div class="portlet-body form"> 
							<?php if(isset($ok)){?><div class="alert alert-success"><?php echo $ok;?></div><?php }?>
							<?php if(isset($erro)){?><div class="alert alert-danger"><?php echo $erro;?></div><?php }?>
							
							<!-- BEGIN FORM-->
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="commentForm">
								<h2>Informações Básicas</h2>
								<div class="control-group">
									<label class="control-label">Nome:</label>
									<div class="controls">
										<input type="text" name="nome" value="<?php if(isset($item['nome'])){echo $item['nome'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Cargo:</label>
									<div class="controls">
										<input type="text" name="cargo" value="<?php if(isset($item['cargo'])){echo $item['cargo'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><a href="#" class="text-hint" data-toggle="tooltip" title="Define a ordem que cada um aparece no site" style="text-decoration: none; color:#000;">Camisa nº</a></label>
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
									<a href="<?php echo $sis->url_base()?>controle/equipe/listar-equipe" class="btn">Voltar</a>
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