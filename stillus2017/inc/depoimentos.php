        <?php $itens_depoimento = $sis->select("depoimentos",NULL,NULL,NULL,"ordem ASC");
        $cont_dep = 0;
        if (!empty($itens_depoimento)) {?>
            <section id="testimonial" class="testimonial">                
                <div class="row">
                    <div class="col-md-12 mg-bt-80">
                        <div class="header-content">
                            <h2>Depoimentos</h2>
                            <h3>Legal para credibilidade</h3>
                        </div>
                    </div>                    
                    <div class="col-md-12">
                        <div id="bx-pager" class="client-photos">
                            <?php foreach($itens_depoimento as $item_depoimento){?>
                                <a class="client-photo" data-slide-index="<?php echo $cont_dep;?>" href="">
                                  <img alt="<?php echo $item_depoimento['nome'];?>" src="<?php echo u_UPLOADS.'/'.$item_depoimento['foto'];?>"> <!-- Client photo 1 -->
                                </a>
                            <?php $cont_dep++; }?>    
                        </div>
                    <ul class="bxslider">
                        <?php foreach($itens_depoimento as $item_depoimento){?>
                            <li>
                                <h3><?php echo $item_depoimento['texto'];?></h3>
                                <span>&mdash;<strong><?php echo $item_depoimento['nome'];?></strong>, <?php echo $item_depoimento['descricao'];?></span>
                            </li>
                        <?php } ?>  
                    </ul>                        
                    </div>
                </div>                
            </section>
        <?php } ?>