<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mpaket extends CI_Controller {


	public function index()
	{
		$this->load->model('mpaket_m');
		$data=$this->mpaket_m->data();
		$this->parser->parse('mpaket_v',$data);
		
	}
}
