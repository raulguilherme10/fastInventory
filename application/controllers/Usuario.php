<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {


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

		$this->template->set_partial('lateral', 'partials/lateral-usuario')->set_layout('default')->build('usuario/formCadUsu');
	}

	public function cadastrarUsuario(){

		//verificando a sessao
		$this->verificarSessao();

		echo "<h1>NEEEEEEEEEEEEEEEEEEEEEM</h1>";
	}

	public function editarUsuario(){

		//verificando a sessao
		$this->verificarSessao();

	}


	public function excluirUsuario(){

		//verificando a sessao
		$this->verificarSessao();

	}
}