<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class user_M extends CI_Model {
	
	public function data()
	{	
		
		$data=array();	
		$data["message"]="";
		
		//position
		if(isset($_GET["position_id"])){
		$this->db->where("position_id",$_GET["position_id"]);
		}
		$posi=$this->db->get("position");
		//echo $this->db->last_query();die;	
		foreach($posi->result() as $position){
			foreach($this->db->list_fields("position") as $field){
				$f[$field]=$position->$field;
			}
		}
		$data["posisi"]=$f["position_name"];
		$data["posisiid"]=$f["position_id"];
		
		//cek user
		if(isset($_POST['new'])||isset($_POST['edit'])){		
			$userd["user_id"]=$this->input->post("user_id");
			$us=$this->db
			->join("position","position.position_id=user.position_id","left")
			->get_where('user',$userd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $user){		
					foreach($this->db->list_fields('user') as $field)
					{
						$data[$field]=$user->$field;
					}	
					foreach($this->db->list_fields('position') as $field)
					{
						$data[$field]=$user->$field;
					}		
				}
			}else{	
						
				foreach($this->db->list_fields('user') as $field)
				{
					$data[$field]="";
				}
				foreach($this->db->list_fields('position') as $field)
				{
					$data[$field]="";
				}		
				
			}
		}
		
		//compress image 
		function compress($source, $destination, $quality) {
	
			$info = getimagesize($source);
	
			if ($info['mime'] == 'image/jpeg') 
				$image = imagecreatefromjpeg($source);
	
			elseif ($info['mime'] == 'image/gif') 
				$image = imagecreatefromgif($source);
	
			elseif ($info['mime'] == 'image/png') 
				$image = imagecreatefrompng($source);
	
			imagejpeg($image, $destination, $quality);
	
			return $destination;
		}

		//upload image
		$word="";
		$data['uploaduser_picture']="";
		if(isset($_FILES['user_picture'])&&$_FILES['user_picture']['name']!=""){
		$user_picture=str_replace(' ', '_',$_FILES['user_picture']['name']);
		$words=explode(".",$user_picture);
		for ($i = 0; $i < count($words)-1; $i++)
		{
			$word.=$words[$i];
		}
		$user_picture=str_replace('.', '_',$word).".".$words[count($words)-1];
		$user_picture = date("H_i_s_").$user_picture;
		if(file_exists ('assets/images/user_picture/'.$user_picture)){
		unlink('assets/images/user_picture/'.$user_picture);
		}
		$config['file_name'] = $user_picture;
		$config['upload_path'] = 'assets/images/user_picture/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('user_picture'))
		{
			$data['uploaduser_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploaduser_picture']="Upload Success !";
			
			$source=$config['upload_path'].$user_picture;
			$destination=$config['upload_path']."a".$user_picture;
			$quality=10;
			//compress($source, $destination, $quality);
			
		
			$d = compress($source, $destination, 90);
			$input['user_picture']="a".$user_picture;
			
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$pic=$this->db->get_where("user",array("user_id"=>$this->input->post("user_id")));
			foreach($pic->result() as $picture){
				if($picture->user_picture!=""){
					unlink('assets/images/user_picture/'.$picture->user_picture);
				}
			}
			$this->db->delete("user",array("user_id"=>$this->input->post("user_id")));
			$data["message"]="Delete Success";
		}
		
		require_once("meta_m.php");
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$input["user_name"]=htmlentities($input["user_name"], ENT_QUOTES);
			$input["user_password"]=my_encrypt($this->input->post("user_password"), $key);
			$double=$this->db
			->where("user_name",$input["user_name"])
			->get("user");
			if($double->num_rows()==0){
				$this->db->insert("user",$input);		
				$data["message"]="Insert Data Success";
			}else{
				$data["message"]="User sudah ada!";			
			}
			if(isset($_GET['register'])){redirect(site_url("login?message=".$data["message"]));}
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("change")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='change'&&$e!='user_picture'){$input[$e]=$this->input->post($e);}}
			$input["user_name"]=htmlentities($input["user_name"], ENT_QUOTES);
			$input["user_password"]=my_encrypt($this->input->post("user_password"), $key);
			$this->db->update("user",$input,array("user_id"=>$this->input->post("user_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		//update
		if($this->input->post("update")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='update'&&$e!='user_picture'){$input[$e]=$this->input->post($e);}}
			$this->db->update("user",$input,array("user_id"=>$this->input->post("user_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		
		
		//data user
		if(!isset($_POST['new'])&&!isset($_POST['edit'])){		
			$userd["user_id"]=$this->session->userdata("user_id");
			$us=$this->db
			->join("position","position.position_id=user.position_id","left")
			->get_where('user',$userd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $user){		
					foreach($this->db->list_fields('user') as $field)
					{
						$data[$field]=$user->$field;
					}	
					foreach($this->db->list_fields('position') as $field)
					{
						$data[$field]=$user->$field;
					}	
				}
			}else{	
						
				foreach($this->db->list_fields('user') as $field)
				{
					$data[$field]="";
				}
				foreach($this->db->list_fields('position') as $field)
				{
					$data[$field]="";
				}	
			}
		}
		
		return $data;
	}
	
}
