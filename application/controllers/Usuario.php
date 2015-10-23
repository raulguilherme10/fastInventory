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

		$this->listarUsuario();
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
			$this->listarUsuario();
		}
		
	}

	public function listarUsuario(){
		//verificando a sessao
		$this->verificarSessao();
		//pegando o id do usuario pela sessao
		$id = $this->session->userdata('usuario');
		//armazenando em um vetor todos os usuarios
		//preenchendo o combobox
		$data['query'] = $this->usu->listarTodos($id);
		$data['tipo'] = $this->usu->listarGrupos();

		$this->load->view('usuario/listarTodos_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-usuario')->set_layout('default')->build('usuario/listarTodos_view');

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

	public function restaurarSenha($id=NULL){
		//verificando a sessao
		$this->verificarSessao();

		$data = array('usu_senha' => md5('fatec'));
		$retorno = $this->usu->restaurarSenha($id, $data);
			if($retorno == 1){
				$this->session->set_flashdata('ok', 'Senha restaurada com sucesso!');
			}else{
				$this->session->set_flashdata('erro', 'Erro na restuaração da senha!');
			}

			redirect(base_url('usuario/listarUsuario'));


	}

	public function trocarSenha(){
		//verificando a sessao
		$this->verificarSessao();

		//validacao do formulario
		$this->form_validation->set_rules('senhaAnt', 'SENHA ANTIGA', 'required|min_length[5]|max_length[10]', array(
													'required' => 'O campo %s é obrigatório.',
													'min_length' => 'O mínimo no campo %s é 5 caracteres.',
													'max_length' => 'O campo %s excedeu o limite de 10 caracteres.'));
		$this->form_validation->set_rules('senhaNov', 'Nova SENHA', 'required|min_length[5]|max_length[10]', array(
													'required' => 'O campo %s é obrigatório.',
													'min_length' => 'O mínimo no campo %s é 5 caracteres.',
													'max_length' => 'O campo %s excedeu o limite de 10 caracteres.'));
		$this->form_validation->set_rules('senhaRep', 'REPITA A SENHA', 'required|min_length[5]|max_length[10]|matches[senhaNov]', array(
								'required' => 'O campo %s é obrigatório.',
								'min_length' => 'O mínimo no campo %s é 5 caracteres.',
								'max_length' => 'O campo %s excedeu o limite de 10 caracteres.',
								'matches' => 'O campo %s não corresponde ao campo %s.'));

			//vericando se os dados passaram pela validaçao
			if($this->form_validation->run() == TRUE){

				//pegando o id do usuario logado
				//recebendo a senha antiga do formulario
				//chamando a funcao que traz a senha do usuario
				$id = $this->session->userdata('usuario');
				$senhaAnt = $this->input->post('senhaAnt');
				$verifSenha = $this->usu->verificarSenha($id);

					//tirando o valor da senha pelo foreach
					foreach($verifSenha->result() as $res){
						$atualSenha = $res->usu_senha;
					}
						//verificando se a senha cadastrada confere com a senha antiga
						if($atualSenha == md5($senhaAnt)){
							//colocando a nova senha em um vetor e criptografando ela
							//chamando a funcao de trocar senha e passando o id e o vetor com a nova senha
							$data['usu_senha'] = md5($this->input->post('senhaNov'));
							$retorno = $this->usu->trocarSenha($id, $data);

								//vericando o retorno da funcao
								if($retorno == 1){
									$this->session->set_flashdata('ok', 'Nova senha cadastrada com sucesso!');
								}else{
									$this->session->set_flashdata('erro', 'Erro ao cadastrar a nova senha');
								}

						}else{
							$this->session->set_flashdata('erro', 'A senha antiga não confere com a senha cadastrada!');
						}


			}

		//$this->load->view('usuario/trocarSenha_view');
		$this->template->set_partial('lateral', 'partials/lateral-usuario')->set_layout('default')->build('usuario/trocarSenha_view');
	}


	public function trocarStatus($id=NULL){

		//verificando a sessao
		$this->verificarSessao();

		//verificando se o id eh diferente de nulo
		if($id != NULL){
			//chamando a funcao para trazer o status do usuario
			$status = $this->usu->verificarStatus($id);
				//armazenando o status da variavel dentro de $x
				foreach($status->result() as $resul){
					$x = $resul->usu_status;
				}

					//verificando o status do usuario e alterando para o valor oposto
					if($x == 1){
						$data['usu_status'] = 0;
						$this->usu->trocarStatus($id, $data);
					}else{
						$data['usu_status'] = 1;
						$this->usu->trocarStatus($id, $data);
					}

					$this->session->set_flashdata('ok', 'Status modificado com sucesso!');
					redirect(base_url('usuario/listarUsuario'));
		}else{
			$this->session->set_flashdata('erro', 'Não é possível trocar o status deste usuário!');
			redirect(base_url('usuario/listarUsuario'));
		}
		
	}
}