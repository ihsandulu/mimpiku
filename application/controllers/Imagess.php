<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class imagess extends CI_Controller {


	public function index()
	{
		require_once 'lib/WideImage.php';
		$path=$this->input->get("path");
		$ekstensi=explode(".",$path);
		$ekstensi=end($ekstensi);
		
		$img = WideImage::load($path);
		
		//resize
		if(isset($_GET['resize']))
		{
			switch($_GET['resize']){
				case "kecil":
				$img=$img->resize(100, 100);
				break;
				case "sedang":
				$img=$img->resize(240, 240);
				break;
				case "besar":
				$img=$img->resize(320, 320);
				break;	
				case "super":
				$img=$img->resize(500, 500);
				break;		
				case "combo":
				$img=$img->resize(700, 700);
				break;		
				case "dinamite":
				$img=$img->resize(1000, 1000);
				break;			
				case "tank":
				$img=$img->resize(1200, 1200);
				break;				
			}
		}
		
		//crop
		if(isset($_GET['cl'])||isset($_GET['ct'])||isset($_GET['cw'])||isset($_GET['ch']))
		{
			//left,top,width,height
			//0, 0, 100, 50
			if(isset($_GET['cl'])){$l=$_GET['cl'];}else{$cl=0;}
			if(isset($_GET['ct'])){$t=$_GET['ct'];}else{$ct=0;}
			if(isset($_GET['cw'])){$w=$_GET['cw'];}else{$cw=0;}
			if(isset($_GET['ch'])){$h=$_GET['ch'];}else{$ch=0;}
			$img=$img->crop($cl, $ct, $cw, $ch);
		}
		
		//watermark
		if(isset($_GET['watermark'])||isset($_GET['wl'])||isset($_GET['wt'])||isset($_GET['wo']))
		{
			//watermark,left,top,opacity
			//a.jpg,center-10%,bottom+25%,50	

			if(isset($_GET['watermark'])){$watermark = WideImage::load($_GET['watermark']);}else{$watermark = WideImage::load("");}
			if(isset($_GET['wl'])){$wl=$_GET['wl'];}else{$wl=0;}
			if(isset($_GET['wt'])){$wt=$_GET['wt'];}else{$wt=0;}
			if(isset($_GET['wo'])){$wo=$_GET['wo'];}else{$wo=0;}
			$img=$img->merge($watermark, $wl, $wt, $wo);
		}
		
		echo $img->output($ekstensi);
	}
}
