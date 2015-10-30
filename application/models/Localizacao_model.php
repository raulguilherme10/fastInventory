<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Localizacao_model extends CI_Model
	{
		public function create($dados=NULL){

			//verificando se veio um array de dadods
			if($dados != NULL){
				//inserindo no bd
				$this->db->insert('tbl_local', $dados);
			}
		}

		public function editar($id=NULL, $dados=NULL){

			if($id != NULL){
				$this->db->where('loc_id', $id);
				$this->db->update('tbl_local', $dados);
				return 1;
			}

			return 0;
		}


		public function atualizar($id=NULL){
			//verificado o id no db
			$this->db->where('loc_id', $id);
			//retornando o resultado
			return $this->db->get('tbl_local')->result();
		}

		public function excluir($id=NULL){
			$this->db->where('loc_id', $id);
			return $this->db->delete('tbl_local');
		}

		public function listarTodos($origem=NULL){

			switch($origem){
				case 1:
					//query para trazer todos os dados da tabela
					$this->db->where('loc_id <> 84');
					return $this->db->get('tbl_local');
					break;

				case 2:
					//query para trazer todos os dados da tabela
					$this->db->order_by('loc_nome');
					return $this->db->get('tbl_local');
					break;
			}
			
		}

		public function pesquisarLocal($id){
			$this->db->where('loc_nome', $id);
			return $this->db->get('tbl_local');
		}



	}