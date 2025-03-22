<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class percakapan_M extends CI_Model {
	
	public function data()
	{	
		$data=array();	
		$data["message"]="";
		
				
	
		
		
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
		$data['uploadtanyad_picture']="";
		if(isset($_FILES['tanyad_picture'])&&$_FILES['tanyad_picture']['name']!=""){
		$tanyad_picture=str_replace(' ', '_',$_FILES['tanyad_picture']['name']);
		$words=explode(".",$tanyad_picture);
		for ($i = 0; $i < count($words)-1; $i++)
		{
			$word.=$words[$i];
		}
		$tanyad_picture=str_replace('.', '_',$word).".".$words[count($words)-1];
		$tanyad_picture = date("H_i_s_").$tanyad_picture;
		if(file_exists ('assets/images/tanyad_picture/'.$tanyad_picture)){
		unlink('assets/images/tanyad_picture/'.$tanyad_picture);
		}
		$config['file_name'] = $tanyad_picture;
		$config['upload_path'] = 'assets/images/tanyad_picture/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('tanyad_picture'))
		{
			$data['uploadtanyad_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadtanyad_picture']="Upload Success !";
			
			$source=$config['upload_path'].$tanyad_picture;
			$destination=$config['upload_path']."a".$tanyad_picture;
			$quality=10;
			//compress($source, $destination, $quality);
			
		
			$d = compress($source, $destination, 90);
			$input['tanyad_picture']="a".$tanyad_picture;
			
		}
	
	}
	 
		//dibaca
		if($this->session->userdata("position_id")==1){
			$where["tanyajawab_id"]=$this->input->get("tanyajawab_id");
			$dibaca["tanyad_dibaca"]="1";
			$this->db->update("tanyad",$dibaca,$where);
		}
		
		//delete
		if($this->input->post("delete")=="OK"){			
			$this->db->delete("tanyad",array("tanyad_id"=>$this->input->post("tanyad_id")));
			$data["message"]="Delete Success";
		}
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$input["tanya_id"]=$this->input->get("tanya_id");
			$input["tanyad_person"]="1";
			$this->db->insert("tanyad",$input);
			$data["message"]="Insert Data Success";
			
			$input2["tanya_status"]="1";
			$where2["tanya_id"]=$input["tanya_id"];
			$this->db->update("tanya",$input2,$where2);	
			//echo $this->db->last_query();
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("update")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='update'&&$e!='tanyad_picture'){$input[$e]=$this->input->post($e);}}
			
		}
		
			//cek tanyad
			
			$tanyadd["tanyad_id"]=$this->input->post("tanyad_id");
			$us=$this->db
			->get_where('tanyad',$tanyadd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $tanyad){		
					foreach($this->db->list_fields('tanyad') as $field)
					{
						$data[$field]=$tanyad->$field;
					}		
				}
			}else{	
						
				foreach($this->db->list_fields('tanyad') as $field)
				{
					$data[$field]="";
				}	
				
			}
			
		return $data;
	}
	
}
