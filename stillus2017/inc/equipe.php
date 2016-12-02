        <?php $itens = $sis->select("equipe",NULL,NULL,NULL,"ordem ASC");
        if (!empty($itens)) {?>
            <section id="about" class="about gray">
                <div class="row">
                    <div class="col-md-12 mg-bt-80">
                        <div class="header-content">
                            <h2>O Time</h2>
                            <h3>A Stillus entra em campo assim:</h3>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row mg-bt-40">
                            <?php foreach($itens as $item){?>
                                <div class="col-md-2">
                                    <div class="teams">
                                        <div class="pict">
                                            <img class="img-responsive" src="<?php echo u_UPLOADS.'/'.$item['foto'];?>" alt="Team 1">
                                        </div>
                                        <div class="desc">
                                            <h3><?php echo $item['nome'];?></h3>
                                            <span><?php echo $item['cargo'];?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>