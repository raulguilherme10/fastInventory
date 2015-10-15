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

				}
				
			}
		}

		public function listarTodosTipos(){
			$this->db->order_by('tip_nome');
			return $this->db->get('tbl_tipo');
		}

		public function listarTodasEmpresas(){
			$this->db->where('emp_status = 1');
			$this->db->order_by('emp_nomeFantasia');
			return $this->db->get('tbl_empresa');
		}

		public function listarTodosProdutos(){
			$this->db->join('tbl_tipo', 'tip_id = pro_idTipo', 'inner');
			return $this->db->get('tbl_produto');
		}

		public function listarTodosItens(){
			$this->db->order_by('ntf_numNota');
			return $this->db->get('tbl_notaFiscal');
		}

		public function listarTodasNF(){
			$this->db->join('tbl_empresa', 'emp_cnpj = ntf_cnpjEmp', 'inner');
			return $this->db->get('tbl_notaFiscal');
		}

		public function atualizarEmpresa($cnpj = NULL){
			$this->db->where('emp_cnpj', $cnpj);
			return $this->db->get('tbl_empresa')->result();
		}

		public function atualizarProduto($id = NULL){
			$this->db->where('pro_id', $id);
			return $this->db->get('tbl_produto')->result();
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

				}
			}
		}

		public function pesquisarProduto($id = NULL){
			$this->db->where('pro_id', $id);
			return $this->db->get('tbl_produto');
		}


	}