<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Usuario_model extends CI_Model{

		public function listarGrupos(){
			return $this->db->get('tbl_grupoUsuario');
		}

		public function create($dados){
			//verificando se veio um array de dadods
			if($dados != NULL){
				//inserindo no bd
				$this->db->insert('tbl_usuario', $dados);
			}
		}
	}