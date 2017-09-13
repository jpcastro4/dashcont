           
            <div class="painel-content row mx-0">
                <?php if(!empty($documentos)) : ?>
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
                    <?php foreach($documentos as $documento) :

                    $lastVrs = $this->admin->docVersao($documento->docID)[0] ;?>

                    <div class="lista-item-doc row mx-0 " data-doc="<?php echo $documento->docID ?>">

                        <div class="col-12 col-md-3"><?php echo $documento->docNome ?></div>
                        <div class="col-12 col-md-3">
                            <?php if(!empty($this->admin->docTags($documento->docID))): foreach($this->admin->docTags($documento->docID) as $tag) :?>
                                <tag><?php echo $this->admin->getTag($tag->tagID)->tagNome; ?></tag> 
                            <?php endforeach; endif;?>
                        </div>
                        <div class="col-12 col-md-2 track">
                            <span class="view" data-toggle="tooltip" data-placement="top" title="Visualizações" ><?php echo $lastVrs->docVrsOpens ?> <i class="flaticon-visibility"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões"><?php echo $lastVrs->docVrsPrints ?> <i class="flaticon-technology-1"></i></span>
                        </div>
                        <div class="col-12 col-md-1"><?php echo $documento->docStatus ?></div>
                        <div class="col-12 col-md-2 text-center">
                            <span class="view" data-toggle="tooltip" data-placement="top" title="Inserir recálculo" > <i class="flaticon-interface-3"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões"> <i class="flaticon-technology-1"></i></span>
                        </div>
                        <div class="col-12 col-md-1">
                            <span data-toggle="tooltip" data-placement="top" title="Expandir" data-open-panel="<?php echo $documento->docID ?>"> <i class="flaticon-arrows-1"></i></span> 
                        </div>
                        <div class="col-12 lista-item-doc-painel mt-2" data-panel="<?php echo $documento->docID ?>">
                            <div class="row w-100  lista-head mb-2">
                                <div class="col-12 col-md-2">Recálculo</div>
                                <div class="col-12 col-md-2">Data do envio</div>
                                <div class="col-12 col-md-2 text-center">Track</div>
                                <div class="col-12 col-md-3">Vencimento</div>
                                <div class="col-12 col-md-2">Competência</div>
                            </div>
                            <div class="lista">

                                <?php $o = 1; foreach($this->admin->docVersao($documento->docID) as $versao ): ?>
                                <div class="lista-item-doc row mx-0 ">
                                    <div class="col-12 col-md-2 px-0"><?php echo $o++ ?></div>
                                    <div class="col-12 col-md-2 px-0"><?php echo $versao->docVrsDataEnvio ?></div>
                                    <div class="col-12 col-md-2 track ">
                                        <span class="view" data-toggle="tooltip" data-placement="top" title="Visualizações" ><?php echo $versao->docVrsOpens ?> <i class="flaticon-visibility"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões"><?php echo $versao->docVrsPrints ?> <i class="flaticon-technology-1"></i></span>
                                    </div>
                                    <div class="col-12 col-md-3" data-toggle="popover" data-placement="top"  data-content='<input class="form-control" type="date" name="docVrsVenc" data-destino="documentos_versao" data-row="docVrsID" data-rowid="<?php echo $versao->docVrsID; ?>" data-open-panel="<?php echo $documento->docID;?>" > 
                                    <button class="btn btn-theme btn-width mt-2 modItemRec">Salvar</button>' ><?php echo $versao->docVrsVenc ?></div> 
                                    <div class="col-12 col-md-2"><?php echo $documento->docCompetencia ?></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div> 
                    <?php endforeach; ?>
                     
                </div>               
                <?php else: ?>
                    <div class="alert alert-info w-100 text-center">Não documentos para o mês</div>
                <?php endif; ?>
            </div>