<div class="container container-docs">
    <div class="header py-3">
        <i class="<?php echo $icone ?>"></i><h1><?php echo $titulo_1 ?></h1>
        <span class="cnpj"><?php if(!empty($cliente)){ echo $cliente->clienteCpfCnpj ;}  ?></span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="calendario ano" id="ano"><span class="flaticon-left-arrow down" id="ydown"></span><span class="ycurrent">2017</span><span class="flaticon-arrows-2 up" id="yup"></span></div>
        </div>
        <div class="col-12">
           <div class="calendario mes" id="mes">
            <span class="flaticon-left-arrow down" id="mdown"></span >

            <span class="months <?php if(date('M') == 'Jan'){echo 'mcurrent' ;}?>">Janeiro</span>
            <span class="months <?php if(date('M') == 'Feb'){echo 'mcurrent' ;}?>">Fevereiro</span>
            <span class="months <?php if(date('M') == 'Mar'){echo 'mcurrent' ;}?>">Março</span>
            <span class="months <?php if(date('M') == 'Apr'){echo 'mcurrent' ;}?>">Abril</span>
            <span class="months <?php if(date('M') == 'May'){echo 'mcurrent' ;}?>">Maio</span>
            <span class="months <?php if(date('M') == 'Jun'){echo 'mcurrent' ;}?>">Junho</span>
            <span class="months <?php if(date('M') == 'Jul'){echo 'mcurrent' ;}?>">Julho</span>
            <span class="months <?php if(date('M') == 'Aug'){echo 'mcurrent' ;}?>">Agosto</span>
            <span class="months <?php if(date('M') == 'Sep'){echo 'mcurrent' ;}?>">Setembro</span>
            <span class="months <?php if(date('M') == 'Oct'){echo 'mcurrent' ;}?>">Outubro</span>
            <span class="months <?php if(date('M') == 'Nov'){echo 'mcurrent' ;}?>">Novembro</span>
            <span class="months <?php if(date('M') == 'Dec'){echo 'mcurrent' ;}?>">Dezembro</span>

            <span class="flaticon-arrows-2 up" id="mup"></span>
            </div>
        </div>
        <div class="col-12 text-right">
           <div class="filtros"><i class="flaticon-tool"></i> Classificar por
             
            <select name="filtro" id="filtro" class="form-control">
                <optgroup label="Filtros">
                    <option disabled selected value="">Selecione </option>
                    <option>por envio</option>
                    <option>por vencimento</option>
                    <option>por tipo</option>
                    <option>alfabética</option>
              </optgroup>
            </select>
            </div>
        </div>
    </div>
    <div class="painel mt-4 overflow-hidden relative">

             
        <div class="painel-block painel-docs">
            
            
        </div>
    </div>


    <div class="painel upload">
        <div class="painel-block up">
            <div class="painel-content row mx-0 upload-area-list upload-process">
                <form method="post" enctype="multipart/form-data" >
                    <div class="row w-100 lista-head">
                        <div class="col-12 col-md-4">Nome do arquivo</div>
                        <!-- <div class="col-12 col-md-1 text-center">Tags</div> -->
                        <div class="col-12 col-md-3 text-center">Vencimento</div>
                        <div class="col-12 col-md-3 text-center">Competência</div>
                        <div class="col-12 col-md-1 text-center">Recálculo</div>
                        <div class="col-12 col-md-1 text-right"></div>
                    </div>

                    <div class="w-100 px-0">
                        <hr class="separador-cinza">
                    </div>
                    <div class="lista mb-4">
                        
                    </div>
 
                    <div class="col-12 px-0 upload-buttons">
                        <button class="btn btn-theme btn-super process" type="submit" >Processar arquivos</button>
                    </div>
                 
                    <div class="col-12 px-0 upload-buttons">
                        <button class="btn btn-link btn-width" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>

            <div class="painel-content row mx-0 upload-area-list upload-process-rec">
                <form class="w-100" method="post" enctype="multipart/form-data" >
                    <div class="row w-100 lista-head">
                        <div class="col-12 col-md-11">Vencimento do recalculo</div>
                        <div class="col-12 col-md-1 text-right"></div>
                    </div>

                    <div class="w-100 px-0">
                        <hr class="separador-cinza">
                    </div>
                    <div class="lista mb-4">
                        
                    </div>
 
                    <div class="col-12 px-0 upload-buttons">
                        <button class="btn btn-theme btn-super process-rec" type="submit" >Processar arquivos</button>
                    </div>
                 
                    <div class="col-12 px-0 upload-buttons">
                        <button class="btn btn-link btn-width" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>

            <div class="painel-content row px-0">
                <div class="col-12">
                    <div class="upload-area">
                        <i class="flaticon-upload"></i>
                        <p><strong>Solte mais arquivos aqui ou clique para adicionar a lista</strong><br/>
                        Para fazer o upload utilize a ultima versão do Google Chrome.<br/>
                        <strong>Máx. de 2Mb</strong></p>

                        <!-- <input type="file" class="files" >  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
                

     
