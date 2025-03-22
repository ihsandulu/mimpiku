<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class register_M extends CI_Model {
	
	
	
	public function data()
	{	
		require_once("meta_m.php");
		$data=array();
		$data["message"]="";
		
		//cek customer
		$customer["customer_id"]=$this->session->userdata("customer_id");
		$us=$this->db
		->get_where('customer',$customer);	
		//echo $this->db->last_query();die;	
		if($us->num_rows()>0)
		{
			foreach($us->result() as $customer){		
				foreach($this->db->list_fields('customer') as $field)
				{
					$data[$field]=$customer->$field;
				}		
			}
		}else{				
			foreach($this->db->list_fields('customer') as $field)
			{
				$data[$field]="";
			}	
		}
		
		if(isset($_GET['message'])){$data["message"]=$_GET['message'];}
		if(isset($_POST["customer_email"])&&isset($_POST["customer_password"])){
			$user1=$this->db
			->where("customer_email",$this->input->post("customer_email"))
			->get('customer');
			$password="";
			if($user1->num_rows()>0){
				if($this->session->userdata("customer_id")==$user1->row()->customer_id){
					//update
					foreach($this->input->post() as $e=>$f){if($e!='change'&&$e!='mimpi_picture'){$input[$e]=$this->input->post($e);}}
					$input["customer_password"]=my_encrypt($input["customer_password"], $key);
					$this->db->update("customer",$input,array("customer_id"=>$this->session->userdata("customer_id")));
					$data["message"]="Update Success";
					//echo $this->db->last_query();die;
					$this->session->set_flashdata("message","Update Success");
					redirect(base_url());
				}else{
					$data["message"]="Email telah dimiliki seseorang. Pilih email yang lain!";
				}
			}else{
				foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
				$input["customer_password"]=my_encrypt($input["customer_password"], $key);
				$this->db->insert("customer",$input);
				$data["message"]="Insert Data Success";
				//echo $this->db->last_query();
				redirect(site_url("logincustomer"));
			}
		}	
		
		return $data;
	}
	
}
