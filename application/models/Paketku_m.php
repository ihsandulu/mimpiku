<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class paketku_M extends CI_Model {
	
	public function data()
	{	
		$data=array();	
		$data["message"]="";
		//cek mimpi
		$mimpid["mimpi_id"]=$this->input->post("mimpi_id");
		$us=$this->db
		->get_where('mimpi',$mimpid);	
		//echo $this->db->last_query();die;	
		if($us->num_rows()>0)
		{
			foreach($us->result() as $mimpi){		
				foreach($this->db->list_fields('mimpi') as $field)
				{
					$data[$field]=$mimpi->$field;
				}		
			}
		}else{				
			foreach($this->db->list_fields('mimpi') as $field)
			{
				$data[$field]="";
			}	
		}
		
		//upload image
		$data['uploadmimpi_picture']="";
		if(isset($_FILES['mimpi_picture'])&&$_FILES['mimpi_picture']['name']!=""){
		$mimpi_picture=str_replace(' ', '_',$_FILES['mimpi_picture']['name']);
		$mimpi_picture = date("H_i_s_").$mimpi_picture;
		if(file_exists ('assets/images/mimpi_picture/'.$mimpi_picture)){
		unlink('assets/images/mimpi_picture/'.$mimpi_picture);
		}
		$config['file_name'] = $mimpi_picture;
		$config['upload_path'] = 'assets/images/mimpi_picture/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf|doc|docx';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('mimpi_picture'))
		{
			$data['uploadmimpi_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadmimpi_picture']="Upload Success !";
			$input['mimpi_picture']=$mimpi_picture;
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$this->db->delete("mimpi",array("mimpi_id"=>$this->input->post("mimpi_id")));
			$data["message"]="Delete Success";
		}
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$this->db->insert("mimpi",$input);
			$data["message"]="Insert Data Success";
			//echo $this->db->last_query();
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("redeem")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='redeem'){$a[$e]=$this->input->post($e);}}
			
			//identifikasi kupon
			$mpaket=$this->db
			->where("mpaket_code",$a["kupon"])
			->get("mpaket");
			//echo $this->db->last_query();die;
			if($mpaket->num_rows() > 0){	
			
				//identifikasi double
				$paket=$this->db
				->where("mpaket_code",$a["kupon"])
				->get("paket");
				if($paket->num_rows() > 0){					
					$data["message"]="Kode telah terpakai! Masukkan Kode Redeem lain!";					
				}else{				
					$input["customer_id"]=$this->session->userdata("customer_id");
					$input["mpaket_code"]=$a["kupon"];
					$input["paket_date"]=date("Y-m-d");
					
					//cari tanggal awal
					$cariawal=$this->db
					->where("customer_id",$input["customer_id"])
					->order_by("paket_date","desc")
					->limit("1")
					->get("paket");
					//echo $this->db->last_query();die;
					if($cariawal->num_rows()>0){
						$awal=$cariawal->row()->paket_akhir;
						if($awal>=date("Y-m-d")){
							$date=date_create($awal);
							date_add($date,date_interval_create_from_date_string("1 days"));
							$awal=date_format($date,"Y-m-d");
						}else{
							$awal=date("Y-m-d");
						}						
					}else{
						$awal=$input["paket_date"];
					}
					
					//cari tanggal akhir
					$days=$mpaket->row()->mpaket_days;
					$date=date_create($awal);
					date_add($date,date_interval_create_from_date_string(($days-1)." days"));
					$akhir=date_format($date,"Y-m-d");
					
					$input["paket_awal"]=$awal;
					$input["paket_akhir"]=$akhir;
					$this->db->insert("paket",$input);
					$data["message"]="Redeem Success";
					//echo $this->db->last_query();die;
				}
				
			}else{
				$data["message"]="Kode Redeem Salah! Pastikan huruf Besar & Kecil ditulis dgn benar!";
			}
		}
		return $data;
	}
	
}
