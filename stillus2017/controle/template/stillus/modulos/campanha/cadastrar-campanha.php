<!-- BEGIN PAGE -->
<div class="page-content"> 

<?php
$clientes_lista = $sis->select("clientes",NULL,NULL,NULL,"nome ASC");
$tipo_peca = $sis->select("pecas",NULL,NULL,NULL,"titulo ASC");

 if(isset($_POST['acao']) && $_POST['acao']=='cadastrar'){

	


	$cliente = addslashes($_POST['cliente']);
	$campanha = addslashes($_POST['campanha']);
	$descricao = addslashes($_POST['descricao']);
	$data = addslashes($_POST['data']);
	
	$foto = $_FILES['foto'];
	$foto_arquivo = $foto['tmp_name'];
	$foto_nome = 'campanha_'.date('YmdHis').'_'.$sis->slug($_POST['cliente']).$sis->slug($_POST['campanha']).$sis->slug($foto['name']);
	$upload = move_uploaded_file($foto_arquivo,p_UPLOADS.$foto_nome);
	if($upload){
		$campos = "
			cliente='$cliente',
			campanha='$campanha',
			descricao='$descricao',
			data='$data',
			foto='$foto_nome'
		";
		$add = $sis->insert("campanha",$campos);
		if($add > 0){
			
			if(!empty($_FILES['imagens']['tmp_name'][0])){
				$arquivos = $_FILES['imagens']['tmp_name'];
				$arquivos_nomes = $_FILES['imagens']['name'];
				$cImg = count($arquivos);
				for($i=0;$i<$cImg;$i++){
					$arquivo = $arquivos[$i];
					$arquivo_nome = $arquivos_nomes[$i];
					$nome_imagem = "portfolio_".date('YmdHis')."_".$sis->slug($arquivo_nome);
					if($i=='0'){
						$img_destaque = $nome_imagem;
					}
					$upload = move_uploaded_file($arquivo,p_UPLOADS.$nome_imagem);
					if($upload){
						$campos = "
							campanha='$add',
							imagem='$nome_imagem',
							legenda='$campanha'
						";
						$add_img = $sis->insert("campanha_imagens",$campos);
					}else{
						$erro = "Erro ao enviar a imagem $arquivo_nome.";
					}
				}
			}
			
			
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
				<h3 class="page-title"> Portfolio <small>Campanha</small> </h3>
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
							<h4><i class="icon-reorder"></i>Cadastrar Campanha</h4>
						</div>
						<div class="portlet-body form"> 
							<?php if(isset($ok)){?><div class="alert alert-success"><?php echo $ok;?></div><?php }?>
							<?php if(isset($erro)){?><div class="alert alert-danger"><?php echo $erro;?></div><?php }?>
							<!-- BEGIN FORM-->
							<form action="" method="post" enctype="multipart/form-data" class="form-horizontal span8" id="commentForm">
								<h2>Informações Básicas</h2>
								
								<div class="control-group">
									<label class="control-label">Cliente:</label>
									<div class="controls">
										<select name="cliente">
											<?php foreach($clientes_lista as $lista){?>
												<option value="<?php echo $lista['nome']?>"><?php echo $lista['nome']?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tipo Campanha:</label>
									<div class="controls">
										<select name="campanha">
											<?php foreach($tipo_peca as $tipo_campanha){?>
												<option value="<?php echo $tipo_campanha['titulo']?>"><?php echo $tipo_campanha['titulo']?></option>
											<?php }?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Descrição:</label>
									<div class="controls">
										<input type="text" name="descricao" value="<?php if(isset($_POST['descricao'])){echo $_POST['cargo'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Data</label>
									<div class="controls">
										<input type="date" name="data" value="<?php if(isset($_POST['data'])){echo $_POST['data'];}?>" maxlength="100" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Arquivo a Foto:</label>
									<div class="controls">
										<label class="text-info">500x333pixels</label><input type="file" name="foto" class="span6 m-wrap" data-rule-required="true"  data-msg-required="Campo obrigatório." />
									</div>
								</div>	
								
								<hr />
								
								<div class="control-group">
									<label class="control-label">Mais imagens:</label>
									<div class="controls">
										<label class="text-info"></label><input type="file" name="imagens[]" multiple="multiple" class="span6 m-wrap" />
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