<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mimpi extends CI_Controller {


	public function index()
	{
		$this->load->model('mimpi_m');
		$data=$this->mimpi_m->data();
		$this->parser->parse('mimpi_v',$data);
		
	}
}
