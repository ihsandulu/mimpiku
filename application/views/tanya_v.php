<!DOCTYPE HTML>

<html>
	<head>
	<?php require_once("meta_v.php"); ?>	
	<style>
	#content{
		background-image: url("<?=base_url("assets/images/global/atas.png");?>");
		background-repeat: no-repeat;
		background-position: left top;
		background-attachment: fixed;
	}
	</style>
	<script>
		<?php
		$tambah=0;
		$sesi=$this->session->userdata("itung");
		$itung=(int)$sesi;
		$tambah=$itung+1;
		if($itung==3){
		$this->session->set_userdata("itung","0");
		?>
		//alert();
		setTimeout(function(){
			$("#konten").hide();
		},100);
		<?php }else{
		$this->session->set_userdata("itung",(string)$tambah);
		?>
		
		$("#konten").show();
		
		<?php }?>
	</script>
	</head>
	<body>
	<div id="fh5co-page">
		<?php require_once("header_v.php"); ?>	
		
		<div class="container" style="margin-top:60px;">
	
			
			 
			  <div class="text-center" style="z-index:100 !important; text-align:center;">
				<span class="beyond" style="font-size:28px; font-weight:bold; color:black; text-shadow:#FFFFFF 1px 1px 1px;  text-align:center;">Tanya Tafsir Mimpi</span>
				<span style="font-size:20px; font-weight:bold; color:#1F1F1F; margin-left:20px; text-shadow:#FFFFFF 1px 1px 1px;">(<?=$this->session->userdata("customer_name");?>)</span>
			
				<div>
				<?php if(!isset($_POST['new'])&&!isset($_POST['edit'])&&$this->session->userdata("customer_id")>0){?>	
				<?php
					if($this->session->userdata("paket")==0||$this->session->userdata("paket")==2){
				?>			
				<form method="post" class="" style="">							
				   
					<button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="height:50px;">New</button>
					<input type="hidden" name="mimpi_id"/>
				   
				</form>
				<?php }?>
			  
				<?php }else{?>
				<form action="<?=site_url("tanya");?>" method="get" class="" style="height:50px;">							
				   
					<button class="btn btn-warning btn-block btn-lg" value="OK" style="">Back</button>		
				   
				</form>
				<?php }?>
				</div>
				
				<div id="content" class="text-left" style="background-color:#FFFFFF; color:#000000; padding:20px; border-radius:5px; margin-top:20px; border:#AB0C8F dashed 1px; border-radius:5px; position:relative;">
					<?php if($message!=""){?>
					<div class="alert alert-info alert-dismissable">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong><?=$message;?></strong>
					</div>
					
					<?php }?>
					
					
					<?php if(isset($_POST['new'])||isset($_POST['edit'])){?>
						<div class="">
							<?php if(isset($_POST['edit'])){$namabutton='name="change"';$judul="Update Pertanyaan";}else{$namabutton='name="create"';$judul="Tanya Mimpi";}?>	
							<div class="lead"><h3><?=$judul;?></h3></div>
							<form class="form-horizontal" method="post" enctype="multipart/form-data">
							  <div class="form-group">
								<label class="control-label col-sm-2" for="mimpi_juduli">Judul Pertanyaan:</label>
								<div class="col-sm-10">
								  <input type="text" autofocus class="form-control" id="tanya_title" name="tanya_title" placeholder="Enter Title" value="<?=$tanya_title;?>">
								</div>
							  </div>
							  
							  
							  <input type="hidden" name="tanya_id" value="<?=$tanya_id;?>"/>					  					  
							  <div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submit" class="btn btn-primary col-md-5" <?=$namabutton;?> value="OK">Submit</button>
									<button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?=site_url("tanya");?>">Back</button>
								</div>
							  </div>
							</form>
						</div>
					<?php }else{?>	
					<table class="table table-striped">
						<thead>
						  <tr>
							<th>Aksi</th>
							<th>Tgl</th>
							<th>Judul</th>
							<th>Status</th>
						  </tr>
						</thead>
						<tbody>
							<?php 
							$tanya=$this->db
							->where("customer_id",$this->session->userdata("customer_id"))
							->get("tanya");
							$status=array("Open","Terjawab","Closed");
							foreach($tanya->result() as $tanya){
							?>
						  <tr>
							<td style=""; font-weight:bold;">
								<form action="tanyad" method="get" class="col-md-6" style="padding:0px;">
									<button class="btn btn-warning " value="OK"><span class="fa fa-comment-dots" style="color:white;"></span> </button>
									<input type="hidden" name="tanya_id" value="<?=$tanya->tanya_id;?>"/>
								</form>
								<!--
								<form method="post" class="col-md-6" style="padding:0px;">
									<button class="btn btn-danger delete" name="delete" value="OK"><span class="fa fa-times" style="color:white;"></span> </button>
									<input type="hidden" name="tanya_id" value="<?=$tanya->tanya_id;?>"/>
								</form>	
								-->
							</td>
							<td><?=$tanya->tanya_date;?></td>
							<td><?=$tanya->tanya_title;?></td>
							<td><?=$status[$tanya->tanya_status];?></td>
						  </tr>
						  <?php }?>
						</tbody>
					  </table>		
					<?php }?>	
				</div>
			  </div>
			
			
			
	
			
		</div>

	</div>
	<?php require_once("footer_v.php"); ?>	
	
	

	</body>
</html>

