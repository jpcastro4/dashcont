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

    public function docVersao($docID){

        $this->db->where('docID',$docID);
        $this->db->order_by('docVrsDataEnvio','DESC');
        $result = $this->db->get('documentos_versao')->result();

        return $result;
    }

    public function docTags($docID){

        $this->db->where('docID',$docID);
        $result = $this->db->get('documentos_tags');

        if($result->num_rows() > 0){
            return $result->result();
        }
        return false;
    }

    public function getDocumentos($clienteID){

        $this->db->where('clienteID',$clienteID);
        $docs = $this->db->get('documentos')->result();

        return $docs;
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