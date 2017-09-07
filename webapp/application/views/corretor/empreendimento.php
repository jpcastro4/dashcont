 
        
        <div class="container relative mb-5">

            <div class="row mb-5">
                <div class="col-12 py-5">
                    <h1 class="contain-title"> <?php echo $emp->empNome; ?>  </h1>
                </div>
                
                <div class="col-12 col-md-8">
                    <form action="" method="post" enctype="multipart/form-data" >
                                              
                        <div class="contain-card p-4 block-md mb-4">
                            <?php if( !empty($emp->empImagem)): ?>
                            <div class="w-100 mb-5">
                                <img class="w-100" src="<?php echo base_url() ?>/uploads/<?php echo $emp->empImagem ?>">
                            </div>
                            <?php endif;?>
                            <fieldset class="form-group mb-0">
                                <div class="row">
                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Nome do empreendimento </div>
                                        <input disabled type="text" name="empNome" class="form-control" placeholder="Título da Pesquisa" required  value="<?php echo $emp->empNome; ?> " />
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Link para o site </div>
                                        <input disabled type="text" name="empLinkSite" class="form-control"  placeholder="Link do site" value="<?php echo $emp->empLinkSite; ?> " />
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <div class="row">
                                            <div class="col-6 col-sm-3">
                                                <div class="label">Área (m²) </div>
                                                <input disabled type="text" name="empArea" class="form-control" required  value="<?php echo $emp->empArea; ?> " />
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="label">Nº de quartos </div>
                                                <input disabled type="text" name="empQuartos" class="form-control" required  value="<?php echo $emp->empQuartos; ?> "  />
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="label">Nº de Andares </div>
                                                <input disabled type="text" name="empAndares" class="form-control" required value="<?php echo $emp->empAndares; ?> " />
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="label">Atpº por andar </div>
                                                <input disabled type="text" name="empAptoAndar" class="form-control" required  value="<?php echo $emp->empAptoAndar ?> " />
                                            </div>
                                        </div>
                                    </div>

                                 </div>
                            </fieldset>
                        </div>
                    </form>
                        <div class="row mb-4">
                            <?php if( !empty($arquivos) ): ?>
                                <?php foreach ($arquivos as $arquivo ):

                                    switch ($arquivo->arquivoTipo) {
                                        case '.jpg':
                                            $icone = 'fa-file-image-o';
                                            break;
                                        case '.png':
                                            $icone = 'fa-file-image-o';
                                            break;
                                        case '.jpeg':
                                            $icone = 'fa-file-image-o';
                                            break;
                                        case '.pdf':
                                            $icone = 'fa-file-pdf-o';
                                            break;
                                        case '.xls':
                                            $icone = 'fa-file-excel-o';
                                            break;
                                        case '.xlsx':
                                            $icone = 'fa-file-excel-o';
                                            break;
                                        case '.ppt':
                                            $icone = 'fa-file-powerpoint-o';
                                            break;
                                        case '.pptx':
                                            $icone = 'fa-file-powerpoint-o';
                                            break;
                                        default:
                                            $icone = 'fa-file-image-o';
                                            break;
                                    } 

                                ?>
                                <div class="col-4 ">
                                    <div class="contain-card py-3 text-center relative">
                                        <a class="icone-arquivo" href="<?php echo base_url() ?>/uploads/<?php echo $arquivo->arquivoCaminho ?>" target="_blank"> <span class="fa <?php echo $icone; ?>"></span><br/> <?php echo $arquivo->arquivoNome ?> </a>
                                        <a href="#" class="excluir" data-excluir="<?php echo $arquivo->arquivoID ?>" style="position:absolute;top:-5px;right:-5px"><span class="fa fa-times-circle fa-2x"></span></a>
                                   </div>
                                </div>  
                                <?php endforeach; ?>
                                
                            <?php endif;?>
                             
                        </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="row">
                    <?php

                    $predio =  unserialize($emp->empAptos);

                     foreach (array_reverse($predio, true) as $andark => $andar): ?>

                         <?php echo '<ul class="andar clearfix col-12"> <li class="text-center col-12 hidden-xs-up">andar '.$andark.'</span>'; ?>

                            <?php foreach ( $andar as $key => $value) :?>

                               <li class="apto apto-<?php echo $emp->empAptoAndar; ?> <?php echo ($value['status'] )? 'apto-livre' : 'apto-reservado'; ?> " data-emp="<?php echo $emp->empID ?>" data-andar="<?php echo $andark ?>" data-apto="<?php echo $value['numApto'] ?>">
                                    <div class="label"><?php echo $value['numApto'] ?></div>
                                   <!--  <label class="switch">
                                        <input data-emp="<?php echo $emp->empID ?>" data-andar="<?php echo $andark ?>" data-apto="<?php echo $value['numApto'] ?>" type="checkbox" name="empStatus" <?php echo ($value['status'] )? 'checked' : ''; ?> >
                                        <div class="slider round"></div>
                                    </label> -->
                                <?php echo '</li>'; ?>

                            <?php endforeach; ?>    

                         <?php echo '</ul>'; ?>

                    <?php endforeach; ?>    
                    <?php //var_dump( unserialize($emp->empAptos)); ?>

                    </div>  
                </div>
            </div>
        </div>
        
        

