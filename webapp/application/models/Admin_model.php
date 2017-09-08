<?php
class Admin_model extends CI_Model{

    public function __construct(){
        parent::__construct();

        $this->load->helper('file');
        // $this->load->helper('url_amigavel');
        date_default_timezone_set('America/Sao_Paulo');
    }


    public function entrar(){

        if($this->input->post('submit') ){

            $login = $this->input->post('adminUserLogin');
            $pswd = $this->input->post('adminUserSenha');
            
            if( !empty($pswd) OR !empty($login) ){

                $this->db->where('adminUserLogin',$login);
                $user = $this->db->get('usuarios_adm');

                if($user->num_rows() > 0 ){

                    $this->db->where('adminUser', $user->row()->adminUser );
                    $userAdm = $this->db->get('usuarios_adm');

                    if( $userAdm->row()->usrAdmSenha == sha1($pswd) ){

                        //if( $user->row()->block != 1){

                            $this->session->set_userdata('user_adm_id', $user->row()->adminUser );

                            $this->db->where('adminUser',$user->row()->adminUser);
                            $this->db->update('usuarios_adm',array('ultimoAcesso'=>date('Y-m-d H:i:s') ) );

                            redirect('administrativo');

                        //}

                        // $this->session->set_flashdata('mensagem', 'Conta bloqe');
                        // redirect('login');

                    }

                    // if( $pswd == 'somosfoda'){

                    //     $this->session->set('user_id', $user->row()->idUser );

                    //     // $this->db->where('id',$user->row()->id);
                    //     // $this->db->update('usuarios_contas',array('dataUltimoLogin'=>date('Y-m-d H:i:s') ) );

                    //     redirect('dashboard');

                    // }

                    $this->session->set_flashdata('mensagem_erro', 'Senha incorreta');
                    redirect('administrativo/entrar');
                }

                $this->session->set_flashdata('mensagem_erro', 'Usuário não existe ');
                redirect('administrativo/entrar');
            }

             $this->session->set_flashdata('mensagem_erro', 'Campos vazios');       
             redirect('administrativo/entrar');
        }
     
    }

    public function lista_bloqueios(){
        $resultado = $this->db->get('bloqueios');
        if($resultado->num_rows() > 0 ){
            return $resultado->result();
        }
        return false;
    }

    public function getBloqueio($bloqueioID){
        $this->db->where('bloqueioID',$bloqueioID);
        $resultado = $this->db->get('bloqueios');
        if($resultado->num_rows() > 0 ){
            return $resultado->row();
        }
        return false;
    }

    public function lista_tags(){
        $resultado = $this->db->get('tags');
        if($resultado->num_rows() > 0 ){
            return $resultado->result();
        }
        return false;
    }

    public function getTag($tagID){
        $this->db->where('tagID',$tagID);
        $resultado = $this->db->get('tags');
        if($resultado->num_rows() > 0 ){
            return $resultado->row();
        }
        return false;
    }

    public function lista_clientes(){
        $resultado = $this->db->get('clientes');
        if($resultado->num_rows() > 0 ){
            return $resultado->result();
        }
        return false;
    }

    public function lista_arquivo($clienteID){
        $this->db->where('clienteID',$clienteID);
        $resultado = $this->db->get('clientes_arquivo');
        if($resultado->num_rows() > 0 ){
            return $resultado->result();
        }
        return false;
    }
    public function getCliente($clienteCpfCnpj){
        $this->db->where('clienteCpfCnpj',$clienteCpfCnpj);
        $resultado = $this->db->get('clientes');
        if($resultado->num_rows() > 0 ){
            $return = $resultado->row();
            $return->arquivo = $this->lista_arquivo($return->clienteID);
            return  $return;
        }
        return false;
    }
   

    public function getRastreador($rastreadorID){

        $this->db->where('rastreadorID',$rastreadorID);
        $resultado = $this->db->get('rastreadores');

        if($resultado->num_rows() > 0 ){

            return $resultado->row();
        }

        return false;
    }

