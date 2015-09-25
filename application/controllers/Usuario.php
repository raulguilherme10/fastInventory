<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('usuario_model', 'usu');
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

		//preenchendo o combobox
		$data['tipo'] = $this->usu->listarGrupos();


		$this->load->view('usuario/formCadUsu', $data);
		$this->template->set_partial('lateral', 'partials/lateral-usuario')->set_layout('default')->build('usuario/formCadUsu');
	}

	public function cadastrarUsuario(){
		//verificando a sessao
		$this->verificarSessao();


		//validacao do formulario
		$this->form_validation->set_rules('usuario', 'USUÁRIO', 'required|min_length[5]|max_length[20]|strtolower|is_unique[tbl_usuario.usu_usuario]', array(
								'max_length' => 'O campo %s excedeu o limite de 20 caracteres.',
								'min_length' => 'O mínimo no campo %s é 5 caracteres.',
								'required' => 'O campo %s é obrigatório.',
								'is_unique' => 'Usuário já cadastrado.'));
		$this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[5]|max_length[10]', array(
								'required' => 'O campo %s é obrigatório.',
								'min_length' => ' mínimo no campo %s é 5 caracteres.',
								'max_length' => 'O campo %s excedeu o limite de 10 caracteres.'));
		$this->form_validation->set_rules('senhaNov', 'REPITA A SENHA', 'required|min_length[5]|max_length[10]|matches[senha]', array(
								'required' => 'O campo %s é obrigatório.',
								'min_length' => ' mínimo no campo %s é 5 caracteres.',
								'max_length' => 'O campo %s excedeu o limite de 10 caracteres.',
								'matches' => 'O campo %s não corresponde ao campo %s.'));

		//verificando se passou pela validacao
		if($this->form_validation->run() == TRUE){
			$usuario = $this->input->post('usuario');
			$usuario = str_replace(" ",".",$usuario);
			$dados['usu_usuario'] = $usuario;
			$dados['usu_senha'] = md5($this->input->post('senha'));
			$dados['usu_idGru'] = $this->input->post('tipo');
			$dados['usu_status'] = $this->input->post('status');

			//passando o vetor para a funcao de cadastrar
			$this->usu->create($dados);

			$this->session->set_flashdata('ok', 'Cadastro efetuado com sucesso!');
			redirect('usuario/listarUsuario');

		}else{
			$this->index();
		}
		
	}

	public function listarUsuario(){
		//verificando a sessao
		$this->verificarSessao();
		//pegando o id do usuario pela sessao
		$id = $this->session->userdata('usuario');
		//armazenando em um vetor todos os usuarios
		$data['query'] = $this->usu->listarTodos($id);

		$this->load->view('usuario/listarTodos_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-usuario')->set_layout('default')->build('usuario/listarTodos_view');

	}

	public function editarUsuario(){

		//verificando a sessao
		$this->verificarSessao();

	}


	public function excluirUsuario($id=NULL){
		//verificando a sessao
		$this->verificarSessao();
		if($id != $this->session->userdata('usuario')){
			if($this->usu->excluir($id)){
				$this->session->set_flashdata('ok', 'Exclusão efetuada com sucesso!');
			}
		}else{
			$this->session->set_flashdata('erro', 'Não é permitido esta exclusão!');
		}
		

		redirect(base_url('usuario/listarUsuario'));

	}
}