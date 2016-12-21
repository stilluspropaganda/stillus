<?php if($url3){
	$id = (int)$url3;
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/campanha/listar-campanha";</script>';
	exit;
}?>
<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php

$clientes_lista = $sis->select("clientes",NULL,NULL,NULL,"nome ASC");
$tipo_peca = $sis->select("pecas",NULL,NULL,NULL,"titulo ASC");
 if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){
	 
	if(isset($_POST['img_excluir'])){
		$excluir = $_POST['img_excluir'];
		$cExc = count($excluir);
		for($i=0;$i<$cExc;$i++){
			$id_img = $excluir[$i];
			$img = $sis->select("campanha_imagens",NULL,NULL,"id='$id_img'");
			if(is_file(p_UPLOADS.$img[0]['imagem'])){
				unlink(p_UPLOADS.$img[0]['imagem']);
				$del = $sis->delete("campanha_imagens","id",$id_img);
			}
		}
	}
	 
	$cliente = addslashes($_POST['cliente']);
	$campanha = addslashes($_POST['campanha']);
	$descricao = addslashes($_POST['descricao']);
	$data = addslashes($_POST['data']);
	
	$campos = "
		cliente='$cliente',
		campanha='$campanha',
		descricao='$descricao',
		data='$data'
	";
	
	$foto = $_FILES['foto'];
	$foto_arquivo = $foto['tmp_name'];
	$foto_nome = 'campanha_'.date('YmdHis').'_'.$sis->slug($_POST['campanha']).$sis->slug($foto['name']);
	if(!empty($foto_arquivo)){
		$upload = move_uploaded_file($foto_arquivo,p_UPLOADS.$foto_nome);
		if($upload){
			unlink(p_UPLOADS.$_POST['foto_atual']);
			$campos .= ", foto='$foto_nome'";
		}
	}
	
	if(!empty($_FILES['imagens']['tmp_name'][0])){
		$arquivos = $_FILES['imagens']['tmp_name'];
		$arquivos_nome = $_FILES['imagens']['name'];
		$cImg = count($arquivos);
		for($i=0;$i<$cImg;$i++){
			$arquivo = $arquivos[$i];
			$arquivo_nome = $arquivos_nome[$i];
			$nome_imagem = "portfolio_".date('YmdHis')."_".$sis->slug($arquivo_nome);
			$upload = move_uploaded_file($arquivo,p_UPLOADS.$nome_imagem);
			if($upload){
				$campos = "
					campanha='$id',
					imagem='$nome_imagem',
					legenda=''
				";
				$add_img = $sis->insert("campanha_imagens",$campos);
			}else{
				$erro = "Erro ao enviar a imagem $arquivo_nome.";
			}
		}		
	}
	
	$update = $sis->update("campanha",$campos,"id",$id);
	
	
	if($update){
		$_POST = NULL;
		
		$ok = "Cadastro atualizado com sucesso.";
	}else{
		$erro = "Não foi possível realizar a conexão com o banco de dados, tente novamente em instantes.";
	}	
}

$itens = $sis->select("campanha",NULL,NULL,"id='".$id."'");
if(is_array($itens) && count($itens)>0){
	$item = $itens['0'];
}else{
	echo'<script>window.location.href="'.$sis->url_base().'controle/campanha/listar-campanha";</script>';
	exit;
}?>
	
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title"> Campanha <small>Editar</small> </h3>
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
							<h4><i class="icon-reorder"></i>Editar campanha</h4>
						</div>
						<div class="portlet-body form"> 
							<?php if(isset($ok)){?><div class="alert alert-success"><?php echo $ok;?></div><?php }?>
							<?php if(isset($erro)){?><div class="alert alert-danger"><?php echo $erro;?></div><?php }?>
							
							<!-- BEGIN FORM-->
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" id="commentForm">
								<h2>Informações Básicas</h2>
								<div class="control-group">
									<label class="control-label">Tipo de Campanha:</label>
									<div class="controls">
										<select name="campanha">
											<?php foreach($tipo_peca as $tipo_campanha){?>
												<option value="<?php echo $tipo_campanha['titulo']?>"
													<?php if ($item['campanha'] == $tipo_campanha['titulo']) {
														echo " selected";
													} ?>	
												><?php echo $tipo_campanha['titulo']?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Descrição:</label>
									<div class="controls">
										<input type="text" name="descricao" value="<?php if(isset($item['descricao'])){echo $item['descricao'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Cliente:</label>
									<div class="controls">
										<select name="cliente">
											<?php foreach($clientes_lista as $lista){?>
												<option value="<?php echo $lista['nome']?>"
													<?php if ($lista['nome'] == $item['cliente']) {
														echo " selected";
													} ?>	
												><?php echo $lista['nome']?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label"><a href="#" class="text-hint" data-toggle="tooltip" title="Define a ordem que cada um aparece no site" style="text-decoration: none; color:#000;">Data</a></label>
									<div class="controls">
										<input type="date" name="data" value="<?php if(isset($item['data'])){echo $item['data'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Arquivo da Foto:</label>
									<div class="controls">

									<label class="text-info">500x333pixels</label>
                                                <img src="<?php echo u_UPLOADS.$item['foto'];?>" style="max-width:50%;">
											<br />
										<input type="hidden" name="foto_atual" value="<?php echo $item['foto']?>" />
										Trocar Foto: <input type="file" name="foto" class="span6 m-wrap" />
									</div>
								</div>	
								
								
			
								<div class="form-group">
									<label for="imagens" class="col-sm-2 control-label">Mais imagens:</label>
									<div class="col-sm-9">
										<input name="imagens[]" multiple type="file" class="form-control" id="imagens">
									</div>
								</div>
								
								
								
								<?php $images = $sis->select("campanha_imagens",NULL,NULL,"campanha='".$item['id']."'");
								if(!empty($images)){?>
									<div class="row">
										<?php foreach($images as $imagem){?>
											<div class="col-sm-2" style="float:left;">
												<img src="<?php echo $sis->url_base()?>timthumb.php?src=<?php echo u_UPLOADS.$imagem['imagem'];?>&amp;w=150&amp;h=150" alt="" class="img-responsive" /><label><input type="checkbox" name="img_excluir[]" value="<?php echo $imagem['id']?>" /> Excluir</label>
											</div>
										<?php }?>
									</div>
								<?php }?>
								
														
								
								<div class="form-actions">
									<button type="submit" name="acao" value="cadastrar" class="btn blue">Salvar</button>
									<a href="<?php echo $sis->url_base()?>controle/campanha/listar-campanha" class="btn">Voltar</a>
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