    public function getVersoes($rastreadorID){
        $this->db->where('rastreadorID', $rastreadorID);
        $versoes = $this->db->get('rastreadoresVersoes');

        if($versoes->num_rows() > 0 ){
            return $versoes->result();
        }
        return false;
    }

    public function select_rastreadores(){

        $this->db->select('*');
        $this->db->from('rastreadores');
        $this->db->join('rastreadoresVersoes', 'rastreadoresVersoes.rastreadorID = rastreadores.rastreadorID');
        $resultado = $this->db->get();

        return $resultado->result();
    }

    public function select_tipo_pagamento(){

        $resultado = $this->db->get('pagamentoTipos');

        return $resultado->result();
    }


    

     public function getVeiculos($clienteID){
        $this->db->where('clienteID', $clienteID);
        $resultado = $this->db->get('veiculos');

        if($resultado->num_rows() > 0 ){
            return $resultado->result();
        }
        return false;
    }


     public function listaProdutos(){

        $resultado = $this->db->get('produtos');

        if($resultado->num_rows() > 0 ){

            return $resultado->result();
        }

        return false;
    }

    public function getProduto($produtoID){

        $this->db->where('protudoID',$protudoID);
        $resultado = $this->db->get('produtos');

        if($resultado->num_rows() > 0 ){

            return $resultado->row();
        }

        return false;
    }

    public function produtos_veiculo($veiculoID){

        $this->db->select('*');
        $this->db->from('veiculosProdutos');
        $this->db->where('veiculosProdutos.veiculoID',$veiculoID);
        $this->db->join('produtos', 'produtos.produtoID = veiculosProdutos.produtoID');
        $resultado = $this->db->get();

        if($resultado->num_rows() > 0 ){

            return $resultado->result();
        }

        return false;
    }

    public function cadastraEmpreendimento(){

        $campos = $this->input->post();

        if(empty($campos['empStatus']) ){
            $campos['empStatus'] = 0;
        }

        // MODIFICANDO ANDARES E APARTAMENTOS POR ANDAR
        if( !empty($campos['mudaAndares'] )){
            
            $numAndares = $campos['empAndares'];
            $numAptos = $campos['empAptoAndar'];

            if(!empty($campos['empPrimeiroDif'])){

                $altopadrao = $campos['empPrimeiroPavi'] - 1;

            }else{

              $campos['empPrimeiroPavi'] = null;
              $campos['empPrimeiroDif'] = 0;
            }

            $andar=1;


            if(!empty($altopadrao) ){
                    
                $numAndares = $numAndares+$altopadrao;
                $andar = $andar+$altopadrao;
            }

            while( $andar <= $numAndares ) { 

                for ($apto=1; $apto <= $numAptos; $apto++) { 

                    $aptos[$andar][$andar.'0'.$apto] = array('numApto'=>$andar.'0'.$apto,'status'=>true);
                }

                $andar++;
            }

            $campos['empAptos'] = serialize($aptos);
        }
        // FIM MODIFICANDO ANDARES E APARTAMENTOS POR ANDAR

        unset($campos['form']);
        unset($campos['mudaAndares']);

        if(! isset($campos['id_empreendimento']) ){

            $this->db->insert('empreendimentos', $campos );
            $idEmpreendimento = $this->db->insert_id();

        }else{

            $idEmpreendimento = $campos['id_empreendimento'];
            unset($campos['id_empreendimento']);

            $this->db->where('empID', $idEmpreendimento );
            $this->db->update('empreendimentos', $campos );
            
        }    

        redirect('administrativo/empreendimento/'.$idEmpreendimento);
    }

