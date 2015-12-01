<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Ativo_model', 'ativo');
		$this->load->model('Localizacao_model', 'loc');
		$this->load->model('Teste_model', 'teste');
	}
	public function index(){
		$data['query'] = $this->teste->listarTodosInventarios();
		$data['local'] = $this->loc->listarTodos(1);
		$this->load->view('teste/inventario_view.php', $data);
		$this->template->set_partial('lateral', 'partials/lateral-teste')->set_layout('default')->build('teste/inventario_view.php');				
	}

	public function cadastrarInventario(){
		$data['fis_local'] = $this->input->post('local');
		$data['fis_data'] = date('d/m/Y');
		$data['fis_hora'] = date('H:i:s');
		$data['fis_status'] = 0;
		$this->teste->create($data);
		redirect('teste');
	}

	public function carregarItem(){
		$data['query'] = $this->ativo->listarTodosAtivos();
		$this->load->view('teste/itemTeste_view.php', $data);
		$this->template->set_partial('lateral', 'partials/lateral-teste')->set_layout('default')->build('teste/itemTeste_view.php');
	}

	public function inserirItem($idAtivo, $idInventario){

		$retorno = $this->ativo->pesquisarAtivo($idAtivo, 2)->result();

		$data['div_idATV'] = $idAtivo;
		$data['div_idITM'] = $retorno[0]->atv_idITM;
		$data['div_idNF'] = $retorno[0]->atv_idNTF;
		$data['div_cnpjEMP'] = $retorno[0]->atv_cnpjNTF;
		$data['div_idPRO'] = $retorno[0]->atv_idPro;
		$data['div_idFis'] = $idInventario;

		$this->teste->inserirItem($data);
		redirect('teste/carregarItem');
	}


}