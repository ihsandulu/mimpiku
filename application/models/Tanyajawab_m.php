<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class tanyajawab_M extends CI_Model {
	
	public function data()
	{	
		$data=array();	
		$data["message"]="";
		
				
		//cek tanya
		if(isset($_POST['new'])||isset($_POST['edit'])){		
			$tanyad["tanya_id"]=$this->input->post("tanya_id");
			$us=$this->db
			->get_where('tanya',$tanyad);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $tanya){		
					foreach($this->db->list_fields('tanya') as $field)
					{
						$data[$field]=$tanya->$field;
					}		
				}
			}else{	
						
				foreach($this->db->list_fields('tanya') as $field)
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
		$data['uploadtanya_picture']="";
		if(isset($_FILES['tanya_picture'])&&$_FILES['tanya_picture']['name']!=""){
		$tanya_picture=str_replace(' ', '_',$_FILES['tanya_picture']['name']);
		$words=explode(".",$tanya_picture);
		for ($i = 0; $i < count($words)-1; $i++)
		{
			$word.=$words[$i];
		}
		$tanya_picture=str_replace('.', '_',$word).".".$words[count($words)-1];
		$tanya_picture = date("H_i_s_").$tanya_picture;
		if(file_exists ('assets/images/tanya_picture/'.$tanya_picture)){
		unlink('assets/images/tanya_picture/'.$tanya_picture);
		}
		$config['file_name'] = $tanya_picture;
		$config['upload_path'] = 'assets/images/tanya_picture/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('tanya_picture'))
		{
			$data['uploadtanya_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadtanya_picture']="Upload Success !";
			
			$source=$config['upload_path'].$tanya_picture;
			$destination=$config['upload_path']."a".$tanya_picture;
			$quality=10;
			//compress($source, $destination, $quality);
			
		
			$d = compress($source, $destination, 90);
			$input['tanya_picture']="a".$tanya_picture;
			
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){			
			$this->db->delete("tanya",array("tanya_id"=>$this->input->post("tanya_id")));
			$this->db->delete("percakapan",array("tanya_id"=>$this->input->post("tanya_id")));
			$data["message"]="Delete Success";
		}
		
		//insert
		if($this->input->post("insert")=="OK"){
			$tanya["tanya_user"]=$this->input->post("tanya_user");
			$tanya["tanya_title"]=$this->input->post("tanya_title");
			$this->db->insert("tanya",$tanya);
			$percakapan["tanya_id"]=$this->db->insert_id();
			$data["message"]="Insert Data Success";
			//echo $this->db->last_query();die;
				
			$percakapan['percakapan_user']=$this->input->post("percakapan_user");
			$percakapan['percakapan_content']=$this->input->post("percakapan_content");
			$this->db->insert("percakapan",$percakapan);
			
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("update")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='update'&&$e!='tanya_picture'){$input[$e]=$this->input->post($e);}}
			
		}
		//closed
		if(isset($_POST['closed'])){
			foreach($this->input->post() as $e=>$f){$input1[$e]=$this->input->post($e);}
			$input["tanya_status"]=$input1["closed"];
			$where["tanya_id"]=$input1["tanya_id"];
			$this->db->update("tanya",$input,$where);	
			//echo $this->db->last_query();		
		}
		return $data;
	}
	
}