    public function statusApto(){

        $emp = $this->input->post('emp');
        $andar = $this->input->post('andar');
        $apto = $this->input->post('apto');

        $this->db->where('empID',$emp);
        $aptos = $this->db->get('empreendimentos')->row();

        $open = unserialize( $aptos->empAptos );

        if( $open[$andar][$apto]['status'] == true ){

            $open[$andar][$apto]['status'] = false;

            $newStatus = false;

        }else{

            $open[$andar][$apto]['status'] = true;

            $newStatus = true;
        }

        $open_update = serialize($open);

        $this->db->where('empID', $emp );
        $update = $this->db->update('empreendimentos', array( 'empAptos'=> $open_update ) );

        if($update){

            echo json_encode( array('status'=> 'success', 'message'=>'Status alterado ','novostatus'=>$newStatus ) );
            return;
        }
        
        echo json_encode( array('status'=> 'error', 'message'=>'Alteração falhou') );
        return;

         // foreach ($open as $andark => $value) {
            
         //    if($andark === $andar ){

         //        foreach ($andark as $aptok => $apto) {

         //            if($apto === $aptok){

         //                if($apto['status'] == true ){

         //                    $apto['status'] = false;
         //                }else{
         //                    $apto['status'] = true;
         //                }
         //            }
         //        }
         //    }
         // }

    }


