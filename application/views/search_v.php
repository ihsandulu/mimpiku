<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<?php require_once("meta_v.php"); ?>	
	</head>
	<body>
	<div id="fh5co-page">
	<?php require_once("header_v.php"); ?>	
	<!--<div class="back-to-home btn-circle" style="top:-20px; right:-10px;">
		<a href="<?=base_url();?>"><span></span><em>Back</em></a>
	</div>-->
	
	<div class="container-fluid" id="fh5co-image-grid" style="padding-top:70px;">
		

		<div class="grid">
		  <div class="grid-sizer"></div>
		  <?php 

		 
		  $kata=$this->db
		  ->like("mimpi_juduli",$this->input->get("search"))
		  ->or_like("mimpi_judula",$this->input->get("search"))
		  ->order_by("mimpi_juduli","asc")
		  ->order_by("mimpi_judula","asc")
		  ->get("mimpi");
		  //echo $this->db->last_query();
		  foreach($kata->result() as $kata){
		  ?>
		  <div class="grid-item item " data-animate-effect="fadeIn">
		  
		  <?php
		  $link=urlencode ( $kata->mimpi_juduli );
		  $uri=htmlspecialchars($link, ENT_QUOTES | ENT_HTML5);
		  $hasil1='href="'.site_url("tafsir/".substr($kata->mimpi_juduli,0,1)."/".$uri).'"';
		  if($kata->mimpi_lock==0){
				$hasil=$hasil1;
		  }else{ 
		  	if($this->session->userdata("paket")=="1"||$this->session->userdata("paket")=="2"){
				$hasil=$hasil1;
			}else{
		  		$hasil='';
			}
		  }	 
		  ?>
		    <a <?=$hasil;?>>
				<div class="img-wrap" style="border:#AB0C8F dashed 1px; border-radius:5px;">
					<img src="<?=base_url("assets/images/abjad/search.jpg");?>" alt="" class="img-responsive" style="opacity:0.1;">
					<div class="tengah">
						<div style="color:black; text-shadow:white 1px 1px 1px; font-size:20px;"><?=$kata->mimpi_juduli;?></div>
						<div style="text-shadow:white 1px 1px 1px; color:black">(<?=$kata->mimpi_judula;?>)</div>						
					</div>
				</div>
				<div class="text-wrap">
					<div class="text-inner">
						<div>
							<div style="color:white; text-shadow:black 1px 1px 1px; font-size:20px;"><?=$kata->mimpi_juduli;?></div>
							<div style="text-shadow:black 1px 1px 1px; color:#F3F5A9">(<?=$kata->mimpi_judula;?>)</div>
						</div>
					</div>
				</div>
				<?php if($kata->mimpi_lock==1){?>
				<div class="fa fa-user-lock lock"></div>
				<?php }?>
			</a>
		  </div>
		  <?php }?>
		</div>

		
	</div>

	</div>
	<div style="height:110px;">&nbsp;</div>
	<?php require_once("footer_v.php"); ?>	
	
	

	</body>
</html>

