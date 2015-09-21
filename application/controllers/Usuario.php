<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {


	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
		 $this->load->view('login/login_view');
		}
	}
	
	public function index(){
		$this->template->set_partial('lateral', 'partials/lateral-usuario')->set_layout('default')->build('usuario/formCadUsu');
	}

	public function cadastrarUsuario(){
		echo "<h1>NEEEEEEEEEEEEEEEEEEEEEM</h1>";
	}

	public function editarUsuario(){

	}


	public function excluirUsuario(){

	}
}