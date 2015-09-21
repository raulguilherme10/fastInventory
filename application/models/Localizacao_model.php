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

		public function pesquisar($nome, $tipo, $paginas, $seg){
			//fazendo uma query para pesquisar uma determinada localizacao
			//$this->db->limit($seg, $paginas);
			$this->db->select('*');
        	$this->db->from('tbl_local');
        	$this->db->like('loc_nome', $nome, 'after');
        	$query = $this->db->get();

			return $query;
			
		}



	}