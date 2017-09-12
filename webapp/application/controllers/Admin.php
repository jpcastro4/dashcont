<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
        parent::__construct();

        $this->load->model('admin_model','admin');
    }


	public function index()
	{
		$data['titulo'] = 'Administrativo';

		$data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = '';

		//$data['emps'] = $this->admin->lista_empreendimentos();

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/index');
		$this->load->view('admin/templates/footer');
	}

	public function entrar(){

		if( $this->input->post('submit') ){

			$this->admin->entrar();
		}

		$data['title'] = 'Administrativo - Entrar';
 
        $data['mensagem'] = $this->session->flashdata('mensagem');
        $data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 
        $this->load->view('admin/login', $data);
	}


	public function bloqueios($bloqueioID=null){

		$data['titulo'] = 'Configurações - Bloqueios';
        $data['titulo_1'] = 'Configurações';
		$data['titulo_2'] = 'Bloqueios';

		$data['bloqueios'] = $this->admin->lista_bloqueios();

		if(!empty($bloqueioID)){
			
			$data['bloqueio'] = $this->admin->getBloqueio($bloqueioID);
		}

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/bloqueios');
        $this->load->view('admin/templates/footer');
	}

	
	public function tags($tagID=null){

		$data['titulo'] = 'Configurações - Tags';
        $data['titulo_1'] = 'Configurações';
		$data['titulo_2'] = 'Tags';

		if(!empty($tagID)){
			$data['tag'] = $this->admin->getTag($tagID);
		}

		$data['tags'] = $this->admin->lista_tags();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/tags');
        $this->load->view('admin/templates/footer');
	}

	public function clientes($clienteCpfCnpj=null){

		$data['titulo'] = 'Administrativo - Cliente';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Cliente';

		if(!empty($clienteCpfCnpj)){
			$data['cliente'] = $this->admin->getCliente($clienteCpfCnpj);
		}
		
		$data['clientes'] = $this->admin->lista_clientes();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/clientes');
        $this->load->view('admin/templates/footer');
	}

	public function cliente($clienteCpfCnpj){

		$data['titulo'] = 'Administrativo - Cliente';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Cliente';
		$data['arquivo'] = true;

		$data['cliente'] = $this->admin->getCliente($clienteCpfCnpj);

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/cliente');
        $this->load->view('admin/templates/footer');
	}

	public function cliente_documentos($clienteCpfCnpj){

		$data['titulo'] = 'Administrativo - Cliente';
        $data['titulo_1'] = 'Documentos do mês';
        $data['icone'] = 'flaticon-calendar';
		$data['titulo_2'] = '';
		$data['documents'] = true;

		$data['cliente'] = $this->admin->getCliente($clienteCpfCnpj);

		//$data['documentos'] = $this->admin->getDocumentos($data['cliente']->clienteID);

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/documentos');
        $this->load->view('admin/templates/footer');
	}

	public function sair(){

        $this->session->unset_userdata('user_adm_id');
        redirect('administrativo/entrar');
    }

}
