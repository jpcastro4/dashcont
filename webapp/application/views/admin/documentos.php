<div class="container container-docs">
    <div class="header py-5">
        <i class="<?php echo $icone ?>"></i><h1><?php echo $titulo_1 ?></h1>
        <span class="cnpj"><?php if(!empty($cliente)){ echo $cliente->clienteCpfCnpj ;}  ?></span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="calendario ano">2017</div>
        </div>
        <div class="col-12">
           <div class="calendario mes">Janeiro</div>
        </div>
        <div class="col-12 text-right">
           <div class="filtros"><i class="flaticon-tool"></i> Classificar por

            <select name="filtro" class="form-control">
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
    <div class="painel mt-4">
        <div class="painel-block">
             
            <div class="painel-content row px-0">
                <div class="row w-100  lista-head mb-3">
                    <div class="col-12 col-md-3">Documento</div>
                    <div class="col-12 col-md-3">Tags</div>
                    <div class="col-12 col-md-2">Track</div>
                    <div class="col-12 col-md-1">Status</div>
                    <div class="col-12 col-md-1"> </div>
                    <div class="col-12 col-md-1"> </div>
                </div>
                <div class="w-100 px-0">
                    <hr class="separador-cinza">
                </div> 
                <div class="lista">
                    <div class="lista-item-doc row mx-0">

                        <div class="col-12 col-md-3">Guia de pagamento GPS - Comp 09/2017</div>
                        <div class="col-12 col-md-3"><tag>Federal</tag><tag>Imposto</tag><tag>Previdencia</tag></div>
                        <div class="col-12 col-md-2 track">
                            <span class="view" data-toggle="tooltip" data-placement="top" title="Visualizações" >2 <i class="flaticon-visibility"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões">2 <i class="flaticon-technology-1"></i></span>
                        </div>
                        <div class="col-12 col-md-1">Status</div>
                        <div class="col-12 col-md-2 text-center">
                            <span class="view" data-toggle="tooltip" data-placement="top" title="Inserir recálculo" > <i class="flaticon-interface-3"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões"> <i class="flaticon-technology-1"></i></span>
                        </div>
                        <div class="col-12 col-md-1">
                            <span data-toggle="tooltip" data-placement="top" title="Expandir" data-open-panel="1"> <i class="flaticon-arrows-1"></i></span> 
                        </div>
                        <div class="col-12 lista-item-doc-painel mt-2" data-panel="1">
                            <div class="row w-100  lista-head mb-2">
                                <div class="col-12 col-md-2">Recálculo</div>
                                <div class="col-12 col-md-2">Data do envio</div>
                                <div class="col-12 col-md-2 text-center">Track</div>
                                <div class="col-12 col-md-3">Vencimento</div>
                                <div class="col-12 col-md-2">Competência</div>
                            </div>
                            <div class="lista">
                                <div class="lista-item-doc row mx-0 ">
                                    <div class="col-12 col-md-2 px-0">2</div>
                                    <div class="col-12 col-md-2 px-0">05/07/2017 13:52</div>
                                    <div class="col-12 col-md-2 track ">
                                        <span class="view" data-toggle="tooltip" data-placement="top" title="Visualizações" >2 <i class="flaticon-visibility"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões">2 <i class="flaticon-technology-1"></i></span>
                                    </div>
                                    <div class="col-12 col-md-3">12/07/2017</div>
                                    <div class="col-12 col-md-2">07/2017</div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="lista-item-doc row mx-0">

                        <div class="col-12 col-md-3">Guia de pagamento GPS - Comp 09/2017</div>
                        <div class="col-12 col-md-3"><tag>Federal</tag><tag>Imposto</tag><tag>Previdencia</tag></div>
                        <div class="col-12 col-md-2 track">
                            <span class="view" data-toggle="tooltip" data-placement="top" title="Visualizações" >2 <i class="flaticon-visibility"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões">2 <i class="flaticon-technology-1"></i></span>
                        </div>
                        <div class="col-12 col-md-1">Status</div>
                        <div class="col-12 col-md-2 text-center">
                            <span class="view" data-toggle="tooltip" data-placement="top" title="Inserir recálculo" > <i class="flaticon-interface-3"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões"> <i class="flaticon-technology-1"></i></span>
                        </div>
                        <div class="col-12 col-md-1">
                            <span data-toggle="tooltip" data-placement="top" title="Expandir" > <i class="flaticon-arrows-1"></i></span> 
                        </div>
                    </div>
                </div>               

            </div>
        </div>
    </div>


    <div class="painel">
        <form action="<?php echo base_url()?>form/uploadDocS3<?php if(!empty($cliente)){ echo '/'.$cliente->clienteCpfCnpj;} ?>" method="post" enctype="multipart/form-data" >
        <div class="painel-block">
            <div class="painel-content row mx-0 upload-process">
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

               <!--  <div class="w-100 px-0">
                    <hr class="separador-cinza">
                </div> -->
                <div class="col-12 px-0 upload-buttons">
                    <button class="btn btn-theme btn-super process" type="submit" >Processar arquivos</button>
                </div>
             
                <div class="col-12 px-0 upload-buttons">
                    <button class="btn btn-link btn-width" data-dismiss="modal">Cancelar</button>
                </div>

            </div>

            <div class="painel-content row px-0">
                <div class="col-12 mt-4">
                    <div class="upload-area">
                        <i class="flaticon-upload"></i>
                        <p><strong>Solte os arquivos aqui ou clique para fazer o upload</strong><br/>
                        Para fazer o upload utilize a ultima versão do Google Chrome.<br/>
                        <strong>Máx. de 2Mb</strong></p>

                        <!-- <input type="file" class="files" >  -->
                    </div>
                </div>
            </div>
        </div>
        </form>
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