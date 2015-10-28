<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localizacao extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Localizacao_model', 'loc');
		$this->load->model('Code_model', 'code');
		$this->load->library('ciqrcode');
	}

	//funçao para verificar se a sessao do usuario foi ativada
	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function index(){
		redirect('localizacao/listarLocalizacao');
	}


	public function cadastrarLocalizacao(){
		//verificando a sessao
		$this->verificarSessao();

		//validaçao do formulario
		$this->form_validation->set_message('max_length', 'O campo %s excedeu o limite de caracteres.');
		$this->form_validation->set_rules('loc_nome', 'NOME', 'required|max_length[50]|ucwords');

		//verificando se passou pela validacao
		if($this->form_validation->run() == TRUE){
			$dados = elements(array('loc_nome', 'loc_pavimento', 'loc_status'), $this->input->post());
			$this->loc->create($dados);
			$this->session->set_flashdata('ok', 'Cadastro efetuado com sucesso!');

			redirect(base_url('localizacao/listarLocalizacao'));
			
		}else{
			$this->listarLocalizacao();
		}
		
		
	}

	public function listarLocalizacao(){

		//verificando a sessao
		$this->verificarSessao();

		$dados['query'] = $this->loc->listarTodos(1);

		$this->load->view('localizacao/listarLocalizacao_view', $dados);
		$this->template->set_partial('lateral', 'partials/lateral-localizacao')->set_layout('default')->build('localizacao/listarLocalizacao_view');
		
	}

	public function excluirLocalizacao($id=NULL){

		//verificando a sessao
		$this->verificarSessao();

			if($this->loc->excluir($id)){
				$this->session->set_flashdata('ok', 'Exclusão efetuada com sucesso!');
			}

		redirect(base_url('localizacao/listarLocalizacao'));
	}

	public function atualizarLocalizacao($id=NULL){

		//verificando a sessao
		$this->verificarSessao();

		$data['localizacao'] = $this->loc->atualizar($id);
		$this->template->set_partial('lateral', 'partials/lateral-localizacao')->set_layout('default')->build('localizacao/formEdiLocalizacao', $data);
	}

	public function editarLocalizacao(){

		//verificando a sessao
		$this->verificarSessao();

		//validaçao do formulario
		$this->form_validation->set_message('max_length', 'O campo %s excedeu o limite de caracteres.');
		$this->form_validation->set_rules('loc_nome', 'NOME', 'required|max_length[50]|ucwords');

		//pegando o id do formulario -> o campo esta escondido
		$id = $this->input->post('loc_id');

		//verificando se passou pela validacao
		if($this->form_validation->run() == TRUE){
			$dados = elements(array('loc_nome', 'loc_pavimento', 'loc_status'), $this->input->post());
			$retorno = $this->loc->editar($id, $dados);
			if($retorno == 1){
				$this->session->set_flashdata('ok', 'Editado efetuado com sucesso!');
				redirect('localizacao/listarLocalizacao');
			}
		}else{
			$this->listarLocalizacao();
		}

	}
	

	public function gerarQRCode($id){

		//verificando a sessao
		$this->verificarSessao();
		
		$query = $this->code->gerarQrCode($id, 1);
		if($query->result() != NULL){
			foreach($query->result() as $sql){
				header("Content-Type: image/png");
				header('Content-Disposition: attachment; filename= "qrcode.png"');

				$params['data'] = "Nome : ".$sql->loc_nome. "\n";
				$params['data'] .= "Pavimento: ".$sql->loc_pavimento."\n";
				$params['data'] .= "Status: ".($sql->loc_status==1?'Ativo':'Inativo');
				$this->ciqrcode->generate($params);

				header('Content-Disposition: attachment; filename= "'.$sql->loc_id.''.$sql->loc_nome.''.$sql->loc_pavimento.''.$sql->loc_status.'.png"');
			}

		}else{
			redirect('localizacao/listarLocalizacao', 'refresh');
		}
		
		
	}

}