<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
        parent::__construct();

        $this->load->model('corretor_model','corretor');
    }


	public function index()
	{
 
 		$data['pg_index'] = true;

		$this->load->view('index/templates/header', $data);
		$this->load->view('index/index');
		$this->load->view('index/templates/footer');
 
	}

	public function entrar(){

		if( $this->input->post('submit') ){

			$this->corretor->entrar();
		}

        $data['mensagem'] = $this->session->flashdata('mensagem');
        $data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');

        $this->load->view('corretor/login',$data);
 
	}
	public function empreendimento($empID){
		$this->session->set_userdata('empID',$empID);

		$data['emp'] = $this->corretor->empreendimento($empID);
		$data['arquivos'] = $this->corretor->lista_arquivos($empID);

		$data['titulo_1'] = 'Área do Corretor';
		$data['titulo_2'] = '';
		
		$this->load->view('corretor/templates/header', $data);
		$this->load->view('corretor/empreendimento');
		$this->load->view('corretor/templates/footer');
	}
	
	public function perfil(){
		$data['titulo_1'] = 'Área do Corretor';
		$data['titulo_2'] = '';

		if( $this->input->post('submit') ){

			$this->corretor->editarUsuario();
		}

		if( $this->input->post('submitsenha') ){

			$this->corretor->editarUsuarioSenha();
		}

		$data['corretor'] = $this->corretor->perfil();

		$data['mensagem'] = $this->session->flashdata('mensagem');
        $data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
		
		$this->load->view('corretor/templates/header', $data);
		$this->load->view('corretor/perfil');
		$this->load->view('corretor/templates/footer');
	}

	public function cadastrar(){

		if( $this->input->post('submit') ){

			$this->corretor->novo_usuario();
		}

		$data['titulo'] = 'Área do Corretor';


		$data['mensagem'] = $this->session->flashdata('mensagem');
        $data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
		
		$this->load->view('corretor/cadastrar', $data);
	}

	public function sair(){

        $this->session->unset_userdata('user_id');
        redirect('entrar');
    }

    public function esqueceu(){

		if( $this->input->post('submit') ){

			$this->corretor->esqueceu();
		}

        $data['mensagem'] = $this->session->flashdata('mensagem');
        $data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');

        $this->load->view('corretor/esqueceu',$data);
 
	}

	// public function email(){

	// 	$s1 = md5('jp@grupodifference.com');
 //        $s2 = 'Az';
 //        $s3 = rand(10, 55);
 //        $s4 = strtotime('now');

 //        $token = $s1.'-'.$s2.$s3.'-'.$s4;

	// 	$data['nome'] = 'João Paulo';
 //        $data['token'] = $token;
 //        $data['email'] = 'jp@grupodifference.com';

	// 	$this->load->view('email/senha',$data);
	// }


	public function recuperar($token,$email){

		$itens = explode('-', $token);

		$data['titulo'] = 'Recuperação da senha';

		if( strtotime('now') - $itens[2] > 3600 ){
			$data['tempo'] = true;
		}

		if( md5($email) != $itens[0] ){
			$data['emailInvalido'] = true;
		}

		if( $this->input->post('submit') ){

			$this->corretor->recuperarNovaSenha();
		}
		$data['email'] = $email;
		$data['url'] = base_url(uri_string());

		$data['mensagem'] = $this->session->flashdata('mensagem');
        $data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');

		$this->load->view('corretor/recuperar',$data);
	}

}
