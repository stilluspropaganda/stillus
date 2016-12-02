<?php
    $port_grid = $sis->select("campanha",NULL,NULL,NULL," RAND() limit 6");

?>
            <section id="portfolio-grid" class="portfolio gray">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-content">
                            <h2>Portfólio</h2>
                            <h3>Algumas de nossas peças</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="portfolioFilter text-center">
                            <li style="background-color: #bed62f;"><a style="color: white;" href="portfolio.php">Ver Mais</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12 mg-bt-80">
                        <div class="row portfolioContainer  text-center">
                            <?php foreach($port_grid as $port_grid_item){?>                                
                                <div class="col-md-4 col-xs-6 portfolio-item <?php echo $port_grid_item['descricao']; ?>">
                                    <a class="popup" href="uploads/<?php echo $port_grid_item['foto']; ?>" data-lightbox-gallery="team-portfolio">
                                        <span class="project-hover">
                                            <span><strong><?php echo $port_grid_item['campanha']; ?></strong><br />
                                            <small><?php echo $port_grid_item['cliente']; ?></small>
                                            </span>
                                        </span>
                                        <img src="uploads/<?php echo $port_grid_item['foto']; ?>" alt="<?php echo $port_grid_item['campanha']; ?>">                                    </a>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </section>