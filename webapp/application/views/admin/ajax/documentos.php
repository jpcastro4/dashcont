           
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
                <div class="lista lista-docs">
                    <?php foreach($documentos as $documento) :

                    $lastVrs = $this->admin->docVersao($documento->docID)[0] ;?>

                    <div class="lista-item-doc upload-doc-rec row mx-0 " data-doc="<?php echo $documento->docID ?>">

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
                            <?php if(!empty($documento->docRec)): ?><span class="view "  data-toggle="tooltip" data-placement="top" title="Inserir recálculo" > <i class="flaticon-interface-3"></i></span><?php endif;?>
                            <a href="<?php echo $lastVrs->docVrsCaminho ?>" target="_blank"><span class="print" data-toggle="tooltip" data-placement="top" title="Abrir arquivo"> <i class="flaticon-technology-1"></i></span></a>
                        </div>
                        <div class="col-12 col-md-1">
                            <span data-toggle="tooltip" data-placement="top" title="Expandir" data-open-panel="<?php echo $documento->docID ?>"> <i class="flaticon-arrows-1"></i></span> 
                        </div>
                        <div class="col-12 lista-item-doc-painel mt-3 pb-0" data-panel="<?php echo $documento->docID ?>">
                            <div class="row w-100  lista-head mb-2">
                                <div class="col-12 col-md-2">Histórico</div>
                                <div class="col-12 col-md-2">Data do envio</div>
                                <div class="col-12 col-md-2 text-center">Track</div>
                                <div class="col-12 col-md-2">Vencimento</div>
                                <div class="col-12 col-md-2">Competência</div>
                                <div class="col-12 col-md-1"></div>
                            </div>
                            <div class="lista">

                                <?php $o = 1; foreach($this->admin->docVersao($documento->docID) as $versao ): ?>
                                <div class="lista-item-doc row">
                                    <div class="col-12 col-md-2"><?php echo $o++ ?></div>
                                    <div class="col-12 col-md-2 px-0"><?php echo date('d/m/Y H:m:s', strtotime($versao->docVrsDataEnvio))?></div>
                                    <div class="col-12 col-md-2 track ">
                                        <span class="view" data-toggle="tooltip" data-placement="top" title="Visualizações" ><?php echo $versao->docVrsOpens ?> <i class="flaticon-visibility"></i></span> <span class="print" data-toggle="tooltip" data-placement="top" title="Impressões"><?php echo $versao->docVrsPrints ?> <i class="flaticon-technology-1"></i></span>
                                    </div>
                                    <div class="col-12 col-md-2" data-toggle="popover" data-placement="top"  data-content='<input class="form-control DPvencimento" data-toggle="datepicker" type="text" placeholder="dia/mês/ano" name="docVrsVenc"> 
                                    <button class="btn btn-theme btn-width mt-2 modItem" data-destino="documentos_versao" data-row="docVrsID" data-rowid="<?php echo $versao->docVrsID; ?>" data-open-panel="<?php echo $documento->docID;?>" >Salvar</button>' ><?php echo date('d/m/Y', strtotime($versao->docVrsVenc)) ?></div> 
                                    <div class="col-12 col-md-3" data-toggle="popover" data-placement="top"  data-content='<input class="form-control DPcompetencia" data-toggle="datepicker" type="text" placeholder="mês/ano" name="docCompetencia"> 
                                    <button class="btn btn-theme btn-width mt-2 modItem" data-destino="documentos" data-row="docID" data-rowid="<?php echo $versao->docID; ?>" data-open-panel="<?php echo $documento->docID;?>">Salvar</button>'><?php echo $documento->docCompetencia ?></div>

                                    <div class="col-12 col-md-1"></div>
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