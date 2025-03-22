<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tanyad extends CI_Controller {


	public function index()
	{
		$this->load->model('tanyad_m');
		$data=$this->tanyad_m->data();
		$this->parser->parse('tanyad_v',$data);
		
	}
}
