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
                            <input type="checkbox" name="bloqueioAlertaEmail" value="1" <?php if(!empty($bloqueio)){ if($bloqueio->bloqueioAlertaEmail == 1){ echo 'checked'; } } ?> >
                                <div class="slider round"></div>
                            </label>
                        </div>

                        <div class="form-group col-12">
                            <div class="label">Notificar usuário por SMS?</div>
                            <label class="switch">
                            <input type="checkbox" name="bloqueioAlertaSms" value="1" <?php if(!empty($bloqueio)){ if($bloqueio->bloqueioAlertaSms == 1){ echo 'checked'; } } ?> >
                                <div class="slider round"></div>
                            </label>
                        </div>

                        <div class="form-group col-12">
                            <div class="label">Notificar usuário por Push?</div>
                            <label class="switch">
                            <input type="checkbox" name="bloqueioAlertaPush" value="1" <?php if(!empty($bloqueio)){ if($bloqueio->bloqueioAlertaPush == 1){ echo 'checked'; } } ?> >
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

                <div class="col-12">
                    <div class="lista">

                        <?php if(!empty($bloqueios) ): ?>
                        <?php foreach ($bloqueios as $bloqueio) : ?>
                             
                        
                        <div class="lista-item">
                            <div class="row">
                                <div class="col-3">
                                    <div class="lista-item-title"><?php echo $bloqueio->bloqueioIdt ?></div>
                                </div>
                                <div class="col-6">
                                    <div class="lista-item-text"><?php echo $bloqueio->bloqueioMsg ?></div>
                                </div>
                                 
                                <div class="col-3 text-right">
                                    <a href="bloqueios/<?php echo $bloqueio->bloqueioID ?>"><i class="flaticon-draw"></i></a>

                                    <i class="flaticon-interface-2"></i>
                                </div>
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
 
       
                         