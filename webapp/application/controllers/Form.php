<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
 
	public function __construct(){
        parent::__construct();

        $this->load->model('admin_model','admin');
    }


	public function index()
	{
		echo 'ajax_functions';
	}


	public function bloqueios($bloqueioID=null){
		$campos = $this->input->post();

		if(!empty($bloqueioID)){

			if(empty($campos['bloqueioAlertaEmail'])){
				$campos['bloqueioAlertaEmail'] = 0;
			}

			if(empty($campos['bloqueioAlertaSms'])){
				$campos['bloqueioAlertaSms'] = 0;
			}

			if(empty($campos['bloqueioAlertaPush'])){
				$campos['bloqueioAlertaPush'] = 0;
			} 

			$this->db->where('bloqueioID',$bloqueioID);
			$this->db->update('bloqueios', $campos );
			$this->session->set_flashdata('mensagem','Bloqueio alterado');
			redirect('admin/configuracoes/bloqueios');

		}else{
			$this->db->insert('bloqueios', $campos );
			$this->session->set_flashdata('mensagem','Bloqueio inserido');
			redirect('admin/configuracoes/bloqueios');
		}
	}

	//excluir bloqueio no ajax functions

	public function tags($tagID=null){
		$campos = $this->input->post();
		$campos['tagUrl'] = url_amigavel($campos['tagNome']);

		if(!empty($tagID)){

			$this->db->where('tagID',$tagID);
			$this->db->update('tags', $campos );
			$this->session->set_flashdata('mensagem','Tag alterada');
			redirect('admin/configuracoes/tags');			
		}else{
			//$campos['tagCor'] = randomColor();
			$this->db->insert('tags', $campos );
			$this->session->set_flashdata('mensagem','Tag inserida');
			redirect('admin/configuracoes/tags');
		}
	}

 	public function clientes($clienteCpfCnpj=null){
 		$campos = $this->input->post();

 		if(!empty($clienteCpfCnpj)){

			$this->db->where('clienteCpfCnpj',$clienteCpfCnpj);
			$this->db->update('clientes', $campos );
			$this->session->set_flashdata('mensagem','Cliente alterado');
			redirect('admin/clientes/'.$clienteCpfCnpj);

		}else{
			$this->db->insert('clientes', $campos );
			$this->session->set_flashdata('mensagem','Cliente inserido');
			redirect('admin/clientes');
		}
 	}








	public function rastreador(){

		$campos = $this->input->post();

		if(!empty($campos['edita'])){

			$rastreadorID = $campos['rastreadorID'];

			unset($campos['edita']);
			unset($campos['rastreadorID']);

			$this->db->where('rastreadorID',$rastreadorID);
			$this->db->update('rastreadores', $campos );
			redirect('admin/rastreador/'.$rastreadorID);

		}else{
			$this->db->insert('rastreadores', $campos );
			redirect('admin/rastreador/'. $this->db->insert_id() );
		}
		
	}

	public function versao(){

		$campos = $this->input->post();
 
		$rastreadorID = $campos['rastreadorID'];
 		 
		$this->db->insert('rastreadoresVersoes', $campos );
		redirect('admin/rastreador/'. $rastreadorID );
	}


	public function cliente(){

		$campos = $this->input->post();

		if(!empty($campos['edita'])){

			$clienteID = $campos['clienteID'];

			unset($campos['edita']);
			unset($campos['clienteID']);

			$this->db->where('clienteID',$clienteID);
			$this->db->update('clientes', $campos );
			redirect('admin/cliente/'.$clienteID);

		}else{

			$campos['clienteSenha'] = sha1($campos['clienteCpf']);

			$this->db->insert('clientes', $campos );
			redirect('admin/cliente/'. $this->db->insert_id() );
		}

	}

	public function veiculo(){
		
		$campos = $this->input->post();

		$clienteID = $campos['clienteID'];

		if(empty($campos['veiculoStatus'])){
			$campos['veiculoStatus'] = 0;
		} 

		if(!empty($campos['edita'])){

			$veiculoID = $campos['veiculoID'];
			unset($campos['edita']);
			unset($campos['veiculoID']);

			$this->db->where('veiculoID',$veiculoID);
			$this->db->update('veiculos', $campos );
			redirect('admin/cliente/'.$clienteID);

		}else{
			$produtos = $campos['produtos'];
			unset($campos['produtos']);

			$this->db->insert('veiculos', $campos );
			$novoVeiculo = $this->db->insert_id(); 

			foreach( $produtos as $produtoID ){

				$produto['veiculoID'] = $novoVeiculo;
				$produto['produtoID'] = $produtoID;

				$this->db->insert('veiculosProdutos', $produto );				
			}
			
			redirect('admin/cliente/'. $clienteID );
		}		
	}

	public function produto(){
		
		$campos = $this->input->post();

		if(!empty($campos['edita'])){
			
			$produtoID = $campos['produtoID'];

			unset($campos['edita']);
			unset($campos['produtoID']);

			$this->db->where('produtoID',$produtoID);
			$this->db->update('produtos', $campos );
			redirect('admin/produto/'.$produtoID);

		}else{

			if(empty($campos['produtoStatus'])){
				$campos['produtoStatus'] = 0;
			}

			$this->db->insert('produtos', $campos );
			redirect('admin/produtos/');
		}		
	}

	public function add_produto(){
		$campos = $this->input->post();

		$clienteID = $campos['clienteID'];
		unset($campos['clienteID']);
		 
		$this->db->insert('clientesProdutos', $campos);
		redirect('admin/cliente/'.$clienteID);
	}



	public function upload(){

		$this->admin->upload();
	}

	public function imagem(){

		$this->admin->imagem();
	}



	public function editar($id){
		$this->session->set_userdata('corretor_id', $id );
		redirect('administrativo/editar-corretor');
	}

	public function excluir($id){
		$this->admin->excluirCorretor($id);
	}

	public function excluir_arquivo($id){
		$this->admin->excluirArquivo($id);
	}

}
