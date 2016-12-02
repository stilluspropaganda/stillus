    <?php $itens_banners = $sis->select("banners",NULL,NULL,NULL,"ordem ASC");
     if (!empty($itens_banners)) {?>
            <section id="home" class="home">
                <!-- Superslides -->
                <div id="home-slide">
                    <ul class="slides-container text-center">
                    <?php foreach($itens_banners as $item_banner){?>
                        <li>
                            <div class="slide-text">
                                <h2><?php echo $item_banner['titulo'];?></h2>
                                <span><?php echo $item_banner['descricao'];?></span>
                                <br/>
                            </div>
                            <div class="slide-filter"></div>
                            <img src="<?php echo u_UPLOADS.'/'.$item_banner['foto'];?>" class="par" alt="<?php echo $item_banner['titulo'];?>">
                        </li>
                    <?php }?>
                    </ul>
                    <nav class="slides-navigation slidez">
                        <a href="javascript:;" class="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <a href="javascript:;" class="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </nav>
                </div>
                <!-- End of Superslide -->
            </section>
        <?php } ?>