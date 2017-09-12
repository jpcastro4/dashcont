<?php
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

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
 		$campos['clienteDataUltAlt'] = date('Y-m-d H:i:s');
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

 	public function awsCredential(){
 		
 		$credentials = new Aws\Credentials\Credentials('AKIAJLFAEOQ2E6TG24AA', 'DjEcSxbz+0I7rgy/577l+f+7MOwwPLcUnl/l/Nva');		 

 		$client = new Aws\S3\S3Client([
		    'version'     => 'latest',
		    'region'      => 'sa-east-1',
		    'credentials' => $credentials
		]);
 		
		return $client;
		 
 	}

 
 	public function uploadFileS3($cliente){

 		// echo json_encode( $this->input->post('filename')  );
 		// return;

 		$filename 	= $this->input->post('filename');
 		$file 		= explode(",", $this->input->post('file') );
 		$nome 		= $this->input->post('nome');

 		$keyName 	= md5($filename).rand(5,15);

 		$bucket 	= 'dashcont';
		$key 		= $cliente.'/'.$keyName;
		$fileData 	= base64_decode( end($file) );

 		$client 	= $this->awsCredential();		
		$upload 	= $client->upload($bucket, $key, $fileData, 'public-read');
		$caminho 	= $upload->get('ObjectURL');

		if($upload){
			$this->db->where('clienteCpfCnpj',$cliente);
	 		$clienteID = $this->db->get('clientes')->row()->clienteID;
	 		
			$insert = array(
				'clienteID'=>$clienteID,
				'arquivoNome'=>$nome,
				'arquivoAwsKey'=>$keyName,
				'arquivoCaminho'=>$caminho,
				'arquivoDataEnvio'=>date('Y-m-d H:i:s')
				);

		 	$this->db->insert('clientes_arquivo', $insert );

		 	echo json_encode( array('status'=>TRUE ) );
		 	return;

		 }else{

		 	echo json_encode( array('status'=>FALSE ) );
		 	return;
		 }	 	
 	}


 	public function uploadDocS3($cliente){

 		echo var_dump($this->input->post() );
 		return;
 		
 		$nome 		= $this->input->post('docNome');
 		$tags 		= (object) $this->input->post('tags');
 		$vencimento = $this->input->post('docVrsVenc');

 		$filename 	= $this->input->post('filename');
 		$file 		= explode(",", $this->input->post('file') );
 		$keyName 	= md5($filename).rand(5,15);

 		$bucket 	= 'dashcont';
		$key 		= $cliente.'/'.$keyName;
		$fileData 	= base64_decode( end($file) );

 		$client 	= $this->awsCredential();		
		$upload 	= $client->upload($bucket, $key, $fileData, 'public-read');
		$caminho 	= $upload->get('ObjectURL');

		if($upload){

			$this->db->where('clienteCpfCnpj',$cliente);
	 		$clienteID = $this->db->get('clientes')->row()->clienteID;

			$insertFile = array(
				'clienteID'=>$clienteID,
				'docNome'=>$nome,
				'docDataUltAlt'=>date('Y-m-d H:i:s'),
				);

			if( !empty($this->input->post('docRec') ) ){
	 			$insertFile['docRec'] = 1;
	 		}else{
	 			$insertFile['docRec'] = 0;
	 		}

			if($this->input->post('docCompetencia') != '0000-00-00' ){
	 			$insertFile['docCompetencia'] = $this->input->post('docCompetencia');
	 		}

		 	$saveFile = $this->db->insert('clientes_arquivo', $insertFile );
		 	$docID = $this->db->insert_id();

		 	if($saveFile){

		 		//SAVE TAGS
		 		foreach($tags as $tag){
		 			$this->db->insert('documentos_tags', array('docID'=>$docID,'tagID'=>$tag->tagID ));
		 		}

		 		$insertVrs = array(
		 			'docID'=$docID,
		 			'docVrsAwsKey'=>$key,
		 			'docVrsCaminho'=>$caminho,
		 			'docVrsDataEnvio'=>date('Y-m-d H:i:s')
		 			);

		 		if($vencimento != '0000-00-00'){
		 			$insertVrs['docVrsVenc'] = $vencimento;
		 		}

		 		$saveVersao = $this->db->insert('documentos_versao', $insertVrs );

		 		if($saveVersao){

		 			echo json_encode( array('status'=>TRUE ) );
		 			return;
		 		}else{

		 			echo json_encode( array('status'=>FALSE,'mesage'=>'Caminho não recuperado' ) );
		 			return;
		 		}

		 	}else{
		 		echo json_encode( array('status'=>FALSE,'mesage'=>'O upload foi feito mas não foi salvo' ) );
		 		return;
		 	}	 	

		 }else{

		 	echo json_encode( array('status'=>FALSE,'mesage'=>'O upload para a nuvem falhou' ) );
		 	return;
		 }	 	
 	}


 	public function uploadRecDocS3($cliente){

 		$filename 	= $this->input->post('filename');
 		$file 		= explode(",", $this->input->post('file') );
 		$nome 		= $this->input->post('nome');

 		$keyName 	= md5($filename).rand(5,15);

 		$bucket 	= 'dashcont';
		$key 		= $cliente.'/'.$keyName;
		$fileData 	= base64_decode( end($file) );

 		$client 	= $this->awsCredential();		
		$upload 	= $client->upload($bucket, $key, $fileData, 'public-read');
		$caminho 	= $upload->get('ObjectURL');

		if($upload){
			$this->db->where('clienteCpfCnpj',$cliente);
	 		$clienteID = $this->db->get('clientes')->row()->clienteID;
	 		

			$insert = array(
				'clienteID'=>$clienteID,
				'docNome'=>$nome,
				'docAwsKey'=>$keyName,
				'docCaminho'=>$caminho,
				'docDataEnvio'=>date('Y-m-d H:i:s')
				);

		 	$this->db->insert('clientes_arquivo', $insert );

		 	echo json_encode( array('status'=>TRUE ) );
		 	return;

		 }else{

		 	echo json_encode( array('status'=>FALSE ) );
		 	return;
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
