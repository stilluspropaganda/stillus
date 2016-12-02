<?php if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])){
	if(isset($_POST['acao']) && $_POST['acao']=='excluir'){
		$excluir = $_POST['excluir'];
		foreach($excluir as $x){
			$imgs = $sis->select("equipe",NULL,NULL,"id='$x'");
			foreach($imgs as $img){
				unlink(p_UPLOADS.$img['foto']);
			}
			$del_item = $sis->delete("equipe","id",$x);
		}
	}

	$itens = $sis->select("equipe",NULL,NULL,NULL,"ordem ASC");
}else{
	exit;
}?>
<!-- BEGIN PAGE -->
<div class="page-content"> 
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid"> 
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12"> 
				
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">Equipe <small>Escalação</small> </h3>
				<ul class="breadcrumb">
					<li> <i class="icon-home"></i> <a href="<?php echo $sis->url_base();?>">Home</a> <i class="icon-angle-right"></i> </li>
					<li><a href="#">foto</a></li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB--> 
			</div>
		</div>
		<!-- END PAGE HEADER--> 
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12"> 
				<!-- BEGIN SAMPLE TABLE PORTLET-->
				<div class="portlet box purple">
					<div class="portlet-title">
						<h4><i class="icon-list"></i>Escalação</h4>
					</div>
					<div class="portlet-body">
						<?php if(is_array($itens) && (count($itens)>0)){?>
							<form action="" method="post">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th width="5%"></th>
											<th width="10%">Camisa</th>
											<th width="15%">Miniatura</th>
											<th width="30%">Nome</th>
											<th width="30%">Posição</th>
											<th width="10%">Negociar</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($itens as $item){?>
											<tr>
												<td><input type="checkbox" name="excluir[]" value="<?php echo $item['id']?>" /></td>
												<td><?php echo $item['ordem']?></td>
												<td><img src="<?php echo u_UPLOADS.'/'.$item['foto'];?>" style="max-width:30%;"></td>
												<td><?php echo $item['nome']?></td>
												<td><?php echo $item['cargo']?></td>
												<td><a href="<?php echo $sis->url_base()?>controle/equipe/editar-equipe/<?php echo $item['id']?>" class="btn">Editar</a></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
								<p><button type="submit" name="acao" value="excluir" class="btn" style="background:#F00; color:#FFF;">Excluir Selecionados</button></p>
							</form>
						<?php }else{?>
							<p>Nenhum ítem cadastrado.</p>
						<?php }?>
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET--> 
			</div>
		</div>
		<!-- END PAGE CONTENT--> 
	</div>
	<!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->