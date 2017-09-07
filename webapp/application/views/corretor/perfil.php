 
        
        <div class="container relative mb-5">

            <div class="row my-5">
                
                <div class="col-12 col-md-4 mx-auto">

                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#perfil" role="tab">Dados</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#senha" role="tab">Senha</a>
                      </li>

                    </ul>
                    <div class="tab-content">
                    <!-- <div class="contain-card p-4 "> -->
                        <div class="tab-pane active contain-card p-4" id="perfil" role="tabpanel">
                        <form action="" method="post" enctype="multipart/form-data" >   
                            <fieldset class="form-group mb-0">
                                <div class="row">
                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Nome</div>
                                        <input type="text" name="corretorNome" class="form-control" placeholder="Nome" required  value="<?php echo $corretor->corretorNome; ?>" />
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Telefone</div>
                                        <input type="text" name="corretorTelefone" class="form-control" placeholder="Telefone" required  value="<?php echo $corretor->corretorTelefone; ?>" />
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="label">E-mail</div>
                                        <input type="text" name="corretorEmail" class="form-control" placeholder="E-mail" required  value="<?php echo $corretor->corretorEmail; ?>" />
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Empresa</div>
                                        <input type="text" name="corretorEmpresa" class="form-control" placeholder="Empresa" required  value="<?php echo $corretor->corretorEmpresa; ?>" />
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="label">CRECI</div>
                                        <input type="text" name="corretorCreci" class="form-control" placeholder="CRECI" required  value="<?php echo $corretor->corretorCreci; ?>" />
                                    </div>
 
                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Insira sua senha para salvar</div>
                                        <input type="password" name="corretorSenha" class="form-control" required />
                                    </div>
                                    <div class="form-group col-12 ">
                                        <button type="submit" value="submit" name="submit" class="btn btn-theme btn-block">Salvar alterações</button>
                                    </div>

                                 </div>
                            </fieldset>
                        </form>  
                        </div>
                        <div class="tab-pane contain-card p-4" id="senha" role="tabpanel">
                        <form action="" method="post" enctype="multipart/form-data" >   
                            <fieldset class="form-group mb-0">
                                <div class="row">
                                     
                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Sua senha atual</div>
                                        <input type="password" name="corretorSenha" class="form-control" required />
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Sua nova senha</div>
                                        <input type="password" name="corretorNovaSenha" class="form-control" required />
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="label">Repita a nova senha</div>
                                        <input type="password" name="corretorNovaSenhaRepete" class="form-control" required />
                                    </div>
                                    <div class="form-group col-12 ">
                                        <button type="submit" value="submitsenha" name="submitsenha" class="btn btn-theme btn-block">Trocar senha</button>
                                    </div>

                                 </div>
                            </fieldset>
                        </form>
                        </div>
                    <!-- </div> -->
                    </div>                   
                </div>
            </div>
        </div>
        
        

