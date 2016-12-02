        <?php $itens_clientes = $sis->select("clientes",NULL,NULL,NULL,"ordem ASC");
        if (!empty($itens_clientes)) {?>
            <section id="clients" class="clients">
                <div class="row">
                    <div class="col-md-12 mg-bt-80">
                        <div class="header-content">
                            <h2>Parceiros</h2>
                            <h3>Alguns dos parceiros que atendemos </h3>
                        </div>
                    </div>                    
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="owl-carousel">
                            <?php foreach($itens_clientes as $item_clientes){?>
                                <div><img class="img-responsive" src="<?php echo u_UPLOADS.'/'.$item_clientes['foto'];?>" alt="<?php echo $item_clientes['nome'];?>"></div>
                             <?php }?>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>