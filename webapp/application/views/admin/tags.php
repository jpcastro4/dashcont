<div class="container">
    <div class="header py-5">
        <i class="flaticon-settings"></i><h1><?php echo $titulo_1 ?></h1>
    </div>
    <div class="painel">
        <div class="painel-block">
            <div class="painel-head mb-4">
                <h2 class="pb-4"><?php echo $titulo_2 ?></h2>
            </div>
            <div class="painel-content row px-0">
                <form class="col-12 col-md-6" action="<?php echo base_url()?>form/tags<?php if(!empty($tag)){ echo '/'.$tag->tagID ;}  ?>"  method="post" >  
                    <div class="row" >
                        <div class="form-group col-12 ">
                            <div class="label">Tag</div>
                            <input type="text" name="tagNome" class="form-control" value="<?php if(!empty($tag)){ echo $tag->tagNome; } ?>" required />
                        </div>
                        <div class="form-group col-12 ">
                            <div class="label">Cor</div>
                            <input type="color" name="tagCor" value="<?php if(!empty($tag)){ echo $tag->tagCor; } ?>" required />
                        </div> 
                        <div class="col-12 pt-3">
                            <button type="submit" class="btn btn-success" > Salvar </button>
                        </div>
                     </div>                        
                </form>

                <div class="w-100 py-5">
                    <hr class="separador-cinza">
                </div>

                <div class="col-12">
                    <div class="lista">

                        <?php if(!empty($tags) ): ?>
                        <?php foreach ($tags as $tag) : ?>
                             
                        
                        <div class="lista-item">
                            <div class="row">
                                <div class="col-12" style="background-color: <?php echo $tag->tagCor ?>">
                                    <div class="lista-item-title font-branco"><?php echo $tag->tagNome ?></div>
                                </div>
                                 
                                <!-- <div class="col-3 text-right">
                                    <a href="tags/<?php echo $tag->tagID ?>"><i class="flaticon-draw"></i></a>

                                    <i class="flaticon-interface-2"></i>
                                </div> -->
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif; ?>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>
 
       
                         