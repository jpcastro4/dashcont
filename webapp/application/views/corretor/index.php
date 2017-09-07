        <div class="container relative mb-5">

            <div class="row my-5">
                
                <div class="col-12">
                    <div class="row">
                     <?php if(!empty($emps)): ?>
                         
                        <?php foreach ($emps as $emp) : ?>
                           
                            <div class="col-12 col-md-4 mb-5">
                                <div class="w-100 empImagem-lista">
                                <img class="w-100" src="<?php echo base_url() ?>/uploads/<?php echo $emp->empImagem; ?>">
                                </div>
                                <div class="detalhes p-3">
                                    <h4 class="text-center"><?php echo $emp->empNome; ?></h4>
                                </div>
                                <div class="">
                                    <ul class="list-group">
                                      <?php if(!empty($emp->empArea)):?><li class="list-group-item">Área (m²): <?php echo $emp->empArea ?> </li><?php endif;?>
                                      <?php if(!empty($emp->empQuartos)):?><li class="list-group-item">Nº quartos: <?php echo $emp->empQuartos ?> </li><?php endif;?>
                                      <?php if(!empty($emp->empAndares)):?><li class="list-group-item">Nº andares: <?php echo $emp->empAndares ?> </li><?php endif;?>
                                      <?php if(!empty($emp->empAptoAndar)):?><li class="list-group-item">Nº aptos por andar: <?php echo $emp->empAptoAndar ?> </li><?php endif;?>
                                      
                                    </ul>
                                    <ul class="list-group mt-2">
                                      <?php if(!empty($emp->empLinkSite)):?><li class="list-group-item ">Acesse o site <a href="<?php echo $emp->empLinkSite  ?>" target="_blank" class="text-center"> <i class="fa fa-link"></i></a></li><?php endif;?>

                                      <?php if(!empty($emp->empApresentacao)):?><li class="list-group-item">Apresentação <a class="pull-right" target="_blank" href="<?php echo base_url('uploads/') ?><?php echo $emp->empApresentacao ?>"><i class="fa fa-cloud-download"></i></a> </li><?php endif;?>

                                      <?php if(!empty($emp->empTabVendas)):?><li class="list-group-item">Tabela de vendas <a class="pull-right" target="_blank" href="<?php echo base_url('uploads/') ?><?php echo $emp->empTabVendas ?>"><i class="fa fa-cloud-download"></i></a> </li><?php endif;?>

                                      <?php if(!empty($emp->empMemorial)):?><li class="list-group-item">Memorial descritivo<a class="pull-right" target="_blank" href="<?php echo base_url('uploads/') ?><?php echo $emp->empMemorial ?>"><i class="fa fa-cloud-download"></i></a> </li><?php endif;?>

                                      <a href="<?php echo base_url()?>empreendimento/<?php echo $emp->empID ?>" class="text-center mt-1"> <li class="list-group-item text-center list-group-item-action btn-theme">Acompanhar unidades livres</li> </a>
                                    </ul>                                  
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else: ?>

                        <p class="alert alert-info"> Não há empreendimentos cadastrados</p>
                     <?php endif; ?>               
                    </div>
                </div>
                 
            </div>
        </div>
