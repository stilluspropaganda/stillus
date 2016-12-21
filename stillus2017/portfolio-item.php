<!DOCTYPE html>
<html lang="pt-br">
<?php include("inc/head.php");?>
<?php $id_campanha = (int)$_GET['campanha'];

$campanhas = $sis->select("campanha",NULL,NULL,"id='$id_campanha'");
$campanha = $campanhas[0];



?>

<body data-spy="scroll">
    <!-- Preloader -->
    <div id="preloader">
        <div id="status"></div>
    </div>	
    <div id="main-wrapper">
        <?php include("inc/menu.php");?>
        
        <div id="container">

            <!-- BEGIN BLOG -->
            <section id="blog" class="blog">
                <div class="row">
                    <div class="col-md-9">
                        <div id="primary" class="row">
                            <div class="col-md-12">
                                <!-- BEGIN ARTICLE -->
                                <article class="post">
                                    <div class="post-thumb">
                                        <img class="thumbnail" src="uploads/<?php echo $campanha['foto'] ?>" alt="Blog Post 1" />
                                    </div>
                                </article>
                                <!-- END ARTICLE -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 sidebar">
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="categories-widget">
                                    <h3 class="widget-title">
                                        Informações:
                                    </h3>
                                        <li>
                                            <strong>Cliente: </strong> <?php echo $campanha['cliente'] ?>
                                        </li>
                                        <li>
                                            <strong>Nome: </strong> <?php echo $campanha['campanha'] ?>
                                        </li>
                                        <li>
                                            <strong>Data: </strong> <?php echo $sis->data($campanha['data'],"d/m/Y") ?>
                                        </li>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="recent-post-widget">
                                    <h3 class="widget-title">
                                        Descrição
                                    </h3>
                                    <p>
                                        <?php echo $campanha['descricao'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="categories-widget">
                                    <h3 class="widget-title">
                                        Fotos:
                                    </h3>
									<?php $campanhas_imagens = $sis->select("campanha_imagens",NULL,NULL,"campanha='$id_campanha'");
									if(!empty($campanhas_imagens)){
										foreach($campanhas_imagens as $imagens){?>
											 <img class="col-md-3 thumbnail img-responsive" src="uploads/<?php echo $imagens['imagem']?>">
										 <?php }?>
									 <?php }?>
                                </div>
                            </div>
                        </div>

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="recent-post-widget">
                                    <a class="btn pull-right" href="portfolio.php">Voltar</a>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->
                        <!-- /widget -->
                    </div>
                </div>
            </section>
            <!-- END BLOG -->
        </div>
        
             <?php include("inc/footer.php");?>
    </div>

</body>

</html>
