<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tanyajawab extends CI_Controller {


	public function index()
	{
		$this->load->model('tanyajawab_m');
		$data=$this->tanyajawab_m->data();
		$this->parser->parse('tanyajawab_v', $data);
	}
}
