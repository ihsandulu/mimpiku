<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class login_M extends CI_Model {
	
	
	
	public function data()
	{	
		require_once("meta_m.php");
		$data=array();
		$data["hasil"]="";
		if(isset($_GET['message'])){$data["hasil"]=$_GET['message'];}
		if(isset($_POST["name"])&&isset($_POST["user_password"])){
			$user1=$this->db
			->where("user_name",$this->input->post("name"))
			->get('user');
			$password="";
			if($user1->num_rows()>0){
				foreach($user1->result() as $user){
					$password=$user->user_password;
					$position=$user->position_id;
					if($this->input->post("user_password") == my_decrypt($password, $key)){
						foreach($this->db->list_fields('user') as $field)
						{
							$this->session->set_userdata($field,$user->$field);						
							//echo $this->session->userdata($field);
						}		
					}else{
						$data["hasil"]=" Access Denied !";
					}				
				}	
				if($this->input->post("user_password") == my_decrypt($password, $key)){
					if($position==0){
						$data["hasil"]=" Access Denied !";
					}else{
						redirect(site_url("utama"));					
					}
				}
				
			}else{
				$data["hasil"]=" Access Denied !";
			}
		}	
		
		return $data;
	}
	
}
