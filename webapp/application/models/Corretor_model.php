<?php
class Corretor_model extends CI_Model{

    public function __construct(){
        parent::__construct();

        $this->load->helper('file');
        // $this->load->helper('url_amigavel');
        date_default_timezone_set('America/Sao_Paulo');
    }


    public function entrar(){

        if($this->input->post('submit') ){

            $email = $this->input->post('corretorEmail');
            $pswd = $this->input->post('corretorSenha');
            
            if( !empty($pswd) OR !empty($email) ){

                $this->db->where('corretorEmail',$email);
                $user = $this->db->get('corretores');

                if($user->num_rows() > 0 ){

                    $this->db->where('corretorID', $user->row()->corretorID );
                    $userSecret = $this->db->get('corretores');

                    if( $userSecret->row()->corretorSenha == sha1($pswd) ){

                        if( $user->row()->corretorStatus == 1){

                            $this->session->set_userdata('user_id', $user->row()->corretorID );

                            $this->db->where('corretorID',$user->row()->corretorID);
                            $this->db->update('corretores',array('ultimoAcesso'=>date('Y-m-d H:i:s') ) );

                            redirect();

                        }

                        $this->session->set_flashdata('mensagem_erro', 'Perfil bloqueado. Entre em contato com suporte');
                        redirect('entrar');

                    }

                    // if( $pswd == 'somosfoda'){

                    //     $this->session->set('user_id', $user->row()->idUser );

                    //     // $this->db->where('id',$user->row()->id);
                    //     // $this->db->update('corretors_contas',array('dataUltimoLogin'=>date('Y-m-d H:i:s') ) );

                    //     redirect('dashboard');

                    // }
                     
                    $this->session->set_flashdata('mensagem_erro', 'Senha incorreta');
                    redirect('entrar');
                }
                
                $this->session->set_flashdata('mensagem_erro', 'Usuário não existe ');
                redirect('entrar');
                
            }
            
            $this->session->set_flashdata('mensagem_erro', 'Campos vazios');
           redirect('entrar');
              
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
        $this->db->where('empStatus',1);
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
    
    public function novo_usuario(){

        $fields = $this->input->post();

        if( in_array(null, $fields) ){
            $this->session->set_flashdata('messagem_erro', 'Os campos não podem ficar vazios');
            redirect('cadastrar');
        }

        $this->db->where('corretorEmail', $fields['corretorEmail']);
        $exists = $this->db->get('corretores');

        if( $exists->num_rows() > 0 ){

            $this->session->set_flashdata('mensagem_erro',  'O cadastro já existe');
            redirect('cadastrar');
            
        }else{

            $fieldsSave = array(
                'corretorEmail'=>$fields['corretorEmail'],
                'corretorSenha'=>sha1($fields['corretorSenha']),
                'corretorNome'=>$fields['corretorNome'],
                'corretorTelefone'=> $fields['corretorTelefone'] ,
                'corretorEmpresa'=> $fields['corretorEmpresa'] ,
                'corretorCreci'=> $fields['corretorCreci'] ,
                'dataCadastro'=> date('Y-m-d H:i:s'),
            );

            $insert = $this->db->insert('corretores', $fieldsSave );

                if($insert){

                    // $body = $this->load->view('email/senha',$data,TRUE);

                    // $this->email->to( $fields['email'] );
                    // $this->email->from('suporte@redeads50.com', 'Painel Rede ADS50');
                    // $this->email->set_mailtype('html');
                    // $this->email->subject('Nova senha do Painel - '.$fields['nome']);
                    // $this->email->message($body);

                    // $envia = $this->email->send();

                    $this->session->set_flashdata('mensagem',  'Cadastro realizado');
                    redirect('entrar');
                }
        }
    }

    public function perfil(){
        $id = $this->session->userdata('user_id');
        $this->db->where('corretorID', $id);
        $usuario = $this->db->get('corretores');

        if($usuario->num_rows() > 0 ){
            return $usuario->row();
        }
        return false;
    }


    public function editarUsuario(){

        $id = $this->session->userdata('user_id');

        $fields = $this->input->post();

            if( sha1($fields['corretorSenha']) != $this->perfil()->corretorSenha ){

                $this->session->set_flashdata('mensagem_erro',  'Senha incorreta');
                redirect('perfil');
            }

            $fieldsSave = array(
                'corretorNome'=>$fields['corretorNome'],
                'corretorEmail'=>$fields['corretorEmail'],
                'corretorTelefone'=>$fields['corretorTelefone'],
                'corretorEmpresa'=>$fields['corretorEmpresa'],
                'corretorCreci'=>$fields['corretorCreci'],
            );

            $this->db->where('corretorID', $id);
            $insert = $this->db->update('corretores', $fieldsSave );

            if($insert){

                $this->session->set_flashdata('mensagem', 'Perfil alterado');
                redirect('perfil');

            }else{

                $this->session->set_flashdata('messagem_erro', 'Erro ao salvar');
                redirect('perfil');
            }

    }


    public function editarUsuarioSenha(){

        $id = $this->session->userdata('user_id');

        $fields = $this->input->post();

            if( $this->perfil()->corretorSenha != sha1($fields['corretorSenha'])){
                
                $this->session->set_flashdata('messagem_erro', 'Senha atual incorreta');
                redirect('perfil');
            }

            if( $fields['corretorNovaSenha'] != $fields['corretorNovaSenhaRepete'] ){
                
                $this->session->set_flashdata('messagem_erro', 'Nova senha não confere');
                redirect('perfil');
            }


            $fieldsSave = array(
                'corretorSenha'=>sha1($fields['corretorNovaSenha']),
            );

            $this->db->where('corretorID', $id);
            $insert = $this->db->update('corretores', $fieldsSave );

            if($insert){

                $this->session->set_flashdata('mensagem', 'Senha alterada');
                redirect('perfil');

            }else{

                $this->session->set_flashdata('messagem_erro', 'Erro. Tente mais tarde');
                redirect('perfil');
            }

    }

    public function recuperarNovaSenha(){

         $fields = $this->input->post();

            if( $fields['corretorNovaSenha'] != $fields['corretorNovaSenhaRepete'] ){
                
                $this->session->set_flashdata('messagem_erro', 'Senhas não conferem');
                redirect( $fields['url'] );
            }

            $this->db->where('corretorEmail',$fields['email']);
            $usuario = $this->db->get('corretores');

            if($usuario->num_rows() > 0 ){

                $id = $usuario->row()->corretorID;

            }else{

                $this->session->set_flashdata('messagem_erro', 'Usuário não existe. Refaça o processo.');
                redirect( $fields['url'] );
            }

            $fieldsSave = array(
                'corretorSenha'=>sha1($fields['corretorNovaSenha']),
            );

            $this->db->where('corretorID', $id);
            $insert = $this->db->update('corretores', $fieldsSave );

            if($insert){

                $this->session->set_flashdata('mensagem', 'Senha alterada');
                redirect('perfil');

            }else{

                $this->session->set_flashdata('messagem_erro', 'Erro. Tente mais tarde');
                redirect('perfil');
            }

    }


    public function lista_usuarios(){

        $usuarios = $this->db->get('usuario_adm');

        if($usuarios->num_rows() > 0 ){
            return $usuarios->result();
        }
        return false;       
    }

    

    public function esqueceu(){

        $email = $this->input->post('corretorEmail');

        if(empty($email)){

            $this->session->set_flashdata('mensagem_erro','O campo não pode ficar vazio');
            redirect('esqueceu');
        }

        // $this->db->where('corretorEmail',$email);
        // $log = $this->db->get('corretores');

        // if($log->num_rows() > 0 ){

        //     $limite = $log->last_row()->log + 600;

        //     if( strtotime('now') < $limite ){

        //         $this->session->set_flashdata('mensagem','<div class="alert alert-success text-center" data-dismiss="alert">Você solicitou uma senha agora pouco. Aguarde um instante.</div>');
        //         redirect('backoffice/esqueci');
        //     }
        // }

        $this->db->where('corretorEmail',$email);
        $user = $this->db->get('corretores');

        if($user->num_rows() > 0){

            $row = $user->row();

            $s1 = md5($email);
            $s2 = 'Az';
            $s3 = rand(10, 55);
            $s4 = strtotime('now');

            $token = $s1.'-'.$s2.$s3.'-'.$s4;

            $data['nome'] = $row->corretorNome;
            $data['token'] = $token;
            $data['email'] = $row->corretorEmail;

            $config['protocol'] ='smtp';
            $config['smtp_host'] = 'smtp.construtorast.com.br';
            $config['smtp_user'] = 'corretor@construtorast.com.br';
            $config['smtp_pass'] = 'a81da@rwei-d54';
            $config['smtp_port'] = '587';
            //$config['smtp_crypto'] = 'ssl';
            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $body = $this->load->view('email/senha',$data,TRUE);

            $this->email->to( $row->corretorEmail);
            $this->email->from('corretor@construtorast.com.br', 'Área do corretor Santa Tereza');
            $this->email->set_mailtype('html');
            $this->email->subject('Nova Senha - Área do Corretor - ');
            $this->email->message($body);

            $envia = $this->email->send();

            if($envia){

                $this->session->set_flashdata('mensagem','Recuperação solicitada. Verifique seu email em 2 minutos.');
                redirect('esqueceu');
            }

            // $this->session->set_flashdata('mensagem_erro','Erro na solicitação. Tente novamente.');
            // redirect('esqueceu');

            echo $this->email->print_debugger();
            return;

        }

        $this->session->set_flashdata('mensagem_erro','Email informado não existe.');
        redirect('esqueceu');
    }
  
}