<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Ativo_model', 'ativo');
		$this->load->model('Code_model', 'code');
		$this->load->library('ciqrcode');
	}

	public function index(){
		$this->listarEmpresas();
	}

	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function carregarItem($id=NULL, $cnpj=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//recebendo o valor do cnpj da empresa pela url
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(5);

		$dado = $this->ativo->atualizarNF($id, $cnpj);

			if($dado != NULL){

				//trazendo todos os tipos de produtos
				//trzendo todos os itens da nota
				//chamando a view e passando o array
				$data['query'] = $this->ativo->listarTodosProdutos();
				$data['item'] =$this->ativo->listarItemNF($id, $cnpj);
				$data['id'] = $id;
				$data['cnpj'] = $cnpj;
				$this->load->view('ativo/adicionarItem_view', $data);
				$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/adicionarItem_view');
	
			}else{
					$this->session->set_flashdata('erro', 'Nota Fiscal não encontrada!');
					redirect('ativo/listarNF');
			}



	}

	public function exibirAtivo($id=NULL){
		//verificando a sessao
		$this->verificarSessao();

			if($id != NULL){
				$ativo = NULL;
				$data['query'] = $this->ativo->pesquisarAtivo($id, 2);
				$data['tipo'] = $this->ativo->listarTodosTipos();
				$data['id'] = $id;

				$this->load->view('ativo/exibirAtivo_view', $data);
				$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/exibirAtivo_view');				
			}
	}

	public function listarAtivo(){
		//verificando a sessao
		$this->verificarSessao();

		$data['query'] = $this->ativo->listarTodosAtivos();
		$this->load->view('ativo/listarAtivos_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/listarAtivos_view');

	}

	public function listarEmpresas(){
		//verificando a sessao
		$this->verificarSessao();

		//funcao para trazer todas as empresas
		$data['query'] = $this->ativo->listarTodasEmpresas();
		$this->load->view('ativo/listarEmpresas_view', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/listarEmpresas_view');
	}

	public function listarProdutos(){
		//verificando a sessao
		$this->verificarSessao();

		$data['tipos'] = $this->ativo->listarTodosTipos();
		$data['query'] = $this->ativo->listarTodosProdutos();
		$this->load->view('ativo/listarProdutos_view.php', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/listarProdutos_view.php');

	}

	public function listarNF(){
		//verificando a sessao
		$this->verificarSessao();

		//função para trazer todas NF
		$data['empresa'] = $this->ativo->listarEmpresasCombo();
		$data['query'] = $this->ativo->listarTodasNF();
		$this->load->view('ativo/listarNF_view.php', $data);
		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/listarNF_view.php');
	}

	public function listarItem(){
		//verificando a sessao
		$this->verificarSessao();

		$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/listarItem_view.php');
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
		$this->form_validation->set_rules('ie', 'INSCRIÇÃO ESTADUAL', 'required|min_length[11]|max_length[11]', array(
										'required' => 'O campo %s é obrigatório.',
										'min_length' => 'O mínimo no campo %s é 11 caracteres.',
										'max_length' => 'O campo %s excedeu o limite de 11 caracteres.'));
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
				$data['emp_status'] = "1";

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
				redirect('ativo/listarProdutos');
			}else{
				$this->listarProdutos();
			}

	}

	public function cadastrarNF(){
		//verificando a sessao
		$this->verificarSessao();

		//validação do formulário
		$this->form_validation->set_rules('numNota', 'NÚMERO DA NOTA', 'required|max_length[12]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 12 caracteres.'));
		$this->form_validation->set_rules('serie', 'SÉRIE', 'required|max_length[2]|is_natural', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 2 caracteres',
										'is_natural' => 'Tipo de caractere(s) inválido(s).'));
		$this->form_validation->set_rules('natureza', 'NATUREZA DA OPERAÇÃO', 'required|max_length[100]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 100 caracteres.'));
		$this->form_validation->set_rules('total', 'TOTAL', 'required|max_length[12]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 12 caracteres.'));
		$this->form_validation->set_rules('dataEmissao', 'DATA DE EMISSÃO', 'required|max_length[10]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 10 caracteres.'));
		$this->form_validation->set_rules('dataVencimento', 'DATA DE VENCIMENTO', 'required|max_length[10]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 10 caracteres.'));
		
			//verificando se passou pela validação, se passou armazena os valores em um vetor
			if($this->form_validation->run() == TRUE){
				$data['ntf_cnpjEmp'] = $this->input->post('empresa');
				$data['ntf_numNota'] = $this->input->post('numNota');
				$data['ntf_serie'] = $this->input->post('serie');
				$data['ntf_naturezaOpe'] = $this->input->post('natureza');
				$data['ntf_total'] = $this->input->post('total');
				$data['ntf_dataEmissao'] = $this->input->post('dataEmissao');
				$data['ntf_dataVencimento'] = $this->input->post('dataVencimento');
				$data['ntf_status'] = 1;

				//passado o array para a funcao que insere no bd
				$this->ativo->create($data, 3);
				//passando uma mensagem de confirmaçao
				$this->session->set_flashdata('ok', 'Cadastrado com sucesso!');
				redirect('ativo/listarNF');

			}else{
				$this->listarNF();
			}
	}

	public function cadastrarItem(){
		//verificando a sessao
		$this->verificarSessao();

		//validação do formulário
		$this->form_validation->set_rules('quantidade', 'QUANTIDADE', 'required|max_length[7]|is_natural', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 7 caracteres',
										'is_natural' => 'Tipo de caractere(s) inválido(s).'));

		$status = $this->ativo->verificarStatus($this->input->post('id'), 3);

		if($status == 1){
			if($this->input->post('quantidade') > 0){
				//verificando se passou pela validação, se passou armazena os valores em um vetor
				if($this->form_validation->run() == TRUE){
					//array para armazenar o novo item
					$data['itm_idNTF'] = $this->input->post('id');;
					$data['itm_cnpjNTF'] = $this->input->post('cnpj');;
					$data['itm_idPro'] = $this->input->post('empresa');
					$data['itm_quantidade'] = $this->input->post('quantidade');

					
						//pesquisar se existe o produto cadastrado na NF
						$item = NULL;
						$dados['cnpj'] = $data['itm_cnpjNTF'];
						$dados['id'] = $data['itm_idNTF'];
						$dados['Prod'] = $data['itm_idPro'];
						$item = $this->ativo->pesquisarItem($dados, 1);

							if($item == NULL){
								//passado o array para a funcao que insere no bd
								$this->ativo->create($data, 4);
								$this->session->set_flashdata('ok', 'Item inserido com sucesso!');

									//criando o total de ativos de acordo com a qntd de itens
									//pesquisando novamente o item
									$dados['cnpj'] = $data['itm_cnpjNTF'];
									$dados['id'] = $data['itm_idNTF'];
									$dados['Prod'] = $data['itm_idPro'];
									$item = $this->ativo->pesquisarItem($dados, 1);

										//criando os ativos de acordo com as qntds de itens
										for($i = 0; $i < $data['itm_quantidade']; $i++){
											//dados para criar os ativos
											$ativo['atv_idITM'] = $item[0]->itm_id;
											$ativo['atv_idNTF'] = $dados['id'];
											$ativo['atv_cnpjNTF'] = $dados['cnpj'];
											$ativo['atv_idPro'] = $dados['Prod'];
											$ativo['atv_numPatr'] = '';
											$ativo['atv_local'] = 84; //sem local
											$ativo['atv_data'] = date('d/m/Y');
											$ativo['atv_hora'] = date('H:i:s');
											$ativo['atv_status'] = 1;

											//função para inserir no bd
											$this->ativo->create($ativo, 5);
										}

							}else{
								$this->session->set_flashdata('erro', 'Item já inserido na Nota Fiscal!');
							}		
				}else{
					$this->listarNF();
				}
			}else{
				$this->session->set_flashdata('erro', 'A QUANTIDADE tem que ser maior que zero!');
				
			}
		}else{
			$this->session->set_flashdata('erro', 'Ative a Nota FIscal para adicionar item!');
		}

		

		redirect('ativo/listarNF');	
	}


	public function atualizarProduto($id=NULL){
		//verificando a sessao
		$this->verificarSessao();

		$data['combo'] = $this->ativo->listarTodosTipos();
		$dado = NULL;
		$dado = $this->ativo->atualizarProduto($id);

			if($dado != NULL){
				$data['query'] = $dado;
				$this->load->view('ativo/editarProduto_view.php', $data);
				$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/editarProduto_view.php');
			}else{
				$this->session->set_flashdata('erro', 'Produto não encontrado');
				redirect('ativo/listarProdutos');
			}

	}

	public function atualizarEmpresa($cnpj=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//incializando uma variável
		//recebendo o cnpj pela url
		//chamando a funcao que veridica no banco de dados o cnpj
		$dado = NULL;
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(4);
		$dado = $this->ativo->atualizarEmpresa($cnpj);

			if($dado != NULL){
				$data['query'] = $dado;
				$this->load->view('ativo/editarEmpresa_view.php', $data);
				$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/editarEmpresa_view.php');

			}else{
				$this->session->set_flashdata('erro', 'Empresa não encontrada!');
				redirect('ativo/listarEmpresas');
			}

	}

	public function atualizarNF($id=NULL, $cnpj=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//incializando uma variável
		//recebendo o cnpj pela url
		//chamando a funcao que veridica no banco de dados o cnpj e o id na tabela notaFiscal
		$dado = NULL;
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(5);
		$dado = $this->ativo->atualizarNF($id, $cnpj);

			if($dado != NULL){
				$data['empresa'] = $this->ativo->listarEmpresasCombo();
				$data['query'] = $dado;
				$this->load->view('ativo/editarNF_view.php', $data);
				$this->template->set_partial('lateral', 'partials/lateral-ativo')->set_layout('default')->build('ativo/editarNF_view.php');
	
			}else{
				$this->session->set_flashdata('erro', 'Nota Fiscal não encontrada!');
				redirect('ativo/listarNF');
			}
	}

	public function editarProduto(){
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

			//verificando se os valores do relatorio passaram pela validação
			if($this->form_validation->run() == TRUE){
				$id = $this->input->post('id');

				$data['pro_marca'] = $this->input->post('marca');
				$data['pro_cor'] = $this->input->post('cor');
				$data['pro_descricao'] = $this->input->post('descricao');
				$data['pro_idTipo'] = $this->input->post('tipo');

				$retorno = $this->ativo->pesquisarProduto($id);
				$dado = NULL;

					foreach($retorno->result() as $res){
						$dado = $res->pro_id;
					}

						if($dado != NULL){
							$retorno = $this->ativo->editarProduto($id, $data);
							if($retorno == 1){
								$this->session->set_flashdata('ok', 'Editado com sucesso!');
							}
						}else{
							$this->session->set_flashdata('ok', 'Produto não encontrado');
						}

						redirect('ativo/listarProdutos');
			}else{

				$this->listarProdutos();
			}

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

	public function editarNF(){
		//verificando a sessao
		$this->verificarSessao();

		//validação do formulário
		$this->form_validation->set_rules('numNota', 'NÚMERO DA NOTA', 'required|max_length[12]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 12 caracteres.'));
		$this->form_validation->set_rules('serie', 'SÉRIE', 'required|max_length[2]|is_natural', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 2 caracteres',
										'is_natural' => 'Tipo de caractere(s) inválido(s).'));
		$this->form_validation->set_rules('natureza', 'NATUREZA DA OPERAÇÃO', 'required|max_length[100]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 100 caracteres.'));
		$this->form_validation->set_rules('total', 'TOTAL', 'required|max_length[12]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 12 caracteres.'));
		$this->form_validation->set_rules('dataEmissao', 'DATA DE EMISSÃO', 'required|max_length[10]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 10 caracteres.'));
		$this->form_validation->set_rules('dataVencimento', 'DATA DE VENCIMENTO', 'required|max_length[10]', array(
										'required' => 'O campo %s é obrigatório.',
										'max_length' => 'O campo %s excedeu o limite de 10 caracteres.'));
		

			//verificando se passou pela validação, se passou armazena os valores em um vetor
			if($this->form_validation->run() == TRUE){
				$id = $this->input->post('id');
				$cnpj = $this->input->post('cnpj');

				$data['ntf_numNota'] = $this->input->post('numNota');
				$data['ntf_serie'] = $this->input->post('serie');
				$data['ntf_naturezaOpe'] = $this->input->post('natureza');
				$data['ntf_total'] = $this->input->post('total');
				$data['ntf_dataEmissao'] = $this->input->post('dataEmissao');
				$data['ntf_dataVencimento'] = $this->input->post('dataVencimento');

				$retorno = $this->ativo->editarNF($id, $cnpj, $data);

					if($retorno == 1){
						$this->session->set_flashdata('ok', 'Editado com sucesso');
						redirect('ativo/listarNF');
					}else{
						if($retorno == 0){
							$this->session->set_flashdata('erro', 'Erro ao editar!');
							redirect('ativo/listarNF');
						}
					}
				
			}else{
				$this->listarNF();
			}
	}

	public function trocarStatusEmpresa($cnpj=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//iniciando a variavel
		//recebendo o valor do cnpj pela url
		//chamando a funçao de verificar o status da empresa
		$dado = NULL;
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(4);
		$retorno = $this->ativo->verificarStatus($cnpj, 1);

			//recebendo o status da empresa
			foreach ($retorno->result() as $res ) {
				$dado = $res->emp_status;
			}

				if($dado != NULL){

					if($dado == 0){
						$data['emp_status'] = 1;
						$this->ativo->trocarStatus($cnpj, $data, 1);
						$this->session->set_flashdata('ok', 'Status alterado com sucesso!');
					}else{
						if($dado == 1){
							$data['emp_status'] = 0;
							$this->ativo->trocarStatus($cnpj, $data, 1);
							$this->session->set_flashdata('ok', 'Status alterado com sucesso!');
						}
					}
				}else{
					$this->session->set_flashdata('erro', 'Empresa não encontrada!');
				}
				

				redirect('ativo/listarEmpresas');		
	}


	public function trocarStatusProduto($id){
		//verificando a sessao
		$this->verificarSessao();

		//iniciando a variavel
		//verificando qual é o status do produto
		$dado = NULL;
		$retorno = $this->ativo->verificarStatus($id, 2);
			
			//retirando do array o status do produto
			foreach($retorno->result() as $res){
				$dado = $res->pro_status;
			}

				//verificando se o dado é diferente de nulo, para poder alterar o status do produto
				if($dado != NULL){
					if($dado == 1){
						$data['pro_status'] = 0;
						$this->ativo->trocarStatus($id, $data, 2);
						$this->session->set_flashdata('ok', 'Status alterado com sucesso!');
					}else{
						if($dado == 0){
							$data['pro_status'] = 1;
							$this->ativo->trocarStatus($id, $data, 2);
							$this->session->set_flashdata('ok', 'Status alterado com sucesso!');
						}
					}
				}else{
					$this->session->set_flashdata('erro', 'Produto não encontrado!');
				}

				redirect('ativo/listarProdutos');
	}

	public function trocarStatusNF($id=NULL, $cnpj=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//iniciando a variavel
		//recebendo o valor do cnpj e id pela url
		//chamando a funçao de verificar o status da empresa
		$dado = NULL;
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(5);

		$dados['id'] = $id;
		$dados['cnpj'] = $cnpj;
		$retorno = $this->ativo->verificarStatus($dados, 3);

			foreach($retorno->result() as $res){
				$status = $res->ntf_status;
			}

				if($status != NULL){
					if($status == 1){
						$data['ntf_status'] = 0;
						$this->ativo->trocarStatus($dados, $data, 3);
						$this->session->set_flashdata('ok', 'Status alterado com sucesso!');
					}else{
						if($status == 0){
							$data['ntf_status'] = 1;
							$this->ativo->trocarStatus($dados, $data, 3);
							$this->session->set_flashdata('ok', 'Status alterado com sucesso!');
						}
					}
				}else{
					$this->session->set_flashdata('erro', 'Nota Fiscal não encontrada!');
				}

				redirect('ativo/listarNF');

	}

	public function excluirEmpresa($cnpj){
		//verificando a sessao
		$this->verificarSessao();

		//incializando uma variável
		//recebendo o cnpj pela url
		//chamando a funcao que veridica no banco de dados o cnpj
		$dado = NULL;
		$cnpj .= '/';
		$cnpj .= $this->uri->segment(4);
		$empresa = $this->ativo->pesquisarEmpresa($cnpj);

			if($empresa != NULL){
				//verificar se a empresa esta vinculada a alguma nf
				$dados['cnpj'] = $cnpj;
				$retorno = $this->ativo->pesquisarNF($dados, 1);

					if($retorno != NULL){
						$this->session->set_flashdata('erro', 'Erro ao excluir!');
					}else{
						$erro = $this->ativo->excluir($cnpj, 1);
						$this->session->set_flashdata('ok', 'Excluido com sucesso!');
					}
			}else{
				$this->session->set_flashdata('erro', 'Empresa não encontrada');
			}

		

			redirect('ativo/listarEmpresas');
			
	}

	public function excluirNF($id){

		//verificar se existe algum item vinculado a nf
		$retorno = NULL;
		$dados['idNF'] = $id;
		$nf = $this->ativo->pesquisarNF($dados, 2);

			if($nf != NULL){
				$retorno = $this->ativo->verificar($dados, 1);

					if($retorno != NULL){
						$this->session->set_flashdata('erro', 'Erro ao excluir!');
					}else{
						$erro = $this->ativo->excluir($dados, 2);
						$this->session->set_flashdata('ok', 'Excluido com sucesso!');
					}
			}else{
				$this->session->set_flashdata('erro', 'Nota Fiscal não encontrada');
			}
			

			redirect('ativo/listarNF');
	}

	public function excluirItem($id=NULL){

		$ativo = NULL;
		$item = NULL;
		$i = 0;
		$qntd = 0;
		$ativo = $this->ativo->pesquisarAtivo($id, 1);
		$item = $this->ativo->pesquisarItem($id, 2);

			if($ativo != NULL){

				foreach($ativo->result() as $res){
					$vinculo[$i] = $res->atv_local;
					$i++;
				}

					for($j = 0; $j < $i; $j++){
						if($vinculo[$j] == NULL){
							$qntd++;
						}
					}

						if($qntd == $i){
							if($item != NULL){
								$this->ativo->excluir($id, 3);
								$this->ativo->excluir($id, 4);
								$this->session->set_flashdata('ok', 'Excluido com sucesso!');
							}else{
								$this->session->set_flashdata('erro', 'Item não encontrado!');
							}
						}else{
							$this->session->set_flashdata('erro', 'Erro ao excluir!');
						}

			}

			redirect('ativo/listarNF');	

	}

	public function gerarQRCode($id){
		//verificando a sessao
		$this->verificarSessao();
		$query = NULL;
		$query = $this->code->gerarQrCode($id, 2);

			if($query != NULL){

				header("Content-Type: image/png");
				header('Content-Disposition: attachment; filename= "qrcode.png"');
				header('Content-Disposition: attachment; filename= "hue.png"');

				$params['data']  = "ID : ".$query[0]->atv_id. "\n";
				$params['data'] .= "Número de Patrimônio: ".$query[0]->atv_numPatr."\n";
				$params['data'] .= "Marca: ".$query[0]->pro_marca."\n";
				$params['data'] .= "Local: ".$query[0]->loc_nome."\n";
				
				$params['size'] = 10;
				$this->ciqrcode->generate($params);
			}else{
				$this->session->set_flashdata('erro', 'Ativo não encontrado !');
				redirect('ativo/exibirAtivo/'.$id);
			}



		
		
	}
	

	
}