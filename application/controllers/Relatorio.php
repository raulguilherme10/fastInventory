<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	//funçao para verificar se a sessao do usuario foi ativada
	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function index(){
		//verificando a sessao
		$this->verificarSessao();
		echo '<h1>Hello</h1>';
	}
}