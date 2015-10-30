<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Ativo_model', 'ativo');
		$this->load->model('Localizacao_model', 'loc');
		$this->load->library('mpdf/mpdf');
		$this->load->model('localizacao_model', 'loc');
	}

	//funçao para verificar se a sessao do usuario foi ativada
	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function pesquisarHistorico(){
		//verificando a sessao
		$this->verificarSessao();

		//recebendo os valores do formulário
		$data['pesq'] = $this->input->post('pesq');
		$data['opc'] = $this->input->post('opc');

			switch($data['opc']){
				case 0:
					$id = $data['pesq'];
					$retorno = NULL;
					$retorno = $this->ativo->pesquisarAtivo($id, 2)->result();

						if($retorno != NULL){
							$data['query'] = $this->ativo->pesquisarHistorico($data, 2);
							$this->gerarRelatorio($data, 1);						
						}else{
							$this->session->set_flashdata('erro', 'Ativo não encontrado!');
							redirect('ativo/carregarRelatorio');
						}
					break;

				case 1:
					$this->form_validation->set_rules('pesq', 'Pesquisa', 'is_natural');
					if($this->form_validation->run() == TRUE){

						$id = $data['pesq'];
						$retorno = NULL;
						$retorno = $this->ativo->pesquisarAtivo($id, 5)->result();

							if($retorno != NULL){
								$data['query'] = $this->ativo->pesquisarHistorico($data, 2);
								$this->gerarRelatorio($data, 1);						
							}else{
								$this->session->set_flashdata('erro', 'Ativo não encontrado!');
								redirect('ativo/carregarRelatorio');
							}
					}else{
						$this->session->set_flashdata('erro', 'Ativo não encontrado!');
						redirect('ativo/carregarRelatorio');
					}
					break;

				case 2:
					$this->form_validation->set_rules('pesq', 'Pesquisa', 'ucwords');
					if($this->form_validation->run() == TRUE){
						$id = $this->input->post('pesq');
						$retorno = NULL;
						$retorno = $this->loc->pesquisarLocal($id, 1)->result();
						$data['pesq'] = $id;

							if($retorno != NULL){
								$local = $this->loc->listarTodos(2);
								foreach($local->result() as $res){
									if($res->loc_nome == $data['pesq']){
										$data['pesq'] = $res->loc_id;
									}
								}

								$data['query'] = $this->ativo->pesquisarHistorico($data, 2);
								$this->gerarRelatorio($data, 1);
							}else{
								$this->session->set_flashdata('erro', 'Localização não encontrada!');
								redirect('ativo/carregarRelatorio');
							}
					}
					
					break;
			}
	}

	public function ativosPorLocal(){
		//verificando a sessao
		$this->verificarSessao();

		$id = $this->input->post('opc');
		$data['local'] = $this->loc->pesquisarLocal($id, 2)->result();
		$data['query'] = $this->ativo->pesquisarAtivo($id, 4);
		$this->gerarRelatorio($data, 2);
	}

	public function gerarRelatorio($data=NULL, $origem=NULL){
		//verificando a sessao
		$this->verificarSessao();

			//iniciando o relatório
			$mpdf=new mPDF('','', 0, '', 15, 15, 25, 16, 9, 9, 'L');
			//tamanho do pdf 
			$mpdf->SetDisplayMode('fullpage');
			//cabeçalho
			$mpdf->SetHeader('|Faculdade de Tecnologia Dom Amaury Castanho <br /> 	Av. Tiradentes, 1211 - Parque Industrial, Itu - SP, 13309-640 <br />(11) 4013-1872|');
			//rodapé
			$mpdf->SetFooter('|Página {PAGENO} de {nb}|www.fatecitu.edu.br');

			switch($origem){
				case 1:
					$html = $this->load->view('relatorio/modelos/historicoAtivo_view', $data, true);
					//titulo
					$mpdf->SetTitle('Histórico do Ativo');
					break;

				case 2:
					$html = $this->load->view('relatorio/modelos/ativosPorLocal_view', $data, true);
					//titulo
					$mpdf->SetTitle('Ativos por Local');
					break;
			}

			//conteúdo
			$mpdf->WriteHTML($html);
			//gerar pdf
			$mpdf->Output();
	}
}