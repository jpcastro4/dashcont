<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_functions extends CI_Controller {

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

        $this->load->model('admin_model','admin');
    }


	public function index()
	{
		echo 'ajax_functions';
	}

	public function statusApto(){

		$this->admin->statusApto();
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

	public function getTags(){

		$result = $this->db->get('tags');

		echo json_encode($result->result() );
		return;
	}
}
