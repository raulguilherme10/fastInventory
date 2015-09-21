<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localizacao extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Localizacao_model', 'loc');
		$this->load->model('Paginacao_model', 'pag');
		$this->load->model('Code_model', 'code');
		$this->load->library('ciqrcode');
	}

	public function cadastrarLocalizacao(){

		//validaçao do formulario
		$this->form_validation->set_message('max_length', 'O campo %s excedeu o limite de caracteres.');
		$this->form_validation->set_message('is_unique', 'Esse %s para localização já existe no banco de dados.');
		$this->form_validation->set_rules('loc_nome', 'NOME', 'required|is_unique[tbl_local.loc_nome]|max_length[50]|ucwords');

		//verificando se passou pela validacao
		if($this->form_validation->run() == TRUE){
			$dados = elements(array('loc_nome', 'loc_pavimento', 'loc_status'), $this->input->post());
			$this->loc->create($dados);
			$this->session->set_flashdata('ok', 'Cadastro efetuado com sucesso!');

			redirect(base_url('localizacao/listarLocalizacao'));
			
		}
		
		$this->template->set_partial('lateral', 'partials/lateral-localizacao')->set_layout('default')->build('localizacao/formCadLocalizacao');
	}

	public function listarLocalizacao(){

		$dados['query'] = $this->db->get('tbl_local');

		$this->load->view('localizacao/listarLocalizacao_view', $dados);
		$this->template->set_partial('lateral', 'partials/lateral-localizacao')->set_layout('default')->build('localizacao/listarLocalizacao_view');
		
	}

	public function excluirLocalizacao($id=NULL){
		//verificando uma condicao e deletando um item da tabela
		$this->db->where('loc_id', $id);
		if($this->db->delete('tbl_local')){
			$this->session->set_flashdata('ok', 'Exclusão efetuada com sucesso!');
		}

		redirect(base_url('localizacao/listarLocalizacao'));
	}

	public function atualizarLocalizacao($id=NULL){
		$this->db->where('loc_id', $id);
		$data['localizacao'] = $this->db->get('tbl_local')->result();
		$this->template->set_partial('lateral', 'partials/lateral-localizacao')->set_layout('default')->build('localizacao/formEdiLocalizacao', $data);
	}

	public function editarLocalizacao(){
		//validaçao do formulario
		$this->form_validation->set_message('max_length', 'O campo %s excedeu o limite de caracteres.');
		$this->form_validation->set_rules('loc_nome', 'NOME', 'required|max_length[50]|ucwords');

		$id = $this->input->post('loc_id');
		$this->db->where('loc_id', $id);
		//verificando se passou pela validacao
		if($this->form_validation->run() == TRUE){
			$dados = elements(array('loc_nome', 'loc_pavimento', 'loc_status'), $this->input->post());
			
			if($this->db->update('tbl_local', $dados)){
				$this->session->set_flashdata('ok', 'Editado efetuado com sucesso!');
				redirect('localizacao/listarLocalizacao');
			}
		}

	}
	

	public function gerarQRCode($id){
		$query = $this->code->gerarQrCode($id, 'local');
		if($query->result() != NULL){
			foreach($query->result() as $sql){
				header("Content-Type: image/png");
				header('Content-Disposition: attachment; filename= "qrcode.png"');

				$params['data'] = "Nome : ".$sql->loc_nome. "\n";
				$params['data'] .= "Pavimento: ".$sql->loc_pavimento."\n";
				$params['data'] .= "Status: ".($sql->loc_status==1?'Ativado':'Desativado');
				$this->ciqrcode->generate($params);

				header('Content-Disposition: attachment; filename= "'.$sql->loc_id.''.$sql->loc_nome.''.$sql->loc_pavimento.''.$sql->loc_status.'.png"');
			}

		}else{
			redirect('localizacao/listarLocalizacao', 'refresh');
		}
		
		
	}

}