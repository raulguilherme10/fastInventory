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
				}
				
			}
		}

		public function listarTodosTipos(){
			$this->db->order_by('tip_nome');
			return $this->db->get('tbl_tipo');
		}

		public function listarTodosEmpresas(){
			$this->db->order_by('emp_nomeFantasia');
			return $this->db->get('tbl_empresa');
		}

		public function listarTodosItens(){
			$this->db->order_by('ntf_numNota');
			return $this->db->get('tbl_notaFiscal');
		}

		public function atualizarEmpresa($cnpj = NULL){
			$this->db->where('emp_cnpj', $cnpj);
			return $this->db->get('tbl_empresa')->result();
		}

		public function editarEmpresa($cnpj=NULL, $data=NULL){
			if($cnpj != NULL){
				$this->db->where('emp_cnpj', $cnpj);
				$this->db->update('tbl_empresa', $data);
				return 1;
			}

		}

		public function trocarStatus($data=NULL, $origem=NULL){
			if($cnpj != NULL){
				switch($origem){
					case 1:
						$this->db->where('emp_cnpj', $id);
						$this->db->update
					break;
				}
			}

		}

		public function verificarStatus($id=NULL, $origem=NULL){

			if($origem != NULL){
				switch($origem){
					case 1:
						//verificar o status da empresa
						$this->db->where('emp_status', $data['emp_cnpj']);
						$this->db->get('tbl_empresa', $data);
						return 1;
					break;
				}
			}
		}
	}