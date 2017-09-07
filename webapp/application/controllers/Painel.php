<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function __construct(){
        parent::__construct();

        $this->load->model('dashboard_model','dashboard');
    }


	public function index()
	{
		$data['title'] = 'Administrativo';

		$data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = '';

		//$data['emps'] = $this->admin->lista_empreendimentos();

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/index');
		$this->load->view('admin/templates/footer');
	}

	public function map(){

		$data['title'] = 'Mapa';
		$data['head'] = (object) array('title'=>'Mapa','icon'=>'fa fa-map fa-align-right');

		$data['pg_map'] = true;

		$clienteID = $this->session->userdata('cliente_id');
		$data['veiculos'] = $this->dashboard->getVeiculos($clienteID);
		
		$this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/realtime');
        $this->load->view('dashboard/templates/footer');

	}

	public function account(){

		$data['title'] = 'Conta';
		$data['head'] = (object) array('title'=>'Conta','icon'=>'flaticon-circle-2');
		
		$data['pg_account'] = true;

		$clienteID = $this->session->userdata('cliente_id');
		$data['cliente'] = $this->dashboard->getCliente($clienteID);

		//$data['veiculos'] = $this->dashboard->getVeiculos($clienteID);
		 
		$this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/account');
        $this->load->view('dashboard/templates/footer');

	}

	public function vehicles($placa=null){

		$data['title'] = 'Meus veículos';
		$data['head'] = (object) array('title'=>'Veículos','icon'=>'flaticon-car-1');
		
		$data['pg_account'] = true;

		$clienteID = $this->session->userdata('cliente_id');
		
		$data['cliente'] = $this->dashboard->getCliente($clienteID);
		$data['veiculos'] = $this->dashboard->getVeiculos($clienteID);

		$data['veiculo'] = $this->dashboard->getVeiculo($placa);

		$this->load->view('dashboard/templates/header', $data);
        $this->load->view('dashboard/vehicles');
        $this->load->view('dashboard/templates/footer');

	}


	public function login(){

		if( $this->input->post('submit') ){

			$this->dashboard->login();
		}

		$data['title'] = 'Área do cliente - Login';
 
        $data['mensagem'] = $this->session->flashdata('mensagem');
        $data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 
        $this->load->view('dashboard/login', $data);
 
	}

	public function rastreadores(){

		$data['titulo'] = 'Rasteradores';
        $data['titulo_1'] = 'Rastreadores';
		$data['titulo_2'] = '';

		//$data['rasteradores'] = $this->admin->lista_corretores();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/rastreadores');
        $this->load->view('admin/templates/footer');
	}

	public function rastreador($rastreadorID){

		$data['titulo'] = 'Rasteradores - Versões';
        $data['titulo_1'] = 'Rastreadores';
		$data['titulo_2'] = 'Versões';

		$data['rastreador'] = $this->admin->getRastreador($rastreadorID);
		$data['versoes'] = $this->admin->getVersoes($rastreadorID);

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/rastreador');
        $this->load->view('admin/templates/footer');
	}

	public function clientes(){

		$data['titulo'] = 'Administrativo - Clientes';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Clientes';

		$data['clientes'] = $this->admin->listaClientes();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/clientes');
        $this->load->view('admin/templates/footer');
	}

	public function cliente($clienteID){

		$data['titulo'] = 'Administrativo - Cliente';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Cliente';

		$data['cliente'] = $this->admin->getCliente($clienteID);
		$data['veiculos'] = $this->admin->getVeiculos($clienteID);

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/cliente');
        $this->load->view('admin/templates/footer');
	}

	public function veiculo($clienteID){

		$data['titulo'] = 'Administrativo - Cliente';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Cliente';

		$data['cliente'] = $this->admin->getCliente($clienteID);

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/cliente');
        $this->load->view('admin/templates/footer');
	}


	public function produtos(){

		$data['titulo'] = 'Administrativo - produtos';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'produtos';

		$data['produtos'] = $this->admin->listaProdutos();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/produtos');
        $this->load->view('admin/templates/footer');
	}

	public function produto($produtoID){

		$data['titulo'] = 'Administrativo - Produto';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Produto';

		$data['produto'] = $this->admin->getProduto($produtoID);
		
		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/produto');
        $this->load->view('admin/templates/footer');
	}

	public function corretores(){

		$data['title'] = 'Administrativo - Corretores';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Corretores';

		$data['corretores'] = $this->admin->lista_corretores();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/corretores');
        $this->load->view('admin/templates/footer');
	}
	
	public function editar_corretor(){

		if($this->input->post('submit')){

			$this->admin->editarCorretor();
		}

		$data['title'] = 'Administrativo - Corretores';
        $data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Corretores';

		$data['corretor'] = $this->admin->get_corretor();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
 		
 		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/corretor');
        $this->load->view('admin/templates/footer');
	}

	public function cadastro_empreendimento(){

		if( $this->input->post('form') ){

			$this->admin->cadastraEmpreendimento();
		}
		$data['title'] = 'Administrativo - Cadastro de empreendientos';

		$data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Novo empreendimento';

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/empreendimento-novo');
		$this->load->view('admin/templates/footer');
	}

	public function empreendimento($empID){

		if( $this->input->post('form') ){

			$this->admin->cadastraEmpreendimento();
		}

		$this->session->set_userdata('empID',$empID);

		$data['emp'] = $this->admin->empreendimento($empID);
		$data['arquivos'] = $this->admin->lista_arquivos($empID);

		$data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Empreendimento';

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/empreendimento');
		$this->load->view('admin/templates/footer');
	}

	public function empreendimentos(){

		$data['titulo_1'] = 'Administrativo';
		$data['titulo_2'] = 'Empreendimentos';

		$data['emps'] = $this->admin->lista_empreendimentos();

		$data['mensagem'] = $this->session->flashdata('mensagem');
		$data['mensagem_erro'] = $this->session->flashdata('mensagem_erro');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/empreendimentos');
		$this->load->view('admin/templates/footer');
	}

	public function sair(){

        $this->session->unset_userdata('user_adm_id');
        redirect('administrativo/entrar');
    }

}
