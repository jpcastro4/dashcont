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
                <form class="col-12 col-md-6" action="<?php echo base_url()?>form/bloqueios<?php if(!empty($bloqueio)){ echo '/'.$bloqueio->bloqueioID ;}  ?>"  method="post" >  
                    <div class="row" >
                        <div class="form-group col-12 ">
                            <div class="label">Identificação do bloqueio</div>
                            <input type="text" name="bloqueioIdt" class="form-control" value="<?php if(!empty($bloqueio)){ echo $bloqueio->bloqueioIdt; } ?>" required />
                        </div>
                        <div class="form-group col-12 ">
                            <div class="label">Mensagem do alerta</div>
                            <input type="text" name="bloqueioMsg" class="form-control" value="<?php if(!empty($bloqueio)){ echo $bloqueio->bloqueioMsg; } ?>" required />
                        </div>
                         
                        <div class="form-group col-12"> 
                            <div class="label">Notificar usuário por email?</div>
                            <label class="switch">
                            <input type="checkbox" name="bloqueioAlertaEmail" value="1" <?php if(!empty($bloqueio)){ if($bloqueio->bloqueioEmail == 1){ echo 'checked'; } } ?> >
                                <div class="slider round"></div>
                            </label>
                        </div>

                        <div class="form-group col-12">
                            <div class="label">Notificar usuário por SMS?</div>
                            <label class="switch">
                            <input type="checkbox" name="bloqueioAlertaSms" value="1" <?php if(!empty($bloqueio)){ if($bloqueio->bloqueioSms == 1){ echo 'checked'; } } ?> >
                                <div class="slider round"></div>
                            </label>
                        </div>

                        <div class="form-group col-12">
                            <div class="label">Notificar usuário por Push?</div>
                            <label class="switch">
                            <input type="checkbox" name="bloqueioAlertaPush" value="1" <?php if(!empty($bloqueio)){ if($bloqueio->bloqueioPush == 1){ echo 'checked'; } } ?> >
                                <div class="slider round"></div>
                            </label>
                        </div>

                        <div class="col-12 pt-3">
                            <button type="submit" class="btn btn-success" > Salvar </button>
                        </div>
                     </div>                        
                </form>

                <div class="w-100 py-5">
                    <hr class="separador-cinza">
                </div>

                

            </div>
        </div>
    </div>
</div>
        
        <div class="container relative my-5 ">
            <div class="row">
                <div class="col-12 pb-5">
                    <h1 class="contain-title pull-left"> Produtos </h1>
                    <a href="#" class="btn btn-theme pull-right" data-toggle="modal" data-target="#produto">Novo produto</a>
                </div>
                
                <div class="col-12">
                    <div class="contain-card p-4">
                        <div class="lista clearfix">
                            <?php if(!empty($produtos)):
                            foreach ($produtos as $produto): ?>

                                <div class="lista-item mb-2">
                                    <div class="row">
                                        <div class="col-10"><div class="title"><?php echo $produto->produtoNome ?></div></div>
                                        <div class="col-2 text-right">
                                        <a href="<?php echo base_url('admin/produto/'.$produto->produtoID )?>" class="btn btn-theme"><span class="fa fa-search-plus"></span></a>
                                        <a href="" class="btn btn-theme"><span class="fa fa-trash" ></span></a></div>
                                    </div>
                                </div>
                            <?php endforeach; else:?>
                                <div class="alert alert-info text-center">Não há produtos</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                 
            </div>
        </div>
       
                         