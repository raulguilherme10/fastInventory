<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Teste_model extends CI_Model
	{

		public function listarTodosInventarios(){
			$this->db->join('tbl_local', 'loc_id = fis_local', 'inner');
			return $this->db->get('tbl_fiscalizar');
		}

		public function create($dados=NULL){
			$this->db->insert('tbl_fiscalizar', $dados);
		}

		public function inserirItem($dados=NULL){
			$this->db->insert('tbl_divergencia', $dados);
		}
	}