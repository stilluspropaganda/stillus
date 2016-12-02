<?php $select_permissoes = $sis->select("users",NULL,NULL,"id='".$_SESSION['id_user']."'");

$permissoes = $select_permissoes[0]['permissoes'];

$array_permissoes = explode(",",$permissoes);?>



<!-- BEGIN CONTAINER -->

<div class="page-container row-fluid"> 

	<!-- BEGIN SIDEBAR -->

	<div class="page-sidebar nav-collapse collapse"> 

		<!-- BEGIN SIDEBAR MENU -->

		<ul>

			<li> 

				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

				<div class="sidebar-toggler hidden-phone" style="margin-bottom:20px;"></div>

				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

			</li>

			<?php /*<li> 

				<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

				<form class="sidebar-search" action="" method="post">

					<div class="input-box"> <a href="javascript:;" class="remove"></a>

						<input type="text" placeholder="Buscar ..." />

						<input type="button" class="submit" value=" " />

					</div>

				</form>

				<!-- END RESPONSIVE QUICK SEARCH FORM --> 

			</li>*/?>

			<li class="start<?php if(!$url1){echo' active';}?>"> <a href="<?php echo $sis->url_base()?>controle"> <i class="icon-home"></i> <span class="title">Inicial</span> <span class="selected"></span> </a> </li>

			

			<?php $sModulos = $sis->select("users_modulos",NULL,NULL,"parent='0' AND exibir='1'","ordem ASC");

			if(is_array($sModulos) && count($sModulos)>0){

				foreach($sModulos as $modulo){?>

					<?php if(in_array($modulo['id'],$array_permissoes)){?>

						<li class="has-sub<?php if(isset($url1) && ($url1==$modulo['modulo'])){echo' active';}?>">

							<a href="javascript:;"> <i class="icon-bookmark-empty"></i> <span class="title"><?php echo $modulo['nome']?></span> <span class="arrow "></span> </a>

							<ul class="sub">

								<?php $sParent = $sis->select("users_modulos",NULL,NULL,"parent='".$modulo['id']."' AND exibir='1'","ordem ASC");

									if(is_array($sParent) && count($sParent)>0){

										foreach($sParent as $parent){?>

											<?php if(in_array($parent['id'],$array_permissoes)){?>

												<li<?php if(isset($url2) && ($url2==$parent['modulo'])){echo' class="active"';}?>><a href="<?php echo $sis->url_base()?>controle/<?php echo $modulo['modulo']?>/<?php echo $parent['modulo']?>"><?php echo $parent['nome']?></a></li>

											<?php }?>		

									<?php }?>			

								<?php }?>

							</ul>

						</li>

					<?php }?>

				<?php }?>			

			<?php }?>

			

			

		</ul>

		<!-- END SIDEBAR MENU --> 

	</div>

	<!-- END SIDEBAR --> 

	