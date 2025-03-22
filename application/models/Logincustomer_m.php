<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class logincustomer_M extends CI_Model {
	
	
	
	public function data()
	{	
		require_once("meta_m.php");
		$data=array();
		$data["message"]="";
		if(isset($_GET['message'])){$data["message"]=$_GET['message'];}
		if(isset($_POST["customer_email"])&&isset($_POST["customer_password"])){
			$customer1=$this->db
			->where("customer_email",$this->input->post("customer_email"))
			->get('customer');
			$password="";
			if($customer1->num_rows()>0){
				foreach($customer1->result() as $customer){
					$password=$customer->customer_password;
					if($this->input->post("customer_password") == my_decrypt($password, $key)){
						foreach($this->db->list_fields('customer') as $field)
						{
							$this->session->set_userdata($field,$customer->$field);						
							//echo $this->session->customerdata($field);
						}		
						redirect(base_url());
					}else{
						$data["message"]=" Access Denied !";
					}				
				}				
			}else{
				$data["message"]=" Access Denied !";
			}
		}	
		return $data;
	}
	
}
