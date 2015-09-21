<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
		 $this->load->view('login/login_view');
		}
	}

	public function index(){
		if (!$this->ion_auth->logged_in()){
		 $this->load->view('login/login_view');
		} else {
			$this->template->set_partial('lateral', 'partials/lateral-home')->set_layout('default')->build('home/conteudo');
		}
	}

	public function teste(){
		if (!$this->ion_auth->logged_in()){
		 $this->load->view('login/login_view');
		} else {
			$this->template->set_partial('lateral', 'partials/lateral-home')->set_layout('default')->build('home/conteudo-home2');
		}

		
	}

}