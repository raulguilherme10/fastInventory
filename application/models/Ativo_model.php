<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Ativo_model extends CI_Model{

		//funcao para cadastrar empresa na tbl_empresa 
		public function create($dados=NULL){
			if($dados != NULL){
				$this->db->insert('tbl_empresa', $dados);
			}
		}
	}