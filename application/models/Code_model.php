<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Code_model extends CI_Model{

		public function gerarQrCode($id, $origem){

			switch($origem){
				case 1:
					$query = $this->db->query('Select * from tbl_local where loc_id = ?', $id);
					return $query;
					break;

				case 2:
					$this->db->join('tbl_local', 'loc_id = atv_local', 'inner');
					$this->db->join('tbl_produto', 'pro_id = atv_idPro', 'inner');
					$this->db->where('atv_id', $id);
					return $this->db->get('tbl_ativo')->result();
					break;
			}
		}
	}