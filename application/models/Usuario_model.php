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

		public function listarTodos($id=NULL){
			//trazendo todos os usuarios
			$this->db->where('tbl_usuario.usu_id <> ', $id);
			return $this->db->get('tbl_usuario');
		}

		public function excluir($id=NULL){
			$this->db->where('usu_id', $id);
			return $this->db->delete('tbl_usuario');
		}

		public function restaurarSenha($id=NULL, $data){
			//$this->db->update('tbl_usuario');
			if($id != NULL){
				$this->db->where('usu_id', $id);
				$this->db->update('tbl_usuario', $data);
				return 1;
			}else{
				return 0;
			}

		}

		public function verificarSenha($senha){

		}

		public function trocarSenha($id){
			//verificando se veio o id do usuario
			if($id != NULL){
				$this->db->where('usu_id', $id);
				$this->db->update('tbl_usuario', $data);
				return 1;
			}else{
				return 0;
			}
		}
	}