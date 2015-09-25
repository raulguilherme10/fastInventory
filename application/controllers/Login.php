<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model', 'login');
	}

	public function index(){
		$erro['msg'] = NULL;
		$this->load->view('login/login_view', $erro);
	}

	public function logarUsuario(){

		//recebendo os valores do formulario
		$usuario = $this->input->post('usuario');
		$senha = md5($this->input->post('senha'));
		//chamando a model de login p/ verificcar se existe o usuario
		$data['usuario'] = $this->login->logar($usuario, $senha);
			if(count($data['usuario']) == 1){
				$dados['usuario'] = $data['usuario'][0]->usu_id;
				$dados['senha'] = $data['usuario'][0]->usu_usuario;
				$dados['status'] = $data['usuario'][0]->usu_status;
				$dados['logado'] = TRUE;
				$this->session->set_userdata($dados);
				
				redirect('home');

			}else{
				$erro['msg'] = 'Usuário ou senha incorretos!';
				$this->load->view('login/login_view', $erro);
			}
		
	}

	public function logoutUsuario(){
		$this->session->sess_destroy();
		redirect('login');
	}
}