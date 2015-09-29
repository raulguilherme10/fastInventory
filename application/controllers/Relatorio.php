<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('mpdf/mpdf');
	}

	//funçao para verificar se a sessao do usuario foi ativada
	public function verificarSessao(){
		if($this->session->userdata('logado') == FALSE){
			redirect('login');
		}
	}

	public function index(){

		$data['query'] = $this->db->get('tbl_local');
		$hora = 23;

		$html = $this->load->view('relatorio/modelos/modelo_ativoPorLocal', $data, true);;
		$mpdf = new mPDF(); 
		$mpdf->SetHeader('<img src="././assets/images/fatec.png " width="110px" height="50px" alt="Logo Fatec"/>|Faculdade de Tecnologia Dom Amaury Castanho <br />Av. Tiradentes, 1211 - Parque Industrial, Itu - SP, 13309-640 <br />(11) 4013-1872|');
		$mpdf->SetFooter('|Página {PAGENO} de {nb}|www.fatecitu.edu.br');
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		exit;

	}
}