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

		public function verificarSenha($id=NULL){
			$this->db->select('usu_senha');
			$this->db->where('usu_id', $id);
			return $this->db->get('tbl_usuario');
		}

		public function trocarSenha($id=NULL, $data){
			//verificando se veio o id do usuario
			if($id != NULL){
				$this->db->where('usu_id', $id);
				$this->db->update('tbl_usuario', $data);
				return 1;
			}else{
				return 0;
			}
		}

		public function trocarStatus($id=NULL, $data){
			
			//verificando se o id eh nulo
			//se nao for faz um update no bd
			if($id != NULL){
				$this->db->where('usu_id', $id);
				$this->db->update('tbl_usuario', $data);
			}
			
		}

		public function verificarStatus($id=NULL){

			//verificando se o id eh nulo
			//se nao for tras o usuario do db
			if($id != NULL){
				$this->db->where('usu_id', $id);
				return $this->db->get('tbl_usuario');
			}else{
				return 0;
			}
			
		}
	}