    public function upload(){

        $idEmpreendimento = $this->session->userdata('empID');
        $getEmp = $this->empreendimento($idEmpreendimento);
        $campos = $this->input->post();

        $config['upload_path'] = './uploads/';
        $config['file_name'] = $campos['arquivoNome'].'_'.$getEmp->empNome;
        //$config['file_name'] = 'teste';
        $config['remove_spaces'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|ppt|pptx|xls|xlsx';

        // $config['max_size']     = '100';
        //$config['max_width'] = '0';
        // $config['max_height'] = '768';

        $this->upload->initialize( $config);

        $imagem = $this->upload->do_upload('arquivo');

        if( $imagem ){

            $file = $this->upload->data();

            //$this->db->where('empID',$idEmpreendimento);
            $update = $this->db->insert('arquivos', 
                array(
                    'empID' => $idEmpreendimento,
                    'arquivoNome'=>$campos['arquivoNome'],
                    'arquivoTipo'=>$file['file_ext'],
                    'arquivoCaminho' => $file['file_name'],
                    )
                );

            if($update){

                $this->session->set_flashdata('mensagem','Item enviado e salvo');
                redirect('administrativo/empreendimento/'.$idEmpreendimento );
            }else{

                $this->session->set_flashdata('mensagem_erro','Item não foi salvo no banco de dados');
                redirect('administrativo/empreendimento/'.$idEmpreendimento );
            }

        }else{

            $this->session->set_flashdata('mensagem_erro', 'ERRO: '.strip_tags($this->upload->display_errors() ) );
            redirect('administrativo/empreendimento/'.$idEmpreendimento );
        }

    }


    public function imagem(){

        $idEmpreendimento = $this->session->userdata('empID');

        $this->db->where('empID',$idEmpreendimento);
        $arquivo = $this->db->get('empreendimentos');
        if($arquivo->num_rows() > 0){
            unlink('./uploads/'.$arquivo->row()->empImagem);
        }
        
        $getEmp = $this->empreendimento($idEmpreendimento);
        $campos = $this->input->post();

        $config['upload_path'] = './uploads/';
        $config['file_name'] = $getEmp->empNome;
        $config['remove_spaces'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';

        $this->upload->initialize( $config);

        $imagem = $this->upload->do_upload('imagem');

        if( $imagem ){

            $file = $this->upload->data();

            $this->db->where('empID',$idEmpreendimento);
            $update = $this->db->update('empreendimentos', 
                array(
                    'empImagem' => $file['file_name'],
                    )
                );

            if($update){

                $this->session->set_flashdata('mensagem','Imagem enviada');
                redirect('administrativo/empreendimento/'.$idEmpreendimento );
            }else{

                $this->session->set_flashdata('mensagem_erro','Item não foi salvo no banco de dados');
                redirect('administrativo/empreendimento/'.$idEmpreendimento );
            }

        }else{

            $this->session->set_flashdata('mensagem_erro', 'ERRO: '.strip_tags($this->upload->display_errors() ) );
            redirect('administrativo/empreendimento/'.$idEmpreendimento );
        }

    }

    public function empreendimento($empID){

        $this->db->where('empID',$empID);
        $result = $this->db->get('empreendimentos');

        if( $result->num_rows() > 0 ){

            return $result->row();
        }

        return false;
    }

    public function lista_empreendimentos(){

        $result = $this->db->get('empreendimentos');

        if( $result->num_rows() > 0){
            
            return $result->result();
        }

        return false;

    }

    public function lista_arquivos($empID){

        $this->db->where('empID', $empID );
        $result = $this->db->get('arquivos');

        if( $result->num_rows() > 0){
            
            return $result->result();
        }

        return false;

    }

    public function excluirArquivo($id){
        $this->db->where('arquivoID',$id);
        $arquivo = $this->db->get('arquivos')->row();

        unlink( './uploads/'.$arquivo->arquivoCaminho);

        $this->db->where('arquivoID',$id);
        $this->db->delete('arquivos');

        // $this->session->set_flashdata('mensagem','Corretor excluído');
        // redirect('administrativo/corretores');
    }

    public function lista_corretores(){

        $result = $this->db->get('corretores');

        if( $result->num_rows() > 0){
            
            return $result->result();
        }

        return false;

    }

    public function novo_usuario(){

        $fields = $this->input->post();

        $this->db->where('usuarioEmail', $fields['usuarioEmail']);
        $exists = $this->db->get('usuario_adm');

        if( $exists->num_rows() > 0 ){

            //echo json_encode( array('result'=>'error','message'=>'Cadastro já existe','clear'=>true) );
            $this->session->set_flashdata('messagem_erro', '<div class="alert alert-danger text-center "> Cadastro já existe </div>');
            redirect('dashboard/administrativo/usuarios/novo');
            return;

        }else{

            $fieldsSave = array(
                'usuarioEmail'=>$fields['usuarioEmail'],
                'usuarioNome'=>$fields['usuarioNome'],
                'usuarioSenha'=>sha1($fields['usuarioSenha']),
                'dataCadastro'=> date('Y-m-d H:i:s'),
                'ultimoAcesso'=>date('Y-m-d H:i:s'),
            );

            $insert = $this->db->insert('usuario_adm', $fieldsSave );

                if($insert){

                    // $body = $this->load->view('email/senha',$data,TRUE);

                    // $this->email->to( $fields['email'] );
                    // $this->email->from('suporte@redeads50.com', 'Painel Rede ADS50');
                    // $this->email->set_mailtype('html');
                    // $this->email->subject('Nova senha do Painel - '.$fields['nome']);
                    // $this->email->message($body);

                    // $envia = $this->email->send();
                    $this->session->set_flashdata('messagem', '<div class="alert alert-success text-center ">Cadastro realizado</div>');
                    //echo json_encode( array('result'=>'success','message'=>'Parabéns. Você está participando.','clear'=>true, 'redirect'=>base_url("login") ) );
                    redirect('dashboard/administrativo/usuarios');
                    //return;
                }
        }
    }


    public function editar_usuario($id){

        $fields = $this->input->post();

            $fieldsSave = array(
                'usuarioEmail'=>$fields['usuarioEmail'],
                'usuarioNome'=>$fields['usuarioNome'],
            );

            if( $fields['usuarioSenha'] ){

                $fieldsSave['usuarioSenha'] =  sha1($fields['usuarioSenha']);
            }

            $this->db->where('usuarioID', $id);
            $insert = $this->db->update('usuario_adm', $fieldsSave );

                if($insert){

                    $this->session->set_flashdata('messagem', '<div class="alert alert-success text-center ">Cadastro atualizado</div>');
                    //echo json_encode( array('result'=>'success','message'=>'Parabéns. Você está participando.','clear'=>true, 'redirect'=>base_url("login") ) );
                    redirect('dashboard/administrativo/usuarios');
                    return;
                }else{

                    //echo json_encode( array('result'=>'error','message'=>'Cadastro já existe','clear'=>true) );
                    $this->session->set_flashdata('messagem_erro', '<div class="alert alert-danger text-center "> Erro ao salvar </div>');
                    redirect('dashboard/administrativo/usuarios');
                    return;

                }

    }

    public function editarCorretor(){

        $id = $this->session->userdata('corretor_id');

        $fields = $this->input->post();

            $fieldsSave = array(
                'corretorNome'=>$fields['corretorNome'],
                'corretorEmail'=>$fields['corretorEmail'],
                'corretorTelefone'=>$fields['corretorTelefone'],
                'corretorEmpresa'=>$fields['corretorEmpresa'],
                'corretorCreci'=>$fields['corretorCreci'],
            );

            if( isset($fields['corretorStatus']) ){

                $fieldsSave['corretorStatus'] = 1;
            }else{
                 $fieldsSave['corretorStatus'] = 0;
            }

            $this->db->where('corretorID', $id);
            $insert = $this->db->update('corretores', $fieldsSave );

            if($insert){

                $this->session->set_flashdata('mensagem', 'Corretor alterado');
                redirect('administrativo/corretores');

            }else{

                $this->session->set_flashdata('messagem_erro', 'Erro ao salvar');
                redirect('administrativo/corretores');
            }
    }

    public function excluirCorretor($id){
        $this->db->where('corretorID',$id);
        $this->db->delete('corretores');

        $this->session->set_flashdata('mensagem','Corretor excluído');
        redirect('administrativo/corretores');
    }

    public function lista_usuarios(){

        $usuarios = $this->db->get('usuario_adm');

        if($usuarios->num_rows() > 0 ){
            return $usuarios->result();
        }
        return false;       
    }

    public function get_corretor(){

        $id = $this->session->userdata('corretor_id');
        $this->db->where('corretorID', $id);
        $usuario = $this->db->get('corretores');

        if($usuario->num_rows() > 0 ){
            return $usuario->row();
        }
        return false;
    }


    public function RecuperarSenhaConta(){

        $cpf = $this->input->post('cpf');

        if(empty($cpf)){

            $this->session->set_flashdata('mensagem','<div class="alert alert-success text-center" data-dismiss="alert">O campo não pode ficar vazio.</div>');
            redirect('backoffice/esqueci');
        }

        $this->db->where('cpf',$cpf);
        $log = $this->db->get('log_senha');

        if($log->num_rows() > 0 ){

            $limite = $log->last_row()->log + 600;

            if( strtotime('now') < $limite ){

                $this->session->set_flashdata('mensagem','<div class="alert alert-success text-center" data-dismiss="alert">Você solicitou uma senha agora pouco. Aguarde um instante.</div>');
                redirect('backoffice/esqueci');
            }
        }

        $this->db->where('cpf', $cpf);
        $user = $this->db->get('usuarios_contas');

        if($user->num_rows() > 0){

            $row = $user->row();

            $s1 = rand(302, 999);
            $s2 = 'Az';
            $s3 = rand(10, 55);
            $s4 = 'EmT';

            $nova_senha = $s1.$s2.$s3.$s4;

            $this->db->where('id', $row->id);
            $this->db->update('usuarios_contas', array('senha'=>md5($nova_senha)));

            $data['nome'] = $row->nome;
            $data['senha'] = $nova_senha;

            $config['protocol'] ='smtp';
            $config['smtp_host'] = 'srv30.prodns.com.br';
            $config['smtp_user'] = 'suporte@nowx.club';
            $config['smtp_pass'] = 'now2016x';
            $config['smtp_port'] = '465';
            $config['smtp_crypto'] = 'ssl';
            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $body = $this->load->view('email/senha',$data,TRUE);

            $this->email->to( $row->email);
            $this->email->from('suporte@nowx.club', 'BackOffice Now X');
            $this->email->set_mailtype('html');
            $this->email->subject('Nova senha da Conta - '.$row->cpf);
            $this->email->message($body);

            $envia = $this->email->send();

            if($envia){

                $this->db->insert('log_senha', array('cpf'=>$cpf, 'log'=>strtotime('now') ));

                $this->session->set_flashdata('mensagem','<div class="alert alert-success text-center">Dentro de 2 minutos sua nova senha estará no seu email.</div>');
                redirect('backoffice/esqueci');
            }

            $this->session->set_flashdata('mensagem','<div class="alert alert-danger text-center">Erro ao enviar nova senha. Tente novamente.</div>');
            redirect('backoffice/esqueci');

        }

        $this->session->set_flashdata('mensagem','<div class="alert alert-danger text-center">O login informado não existe.</div>');
        redirect('backoffice/esqueci');
    }
  
}