</div>

<div class="modal animated bounceIn" id="upload-arquivo" data-keyboard="false" data-backdrop="false">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="flaticon-error"> </i>
                </button>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-5">
                <h5 class="modal-title"><i class="flaticon-upload"></i> Arquivos para processar</h5>
                
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url()?>form/uploadFileS3<?php if(!empty($cliente)){ echo '/'.$cliente->clienteCpfCnpj;} ?>" method="post" enctype="multipart/form-data" >
                <div class="painel">
                    <div class="painel-block">
                        <div class="painel-content row px-0">
                            <div class="row w-100 text-center lista-head">
                                <div class="col-12 col-md-5">Nome original</div>
                                <div class="col-12 col-md-5">Renomeie o arquivo</div>
                                <div class="col-12 col-md-2"> </div>
                            </div>
                            <div class="w-100 px-0">
                                <hr class="separador-cinza">
                            </div>
                            <div class="lista">
                                
                            </div>

                            <div class="w-100 px-0">
                                <hr class="separador-cinza">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-theme btn-super process" type="submit" >Processar arquivos</button>
                            </div>
                         
                            <div class="col-12">
                                <button class="btn btn-link btn-width" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row w-100 px-0">
                    
                </div>
            </div>

            <div class="col-12">
                    <div class="upload-area">
                        <i class="flaticon-upload"></i>
                        <p><strong>Solte os arquivos aqui ou clique para fazer o upload</strong><br/>
                        Para fazer o upload utilize a ultima versão do Google Chrome.<br/>
                        <strong>Máx. de 2Mb</strong></p>

                        
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade"> 
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="flaticon-error"> </i>
                </button>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-5">
                <h5 class="modal-title"><i class="flaticon-upload"></i> Arquivos para processar</h5>
                
            </div>
            <div class="modal-body">
                <div class="painel">
                    <div class="painel-block">
                        <div class="painel-content row px-0">
                            <div class="row w-100 text-center lista-head">
                                <div class="col-12 col-md-3">Nome do arquivo</div>
                                <div class="col-12 col-md-3">Tags</div>
                                <div class="col-12 col-md-3">Vencimento</div>
                                <div class="col-12 col-md-3">Ativar recálculo</div>
                            </div>
                            <div class="w-100 px-0">
                                <hr class="separador-cinza">
                            </div>
                            <div class="lista">
                                
                            </div>

                            <div class="w-100 px-0">
                                <hr class="separador-cinza">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-theme btn-super">Processar arquivos</button>
                            </div>
                         
                            <div class="col-12">
                                <button class="btn btn-link btn-width" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100 px-0">
                    
                </div>
            </div>

            <div class="col-12">
                    <div class="upload-area">
                        <i class="flaticon-upload"></i>
                        <p><strong>Solte os arquivos aqui ou clique para fazer o upload</strong><br/>
                        Para fazer o upload utilize a ultima versão do Google Chrome.<br/>
                        <strong>Máx. de 2Mb</strong></p>

                          <input type="file" class="files-upload" >
                    </div>
            </div>
        </div>
    </div>
</div> -->