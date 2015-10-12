<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Ativo_model', 'ativo');
	}

	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function index(){
		//verificando a sessao
		$this->verificarSessao();
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/cadastrarEmpresa_view');
	}

	public function cadastrarEmpresa(){
		//verificando a sessao
		$this->verificarSessao();

		//validacao do formulario
		$this->form_validation->set_rules('cnpj', 'CNPJ', 'required|min_length[18]|max_length[18]|is_unique[tbl_empresa.emp_cnpj]', array(
										'required' => 'O campo %s é obrigatório.',
										'min_length' => 'O mínimo no campo %s é 16 caracteres.',
										'max_length' => 'O campo %s excedeu o limite de 16 caracteres.',
										'is_unique' => '%s já cadastrado'));
		$this->form_validation->set_rules('ie', 'INSCRIÇÃO ESTADUAL', 'required|min_length[11]|max_length[11]|is_unique[tbl_empresa.emp_ie]', array(
										'required' => 'O campo %s é obrigatório.',
										'min_length' => 'O mínimo no campo %s é 11 caracteres.',
										'max_length' => 'O campo %s excedeu o limite de 11 caracteres.',
										'is_unique' => '%s já cadastrado'));
		$this->form_validation->set_rules('nf', 'NOME FANTASIA', 'required|max_length[50]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 50 caracteres.'));
		$this->form_validation->set_rules('rz', 'RAZÃO SOCIAL', 'max_length[100]', array(
										'max_length' => 'O campo %s excedeu o limite de 100 caracteres.'));

			//verificando se passou pela validacao
			if($this->form_validation->run() == TRUE){
				//recebendo os valores do formulario
				$data['emp_cnpj'] = $this->input->post('cnpj');
				$data['emp_ie'] = $this->input->post('ie');
				$data['emp_nomeFantasia'] = $this->input->post('nf');
				$data['emp_razaoSocial'] = $this->input->post('rs');

				//passando os valores para o model
				$this->ativo->create($data, 1);
				//passando uma mensagem de confirmacao pela session
				$this->session->set_flashdata('ok', 'Cadastrado com sucesso!');
				redirect('ativo/listarEmpresas');
			}else{
				//passando uma mensagem de erro
				$this->listarEmpresas();
			}
	}

	public function cadastrarProduto(){
		//verificando a sessao
		$this->verificarSessao();

		//validacao do formulario
		$this->form_validation->set_rules('marca', 'Marca', 'required|max_length[50]', array(
										'marcar' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 50 caracteres.'));
		$this->form_validation->set_rules('cor', 'COR', 'max_length[20]|alpha', array(
										'max_length' => 'O campo %s excedeu o limite de 20 caracteres.',
										'alpha' => 'Carateres inválidos no campo %s. '));
		$this->form_validation->set_rules('descricao', 'DESCRIÇÃO', 'required|max_length[330]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 330 caracteres.'));

			if($this->form_validation->run() == TRUE){
				//armazenar os valores do formulario em um array
				$data['pro_marca'] = $this->input->post('marca');
				$data['pro_cor'] = $this->input->post('cor');
				$data['pro_descricao'] = $this->input->post('descricao');
				$data['pro_idTipo'] = $this->input->post('tipo');

				//passado o array para a funcao que insere no bd
				$this->ativo->create($data, 2);
				//passando uma mensagem de confirmaçao
				$this->session->set_flashdata('ok', 'Cadastrado com sucesso!');
				redirect('ativo/carregarProduto');
			}else{
				$this->carregarProduto();
			}

	}

	public function carregarProduto(){
		//verificando a sessao
		$this->verificarSessao();

		//funcao para trazer os tipos de produto
		$data['query'] = $this->ativo->listarTodosTipos();
		$this->load->view('ativo/cadastrarProduto_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/cadastrarProduto_view');
	}

	public function carregarNF(){
		//verificando a sessao
		$this->verificarSessao();

		//funcao para trazer os tipos de produto
		$data['query'] = $this->ativo->listarTodosEmpresas();
		$this->load->view('ativo/cadastrarNotaFiscal_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/cadastrarNotaFiscal_view');
	}

	public function carregarItem(){
		//verificando a sessao
		$this->verificarSessao();

		//funcao para trazer os tipos de produto
		$data['query'] = $this->ativo->listarTodosItens();
		$this->load->view('ativo/cadastrarItem_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/cadastrarItem_view');
	}

	public function listarEmpresas(){
		//verificando a sessao
		$this->verificarSessao();

		//funcao para trazer todas as empresas
		$data['query'] = $this->ativo->listarTodosEmpresas();
		$this->load->view('ativo/listarEmpresas_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/listarEmpresas_view');
	}

	public function atualizarEmpresa($cnpj=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//recebendo o cnpj pela url
		//chamando a funcao que veridica no banco de dados o cnpj
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(4);
		$data['query'] = $this->ativo->atualizarEmpresa($cnpj);


		$this->load->view('ativo/editarEmpresa_view.php', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/editarEmpresa_view.php');

	}

	public function editarEmpresa(){
		//verificando a sessao
		$this->verificarSessao();

		//fazendo a validacao do formulario
		$this->form_validation->set_rules('nf', 'NOME FANTASIA', 'required|max_length[50]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 50 caracteres.'));
		$this->form_validation->set_rules('rz', 'RAZÃO SOCIAL', 'max_length[100]', array(
										'max_length' => 'O campo %s excedeu o limite de 100 caracteres.'));

			if($this->form_validation->run() == TRUE){
				$cnpj = $this->input->post('cnpj');
				$data['emp_nomeFantasia'] = $this->input->post('nf');
				$data['emp_razaoSocial'] = $this->input->post('rs');

				$retorno = $this->ativo->editarEmpresa($cnpj, $data);

					if($retorno == 1){
						$this->session->set_flashdata('ok', 'Editado com sucesso');
						redirect('ativo/listarEmpresas');
					}


			}else{
				$this->listarEmpresas();
			}


	}

	public function trocarStatusEmpresa($cnpj=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//recebendo o valor do cnpj pela url
		//chamando a funçao de verificar o status da empresa
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(4);
		$retorno = $this->ativo->verificarStatus($cnpj, 1);

			//recebendo o status da empresa
			foreach ($retorno->result() as $res ) {
				$x = $res->emp_status;
			}

				if($x == 0){
					$data['emp_status'] = 1;
					$this->ativo->trocarStatus($cnpj, $data, 1);
					$this->session->set_flashdata('ok', 'Status alterado com sucesso');
				}else{
					if($x == 1){
						$data['emp_status'] = 0;
						$this->ativo->trocarStatus($cnpj, $data, 1);
						$this->session->set_flashdata('ok', 'Status alterado com sucesso');
					}
				}

				redirect('ativo/listarEmpresas');
			


				

	}
}