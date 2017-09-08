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
                <form class="col-12" action="<?php echo base_url()?>form/clientes<?php if(!empty($cliente)){ echo '/'.$cliente->clienteID ;}  ?>"  method="post" >  
                    <div class="row" >

                        <div class="col-md-6">
                            
                            <div class="row">
                                <div class="form-group col-12 ">
                                    <div class="label">CPF ou CNPJ</div>
                                    <input type="text" name="clienteCpfCnpj" id="cpfcnpj" class="form-control" value="<?php if(!empty($cliente)){ echo $cliente->clienteCpfCnpj; } ?>" required />
                                </div>
                                <!-- <div class="form-group col-6 ">
                                    <div class="label">Data de anivesario</div>
                                    <input type="date" name="clienteAniver" class="form-control" required />
                                </div> -->
                                <div class="form-group col-12 ">
                                    <div class="label">Nome ou Razão Social</div>
                                    <input type="text" name="clienteNomeRazao" class="form-control" value="<?php if(!empty($cliente)){ echo $cliente->clienteNomeRazao; } ?>" required />
                                </div>
                                <!-- <div class="form-group col-4 ">
                                    <div class="label">Telefone</div>
                                    <input type="text" name="clienteTelefone"  class="form-control" />
                                </div> -->
                                <div class="form-group col-12 ">
                                    <div class="label">Celular</div>
                                    <input type="text" name="clienteCelular" class="form-control" value="<?php if(!empty($cliente)){ echo $cliente->clienteCelular; } ?>" required />
                                </div>
                                <div class="form-group col-12 ">
                                    <div class="label">Email</div>
                                    <input type="text" name="clienteEmailPrinc" class="form-control" value="<?php if(!empty($cliente)){ echo $cliente->clienteEmailPrinc; } ?>" required />
                                </div>

                                <!-- <div class="form-group col-4 ">
                                    <div class="label">CEP</div>
                                    <input type="text" name="clienteCep" class="form-control" required />
                                </div>
                                <div class="form-group col-6 ">
                                    <div class="label">Rua</div>
                                    <input type="text" name="clienteRua" class="form-control" required />
                                </div>
                                <div class="form-group col-6 ">
                                    <div class="label">Complemento</div>
                                    <input type="text" name="clienteEndComp" class="form-control" />
                                </div>
                                <div class="form-group col-4 ">
                                    <div class="label">Bairro</div>
                                    <input type="text" name="clienteBairro" class="form-control" required />
                                </div>
                                <div class="form-group col-4 ">
                                    <div class="label">Cidade</div>
                                    <input type="text" name="clienteCidade" class="form-control" required />
                                </div> -->
                            </div>                                              
                        </div>

                        <div class="col-12 pt-3">
                            <button type="submit" class="btn btn-theme btn-super" > Salvar </button>
                        </div>
                     </div>                        
                </form>

            </div>
        </div>
    </div>

    <div class="painel">
        <div class="painel-block">
            <div class="painel-head mb-4">
                <h2 class="pb-4">Arquivo</h2>
            </div>
            <div class="painel-content row px-0">
                <div class="col-12">
                    <div class="lista">
                        <?php if(!empty($clientes)):
                            foreach ($clientes->arquivo as $doc): ?>
                                <div class="lista-item mb-2">
                                    <div class="row align-items-center">
                                        <div class="col-10 ">
                                            <div class="title"><?php echo $doc->arquivoNome ?></div>
                                        </div>
                                        <div class="col-2 text-right">
                                            <!-- <a href="<?php echo base_url('admin/clientes/'.$cliente->clienteCpfCnpj )?>" class="btn btn-theme"><span class="fa fa-search-plus"></span></a> -->
                                            <a href="" class="btn btn-theme"><span class="fa fa-trash" ></span></a>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; else:?>
                                <div class="alert alert-info text-center">Não há documentos no arquivo</div>
                        <?php endif; ?>
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
    </div>
</div>

<div class="modal fade">
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
                            <div class="lista">
                                <div class="lista-item-grade"></div>
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
        </div>
    </div>
</div>