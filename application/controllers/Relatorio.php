<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('mpdf/mpdf');
		$this->load->model('localizacao_model', 'loc');
	}

	//funçao para verificar se a sessao do usuario foi ativada
	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function index(){
		//verificando a sessao
		//chamando a view
		$this->verificarSessao();

		$data['combobox'] = $this->loc->listarTodos();

		$this->load->view('relatorio/ativosPorLocal_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-relatorio')->set_layout('default')->build('relatorio/ativosPorLocal_view');


	}
}