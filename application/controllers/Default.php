<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Default extends CI_Controller {
	
	public function index(){
		$this->template->set_layout('default')->build('conteudo');

	}

}