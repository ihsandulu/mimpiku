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
				<span class="beyond" style="font-size:28px; font-weight:bold; color:black; text-shadow:#FFFFFF 1px 1px 1px;  text-align:center;">Paket Ku</span>
				<span style="font-size:20px; font-weight:bold; color:#1F1F1F; margin-left:20px; text-shadow:#FFFFFF 1px 1px 1px;">(<?=$this->session->userdata("customer_name");?>)</span>
				<div class="well" style="font-size:14px; text-align:center;" align="center">
					<form class="form-inline col-md-6" action="" style="text-align:center;" method="post">	
					  <div class="form-group">
						<label for="redeem">Reedem Voucher Paket Disini: &nbsp; &nbsp;</label>
						<input type="text" class="form-control" name="kupon">
					  </div>
					   &nbsp; &nbsp;
					  <button type="submit" name="redeem" class="btn btn-success" value="OK">Redeem</button>
					</form>
					<div class="col-md-6">
						Beli Voucher di sini : 
						<a href="https://www.tokopedia.com/madubibis" target="_blank" class="btn btn-default"><img src="<?=base_url("assets/images/global/tokopedia.png");?>" style="height:20px; "/></a>
						<a href="https://shopee.co.id/ihsandulu" target="_blank" class="btn btn-default"><img src="<?=base_url("assets/images/global/shopee.png");?>" style="height:20px; "/></a>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div id="content" class="text-left" style="background-color:#FFFFFF; color:#000000; padding:20px; border-radius:5px; margin-top:20px; border:#AB0C8F dashed 1px; border-radius:5px; position:relative;">
					<?php if($message!=""){?>
					<div class="alert alert-info alert-dismissable">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong><?=$message;?></strong>
					</div>
					
					<?php }?>
					<table class="table table-striped">
						<thead>
						  <tr>
							<th>Tgl</th>
							<th>Paket</th>
							<th>Dari</th>
							<th>Ke</th>
							<th>Type</th>
							<th>Status</th>
						  </tr>
						</thead>
						<tbody>
							<?php 
							$paket=$this->db
							->join("mpaket","mpaket.mpaket_code=paket.mpaket_code","left")
							->where("customer_id",$this->session->userdata("customer_id"))
							->get("paket");
							$tipe=array("Tanya","Baca","Tanya & Baca");
							foreach($paket->result() as $paket){
								if(date("Y-m-d")>=$paket->paket_awal && date("Y-m-d")<=$paket->paket_akhir){
									$status="Aktif";
									$warna="green";
								}else{
									$status="Tidak Aktif";
									$warna="grey";
								}
							?>
						  <tr>
							<td><?=$paket->paket_date;?></td>
							<td><?=$paket->mpaket_name;?></td>
							<td><?=$paket->paket_awal;?></td>
							<td><?=$paket->paket_akhir;?></td>
							<td><?=$tipe[$paket->mpaket_type];?></td>
							<td style="color:<?=$warna;?>; font-weight:bold;"><?=$status;?></td>
						  </tr>
						  <?php }?>
						</tbody>
					  </table>			
				</div>
			  </div>
			
			
			
	
			
		</div>

	</div>
	<?php require_once("footer_v.php"); ?>	
	
	

	</body>
</html>

