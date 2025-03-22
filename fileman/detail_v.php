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
	
	<div class="back-to-home btn-circle" style="top:-20px; right:-10px;">
		<a href="<?=base_url();?>"><span></span><em>Back</em></a>
	</div>
	
	<div class="container-fluid" id="fh5co-image-grid" style="padding-top:70px;">
		

		<div class="grid">
		  <div class="grid-sizer"></div>
		  <?php 

		 
		  $kata=$this->db
		  ->where("SUBSTR(mimpi_juduli,1,1)",$this->uri->segment(2))
		  ->get("mimpi");
		 
		  foreach($kata->result() as $kata){
		  ?>
		  <div class="grid-item item animate-box" data-animate-effect="fadeIn">
		  <?php
		  $link=urlencode ( $kata->mimpi_juduli );
		  $uri=htmlspecialchars($link, ENT_QUOTES | ENT_HTML5);
		  $hasil=site_url("tafsir/".$this->uri->segment(2)."/".$uri);	
		  ?>
		    <a href="<?=$hasil;?>">
				<div class="img-wrap">
					<img src="<?=base_url("assets/images/abjad/".$this->uri->segment(2).".jpg");?>" alt="" class="img-responsive" >
					<div class="tengah">
						<div style="color:white; text-shadow:black 1px 1px 1px; font-size:20px;"><?=$kata->mimpi_juduli;?></div>
						<div style="text-shadow:black 1px 1px 1px; color:#F3F5A9">(<?=$kata->mimpi_judula;?>)</div>						
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
			</a>
		  </div>
		  <?php }?>
		</div>

		
	</div>

	</div>
	
	<?php require_once("footer_v.php"); ?>	
	
	

	</body>
</html>

