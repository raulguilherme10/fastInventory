<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Code_model extends CI_Model{

		public function gerarQrCode($id, $tabela){
			if($tabela == 'local'){
				$query = $this->db->query('Select * from tbl_local where loc_id = ?', $id);
			}else{
				if($tabela == 'ativo'){
					$query = $this->db->query('Select * from tbl_ativo where loc_id = ?', $id);
				}
			}
			
			return $query;
		}
	}