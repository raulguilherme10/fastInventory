<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct(){
		parent::__construct();
	}

	//funçao para verificar se a sessao do usuario foi ativada
	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function index(){

		//verificando a sessao
		$this->verificarSessao();

		$this->template->set_partial('lateral', 'partials/lateral-home')->set_layout('default')->build('home/conteudo');
	}


}