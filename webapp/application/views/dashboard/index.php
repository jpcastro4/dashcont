        <div class="container relative mb-5">

            <div class="row mb-5">
                <div class="col-12 my-5 text-right">
                    <a href="<?php echo base_url()?>administrativo/novo-empreendimento" class="btn btn-theme">Novo empreendimento</a>
                     <!-- <button class="btn btn-theme">Novo corretor</button>  -->
                </div>
                
                <div class="col-12 contain-card p-4">
                    <div class="row">
                     <?php if(!empty($emps)): ?>
                         
                        <?php foreach ($emps as $emp) : ?>
                           
                            <div class="col-12 col-md-4">
                                <div class="w-100 empImagem-lista">
                                <img class="w-100" src="<?php echo base_url() ?>/uploads/<?php echo $emp->empImagem; ?>">
                                </div>
                                <div class="detalhes p-3">
                                    <h5 class="text-center"><?php echo $emp->empNome; ?></h5>
                                </div>
                                <div class="py-3">
                                    <a href="<?php echo base_url()?>administrativo/empreendimento/<?php echo $emp->empID ?>" class="btn btn-theme btn-width"> Editar </a>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else: ?>

                        <p class="alert alert-info text-center w-100"> Não há empreendimentos cadastrados</p>
                     <?php endif; ?>               
                    </div>
                </div>
                 
            </div>
        </div>
