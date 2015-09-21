<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Paginacao_model extends CI_Model{

		public function paginacao($opc, $nome){
			
			$nome .= '%';

			switch($opc){
				case 1:
					$config['base_url'] = base_url('localizacao/listarLocalizacao');
					$config['total_rows'] = $this->db->get('tbl_local')->num_rows();
				break;

				case 2:
					$config['base_url'] = base_url('localizacao/pesquisarLocalizacao');
					$config['total_rows'] = $this->db->get('tbl_local')->num_rows();
					
				break;

				case 3:
					$config['base_url'] = base_url('localizacao/pesquisarLocalizacao');
					$config['total_rows'] = $this->db->query('select * from tbl_local where loc_pavimento like ?', $nome);
				break;

				case 4:
					$config['base_url'] = base_url('localizacao/pesquisarLocalizacao');
					$config['total_rows'] = $this->db->query('select * from tbl_status where loc_nome like ?', $nome);
				break;
			}

					//inicio paginaçao
					$config['per_page'] = 10;
					$config['num_links'] = 5;
					$config['full_tag_open'] = '<div><ul class="pagination pagination-sm">';
			    	$config['full_tag_close'] = '</ul></div>';
			    	$config['page_query_string'] = FALSE;
				    $config['prev_link'] = '&lt; Anterior';
				    $config['prev_tag_open'] = '<li>';
				    $config['prev_tag_close'] = '</li>';
				    $config['next_link'] = 'Próximo &gt;';
				    $config['next_tag_open'] = '<li>';
				    $config['next_tag_close'] = '</li>';
				    $config['cur_tag_open'] = '<li class="active"><a href="#">';
				    $config['cur_tag_close'] = '</a></li>';
				    $config['num_tag_open'] = '<li>';
				    $config['num_tag_close'] = '</li>';
				    $config['first_link'] = FALSE;
				    $config['last_link'] = FALSE;


					//iniciando a paginacao
					$this->pagination->initialize($config);

					return $config['per_page'];
		}
	}