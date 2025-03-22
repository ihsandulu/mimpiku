<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class paket extends CI_Controller {


	public function index()
	{
		$this->load->model('paket_m');
		$data=$this->paket_m->data();
		$this->parser->parse('paket_v',$data);
		
	}
}
