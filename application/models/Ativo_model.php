<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Ativo_model extends CI_Model{

		//funcao para cadastrar empresa na tbl_empresa 
		public function create($dados=NULL, $origem=NULL){
			if($dados != NULL){

				switch($origem){

					case 1:
						$this->db->insert('tbl_empresa', $dados);
						break;

					case 2:
						$this->db->insert('tbl_produto', $dados);
						break;

					case 3:
						$this->db->insert('tbl_notaFiscal', $dados);
						break;

					case 4:
						$this->db->insert('tbl_item', $dados);
						break;

					case 5:
						$this->db->insert('tbl_ativo', $dados);
						break;

					case 6:
						$this->db->insert('tbl_historico', $dados);
						break;

					case 7:
						$this->db->insert('tbl_tipo', $dados);

				}
				
			}
		}

		public function listarTodosTipos(){
			$this->db->order_by('tip_nome');
			return $this->db->get('tbl_tipo');
		}

		public function listarTodasEmpresas(){
			$this->db->order_by('emp_nomeFantasia');
			return $this->db->get('tbl_empresa');
		}

		public function listarEmpresasCombo(){
			$this->db->where('emp_status = 1');
			$this->db->order_by('emp_nomeFantasia');
			return $this->db->get('tbl_empresa');
		}

		public function listarTodosProdutos($origem){
			switch($origem){
				case 1:
				$this->db->join('tbl_tipo', 'tip_id = pro_idTipo', 'inner');
				$this->db->where('pro_status', $origem);
				return $this->db->get('tbl_produto');

				case 2:
				$this->db->join('tbl_tipo', 'tip_id = pro_idTipo', 'inner');
				return $this->db->get('tbl_produto');
				break;
			}
			
		}

		public function listarTodosItens(){
			$this->db->order_by('ntf_numNota');
			return $this->db->get('tbl_notaFiscal');
		}

		public function listarTodasNF(){
			$this->db->join('tbl_empresa', 'emp_cnpj = ntf_cnpjEmp', 'inner');
			return $this->db->get('tbl_notaFiscal');
		}

		public function listarItemNF($id=NULL, $cnpj=NULL){
			$this->db->join('tbl_produto', 'pro_id = itm_idPro', 'inner');
			$this->db->where('itm_idNTF', $id);
			$this->db->where('itm_cnpjNTF', $cnpj);
			return $this->db->get('tbl_item');
		}

		public function listarTodosAtivos(){
			$this->db->join('tbl_notaFiscal', 'ntf_id = atv_idNTF', 'inner');
			$this->db->join('tbl_produto', 'pro_id = atv_idPro', 'inner');
			$this->db->join('tbl_local', 'loc_id = 	atv_local', 'inner');
			return $this->db->get('tbl_ativo');
		}

		public function atualizarEmpresa($cnpj = NULL){
			$this->db->where('emp_cnpj', $cnpj);
			return $this->db->get('tbl_empresa')->result();
		}

		public function atualizarProduto($id = NULL){
			$this->db->where('pro_id', $id);
			return $this->db->get('tbl_produto')->result();
		}

		public function atualizarNF($id=NULL, $cnpj=NULL){
			$this->db->where('ntf_id', $id);
			$this->db->where('ntf_cnpjEmp', $cnpj);
			return $this->db->get('tbl_notaFiscal')->result();
		}

		public function atualizarTipo($id=NULL){
			$this->db->where('tip_id', $id);
			return $this->db->get('tbl_tipo')->result();
		}

		public function editarTipo($id=NULL, $data=NULL){
			$this->db->where('tip_id', $id);
			$this->db->update('tbl_tipo', $data);
		}

		public function editarEmpresa($cnpj=NULL, $data=NULL){
			if($cnpj != NULL){
				$this->db->where('emp_cnpj', $cnpj);
				$this->db->update('tbl_empresa', $data);
				return 1;
			}

		}

		public function editarProduto($id=NULL, $data=NULL){
			if($id != NULL){
				$this->db->where('pro_id', $id);
				$this->db->update('tbl_produto', $data);
				return 1;
			}

		}

		public function editarNF($id=NULL, $cnpj=NULL, $data=NULL){
			if($id != NULL && $cnpj != NULL){
				$this->db->where('ntf_id', $id);
				$this->db->where('ntf_cnpjEmp', $cnpj);
				$this->db->update('tbl_notaFiscal', $data);
				return 1;

			}else{
				return 0;
			}
		}

		public function editarAtivo($id=NULL, $data=NULL){
			if($id != NULL){
				$this->db->where('atv_id', $id);
				$this->db->update('tbl_ativo', $data);
				return 1;
			}else{
				return 0;
			}

		}

		public function trocarStatus($id=NULL, $data=NULL, $origem){

			switch ($origem) {
				case 1:
					$this->db->where('emp_cnpj', $id);
					$this->db->update('tbl_empresa', $data);
					break;

				case 2:
					$this->db->where('pro_id', $id);
					$this->db->update('tbl_produto', $data);
					break;

				case 3:
					$this->db->where('ntf_id', $id['id']);
					$this->db->where('ntf_cnpjEmp', $id['cnpj']);
					$this->db->update('tbl_notaFiscal', $data);
					break;

				case 4:
					$this->db->where('atv_id', $id);
					$this->db->update('tbl_ativo', $data);
					break;

				case 5:
					$this->db->where('fis_id', $id);
					$this->db->update('tbl_fiscalizar', $data);
					break;

			}
			

		}

		public function verificarStatus($id=NULL, $origem=NULL){

			if($origem != NULL){
				switch($origem){
					case 1:
						//verificar o status da empresa
						$this->db->where('emp_cnpj', $id);
						return $this->db->get('tbl_empresa');
						break;

					case 2:
						$this->db->where('pro_id', $id);
						return $this->db->get('tbl_produto');
						break;
					case 3:
						$this->db->where('ntf_id', $id['id']);
						$this->db->where('ntf_cnpjEmp', $id['cnpj']);
						return $this->db->get('tbl_notaFiscal');
						break;
				}
			}
		}

		public function verificar($dados=NULL, $origem=NULL){
			if($origem != NULL){
				switch($origem){
					case 1:
						$this->db->where('itm_idNTF', $dados['idNF']);
						return $this->db->get('tbl_item')->result();
						break;
				}
			}
		}

		public function pesquisarEmpresa($cnpj){
			$this->db->where('emp_cnpj', $cnpj);
			return $this->db->get('tbl_empresa')->result();
		}

		public function pesquisarProduto($id = NULL){
			$this->db->where('pro_id', $id);
			return $this->db->get('tbl_produto');
		}

		public function pesquisarItem($dados=NULL, $origem=NULL){
			switch($origem){
				case 1:
					$this->db->where('itm_idNTF', $dados['id']);
					$this->db->where('itm_cnpjNTF', $dados['cnpj']);
					$this->db->where('itm_idPro', $dados['Prod']);
					return $this->db->get('tbl_item')->result();
					break;

				case 2:
					$this->db->where('itm_id', $dados);
					return $this->db->get('tbl_item')->result();
					break;
			}
			
		}

		public function pesquisarNF($dados, $origem=NULL){
			switch($origem){
				
				case 1:
					$this->db->where('ntf_cnpjEmp', $dados['cnpj']);
					return $this->db->get('tbl_notaFiscal')->result();
					break;

				case 2:
					$this->db->where('ntf_id', $dados['idNF']);
					return $this->db->get('tbl_notaFiscal')->result();
					break;

			}
			
		}

		public function pesquisarAtivo($id=NULL, $origem=NULL){
			
			switch($origem){
				case 1:
					$this->db->where('atv_idITM', $id);
					return $this->db->get('tbl_ativo');
					break;

				case 2:
					$this->db->join('tbl_local', 'loc_id = atv_local', 'inner');
					$this->db->join('tbl_produto', 'pro_id = atv_idPro', 'inner');
					$this->db->join('tbl_item', 'itm_id = atv_idITM', 'inner');
					$this->db->where('atv_id', $id);
					return $this->db->get('tbl_ativo');
					break;

				case 3:
					$this->db->order_by("atv_id", "desc");
					$this->db->limit(1); 
					return $this->db->get('tbl_ativo');
					break;

				case 4:
					$this->db->join('tbl_produto', 'pro_id = atv_idPro', 'inner');
					$this->db->where('atv_local', $id);
					return $this->db->get('tbl_ativo');
					break;

				case 5:
					$this->db->join('tbl_local', 'loc_id = atv_local', 'inner');
					$this->db->join('tbl_produto', 'pro_id = atv_idPro', 'inner');
					$this->db->where('atv_numPatr', $id);
					return $this->db->get('tbl_ativo');
					break;
			}

		}

		public function pesquisarHistorico($id=NULL, $origem=NULL){
			switch($origem){
				case 1:
					$this->db->join('tbl_produto', 'pro_id = his_idPRO', 'inner');
					$this->db->join('tbl_local', 'loc_id = his_local', 'inner');
					$this->db->where('his_idATV', $id);
					return $this->db->get('tbl_historico');
					break;

				case 2:
					if($id['opc']==0){
						$this->db->join('tbl_produto', 'pro_id = his_idPRO', 'inner');
						$this->db->join('tbl_local', 'loc_id = his_local', 'inner');
						$this->db->where('his_idATV', $id['pesq']);
						return $this->db->get('tbl_historico');
					}else{
						if($id['opc'] == 1){
							$this->db->join('tbl_produto', 'pro_id = his_idPRO', 'inner');
							$this->db->join('tbl_local', 'loc_id = his_local', 'inner');
							$this->db->where('his_numPatr', $id['pesq']);
							return $this->db->get('tbl_historico');
						}else{
							$this->db->join('tbl_produto', 'pro_id = his_idPRO', 'inner');
							$this->db->join('tbl_local', 'loc_id = his_local', 'inner');
							$this->db->where('his_local', $id['pesq']);
							return $this->db->get('tbl_historico');
						}
						
					}
					break;
			}
		}

		public function excluir($id=NULL, $origem=NULL){

			switch($origem){

				case 1:
					$this->db->where('emp_cnpj', $id);
					$this->db->delete('tbl_empresa');
					break;

				case 2:
					$this->db->where('ntf_id', $id['idNF']);
					$this->db->delete('tbl_notaFiscal');
					break;

				//excluindo ativos 
				case 3:
					$this->db->where('atv_idITM', $id);
					$this->db->delete('tbl_ativo');
					break;

				case 4:
					$this->db->where('itm_id', $id);
					$this->db->delete('tbl_item');
					break;
			}
		}

		public function listarFiscalizacao(){
			$this->db->join('tbl_local', 'loc_id = fis_local', 'inner');
			return $this->db->get('tbl_fiscalizar');
		}

		public function listarDivergencia($id){
			$this->db->join('tbl_produto', 'pro_id = div_idPRO', 'inner');
			$this->db->join('tbl_empresa', 'emp_cnpj = div_cnpjEMP', 'inner');
			$this->db->join('tbl_ativo', 'atv_id = div_idATV', 'inner');
			$this->db->where('div_idFis', $id);
			return $this->db->get('tbl_divergencia');
		}


	}