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

		

		public function excluir($id=NULL){

			$this->db->where('loc_id', $id);
			return $this->db->delete('tbl_local');
		}

		public function listarTodos(){
			//query para trazer todos os dados da tabela
			return $this->db->get('tbl_local');
		}



	}