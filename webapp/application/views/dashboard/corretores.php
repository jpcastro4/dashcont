 
        
        <div class="container relative my-5">
            <div class="row">
               <!--  <div class="col-12 py-5">
                    <h1 class="contain-title"> Lista de corretores </h1>
                </div> -->
                
                <div class="col-12">
                    <div class="contain-card p-4">
                     <?php if(!empty($corretores)): ?>
                        <table class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Nome</th>
                              <th>E-mail</th>
                              <th>Telefone</th>
                              <th>Empresa</th>
                              <th>Data do cadastro</th>
                              <th>Ult. Acesso</th>
                              <th>Status</th>
                              <th width="90">#</th>
                            </tr>
                          </thead>
                          <tbody>
                        
                        <?php $i = 1; foreach ($corretores as $corretor) : ?>
                           <tr>
                              <th scope="row"><?php echo $i++; ?></th>
                              <td><?php echo $corretor->corretorNome; ?></td>
                              <td><?php echo $corretor->corretorEmail; ?></td>
                              <td><?php echo $corretor->corretorTelefone; ?></td>
                              <td><?php echo $corretor->corretorEmpresa; ?></td>
                              <td><?php echo date('d/m/Y H:i:s', strtotime($corretor->dataCadastro) ); ?></td>
                              <td><?php if(!empty($corretor->ultimoAcesso) ) echo date('d/m/Y H:i:s', strtotime($corretor->ultimoAcesso) ); ?></td>
                              <td> <?php echo ( $corretor->corretorStatus == 1 )? '<i class="fa fa-unlock text-success"></i>': '<i class="fa fa-lock text-danger"></i>'; ?> </td>
                              <td class="edita"> <i class="fa fa-pencil fa-1x" onclick=" window.location.href='<?php echo base_url() ?>ajax_functions/editar/<?php echo $corretor->corretorID; ?>' " ></i>  <i class="fa fa-trash fa-1x" onclick=" window.location.href='<?php echo base_url() ?>ajax_functions/excluir/<?php echo $corretor->corretorID; ?>' " ></i> </td>
                            </tr>
                             
                        <?php endforeach;?>
                        </tbody>
                        </table>
                    <?php else: ?>
                        <p class="alert alert-info text-center w-100"> Não há corretores cadastrados</p>
                     <?php endif; ?>               
                    </div>
                </div>
                 
            </div>
        </div>
       
        

