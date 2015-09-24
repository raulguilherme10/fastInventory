<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Login_model extends CI_Model{

		public function logar($usuario, $senha){
			$this->db->where('usu_usuario', $usuario);
			$this->db->where('usu_senha', $senha);
			$this->db->where('usu_status', 1);
			return $this->db->get('tbl_usuario')->result();
		}
	}