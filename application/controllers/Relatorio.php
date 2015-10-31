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

	public function gerarDivergencia($id=NULL){
		//verificando a sessao
		$this->verificarSessao();

		//verificar se existe o item solicitado
		$retorno = $this->ativo->listarFiscalizacao();
		$existe = NULL;

			//pesquisando na tbl_fiscalizacao se existe esse id
			foreach($retorno->result() as $res){
				if($res->fis_id == $id){
					$existe = 1;
					$local = $res->fis_local;
					$feito = $res->fis_status;
				}
			}

				if($existe == 1){
					if($feito == 0){
						//trocando o status da tbl_fiscalizar para 1
						$troca['fis_status'] = 1;
						$this->ativo->trocarStatus($id, $troca, 5);

						//Parte 1 - Listar todos os ativos que foram encontrados no local
						$data['fiscalizar'] = $retorno->result();
						$data['query'] = $this->ativo->listarDivergencia($id);
						$data['ativo'] = $this->ativo->listarTodosAtivos();
						$data['tipo'] = $this->ativo->listarTodosTipos();
						$data['local'] = $this->loc->listarTodos(2);
						$data['id'] = $id;

						//Parte 2 - Mostrar os ativos que estão no local errado
						$ativos = $this->ativo->pesquisarAtivo($local, 4); //pesquisando ativos por local
						$divergencia = $this->ativo->listarDivergencia($id); //pesquisando os ativos na tbl_diverg...

							//inserindo em um array os ativos incontrados na tbl_divergencia
							$num = 0;
							foreach($divergencia->result() as $res){
								$array[$num] = $res->div_idATV;
								//echo $res->div_idATV.'<br />';
								$num++;
							}

							$data['totalEncontrado'] = $array;

								//pesquisar para comparar se o ativo esta no local correto
								$result = count($array);
								$cont = 0;
								for($i = 0; $i < $result; $i++){
									$id = $array[$i];
									$retorno = $this->ativo->pesquisarAtivo($id, 2)->result();

									//verificando se o ativo não esta no local correto
									if($retorno[0]->atv_local != $local){
										//inserindo o id do ativo num array
										//pesquisando o ativo no array
										//retirando o ativo do array
										$localErrado[$cont] = $id;
										$posicao = array_search($id, $array);
										unset($array[$posicao]);
										$cont++;
									}
								}

								//inserindo o array de ativos em local errado no array data
								$data['localErrado'] = $localErrado;


						//Parte 3 - Mostrar os ativos que estão faltando
						$aux = FALSE;
						$cont = 0;
						//retirando do array o objeto que tras os ativos que estão em um determinado local
						foreach($ativos->result() as $res){//tabela de ativos

							for($i = 0; $i < $num; $i++){
								//verificando se existe o ativo esta no array
								if($res->atv_id == $array[$i]){
									$aux = TRUE;
								}
							}
								//se ele não existir no array, o status é mudado para inativo
								if($aux == FALSE){
									$dados['atv_status'] = 0;
									$ativoPerdidio[$cont] = $res->atv_id;
									$this->ativo->trocarStatus($res->atv_id, $dados, 4);
									$cont++;
								}

								$aux = FALSE;

						}

						$data['ativoPerdido'] = $ativoPerdidio;
						$this->gerarRelatorio($data, 3);


					}else{
						$data = file_get_contents('assets/docs/'.$id.'.pdf'); // Read the file's contents
						$name = 'relatorioDeDivergencia.pdf';

						force_download($name, $data);
					}
				}else{
					$this->session->set_flashdata('erro', 'Item não encontrado!');
					redirect('ativo/carregarRelatorio');
				}
	}

	public function gerarRelatorio($data=NULL, $origem=NULL){
		//verificando a sessao
		$this->verificarSessao();

			//iniciando o relatório
			$mpdf=new mPDF('','', 0, '', 15, 15, 35, 16, 9, 9, 'L');
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
					//conteúdo
					$mpdf->WriteHTML($html);
					//gerar pdf
					$mpdf->Output('historicoDoAtivo.pdf', 'D');
					break;

				case 2:
					$html = $this->load->view('relatorio/modelos/ativosPorLocal_view', $data, true);
					//titulo
					$mpdf->SetTitle('Ativos por Local');
					//conteúdo
					$mpdf->WriteHTML($html);
					//gerar pdf
					$mpdf->Output('ativosPorLocal.pdf', 'D');
					break;

				case 3:
					//titulo
					$mpdf->SetTitle('Relatório de Divergência');
					$html = $this->load->view('relatorio/modelos/divergencia_view', $data, true);
					$mpdf->WriteHTML($html);

					//adicionando uma nova página
					$mpdf->AddPage();
					$html = $this->load->view('relatorio/modelos/ativosLocalErrado_view', $data, true);
					$mpdf->WriteHTML($html);

					//adicionando uma nova página
					$mpdf->AddPage();
					$html = $this->load->view('relatorio/modelos/ativoNaoEncontrado_view', $data, true);
					$mpdf->WriteHTML($html);
					//gerar pdf
					$mpdf->Output('assets/docs/'.$data['id'].'.pdf', 'F');
					$mpdf->Output('relatorioDeDivergencia.pdf', 'D');
					break;
			}
			redirect('ativo/carregarRelatorio');
			
	}
}