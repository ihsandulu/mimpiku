<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class percakapan extends CI_Controller {


	public function index()
	{
		$this->load->model('percakapan_m');
		$data=$this->percakapan_m->data();
		$this->parser->parse('percakapan_v', $data);
	}
}
