
	<amp-auto-ads type="adsense"
				  data-ad-client="ca-pub-6192668857872931">
	</amp-auto-ads>
	
	<?php if($this->uri->segment(1)=="detail"){?>
		<div class="col-md-1 col-sm-2 col-xs-6 mt-3 mb-3 pull-right  text-center back" style="">
			<a href="<?=base_url();?>"><span class="fas fa-reply"></span> Back</a>
		</div>	
	<?php }elseif($this->uri->segment(1)=="search"){?>
		<div class="col-md-1 col-sm-2 col-xs-6 mt-3 mb-3 pull-right  text-center back" style="">
			<a href="<?=base_url();?>"><span class="fas fa-reply"></span> Back</a>
		</div>
	<?php }elseif($this->uri->segment(1)=="tafsir"){?>
		<div class="col-md-1 col-sm-2 col-xs-6 mt-3 mb-3 pull-right  text-center back" style="">
			<a href="<?=site_url("detail/".strtolower($this->uri->segment(2)));?>" style=""><span class="fas fa-reply"></span> Back</a>
		</div>
	<?php }?>
	
	<a href="https://play.google.com/store/apps/details?id=com.qithy.mimpiku" class="col-md-1 col-sm-6 col-xs-6  mt-3 mb-3 pull-right text-center" style="padding:10px;">
	<img src="<?=base_url("assets/images/global/mimpikupanjang.png");?>" style="height:30px; width:auto;"/> 
	</a>

	<form action="<?=site_url("search");?>" class="form col-md-3 col-sm-4 col-xs-6 mt-3 mb-3 pull-right">
		<div class="input-group">
			<input name="search" type="text" class="form-control" placeholder="Search" style="height:50px; font-size:18px;">
			<div class="input-group-append">
				<button class="btn btn-success" type="submit" style="height:50px;">Go</button>  
			</div>
		</div>
	</form>
	<?php if($this->session->userdata("customer_id")>0){?>
	<div class="col-md-1 col-sm-1 col-xs-6 mt-3 mb-3 pull-right  text-center back" style="">
		<a href="<?=site_url("logoutcustomer");?>"><span class="fas fa-sign-out-alt"></span> Keluar</a>
	</div>
	<?php }?>
	<div class="col-md-2 col-sm-2 col-xs-6 mt-3 mb-3 pull-right  text-center back" style="">
		<?php if($this->session->userdata("customer_id")>0){?>
		<a href="<?=site_url("register");?>" style="margin-right:30px;"><span class="fas fa-user"></span> <?=$this->session->userdata("customer_name");?></a>
		<a href="<?=site_url("tanya");?>"><span class="fas fa-sign-in-alt"></span> Bertanya</a>
		<?php }else{?>
		<a href="<?=site_url("register");?>" style="margin-right:30px;"><span class="fas fa-user-plus"></span> Register</a>
		<a href="<?=site_url("logincustomer");?>"><span class="fas fa-sign-in-alt"></span> Login</a>
		<?php }?>
	</div>
	<?php if($this->session->userdata("customer_id")>0){?>	
	<div class="col-md-1 col-sm-1 col-xs-6 mt-3 mb-3 pull-right  text-center back" style="">
		<a href="<?=site_url("paketku");?>"><span class="fas fa-address-book"></span> Paket</a>
	</div>
	<?php }?>
	<div class="col-md-1 col-sm-1 col-xs-6 mt-3 mb-3 pull-right  text-center back" style="">
		<a href="<?=base_url();?>"><span class="fas fa-home"></span> Home</a>
	</div>
	
	<div style="clear:both; line-height:0px;"></div>
	<hr/>
	
	<img src="<?=base_url("assets/images/global/bawahkiri.png");?>" style="position:fixed; bottom:10px; left:10px; opacity:0.3; z-index:-1;" />
	
	<div class="aside-toggle1" onclick="bukaprolog();">
		<a href="#"><img src="<?=base_url("assets/images/global/read.png");?>" style="object-fit:cover; height:30px; width:auto;" /></a>
	</div>

	

	<div id="fh5co-aside1">
		<div class="aside-toggle1" onclick="bukaprolog();">
			<a href="#"><img src="<?=base_url("assets/images/global/read.png");?>" style="object-fit:cover; height:30px; width:auto;" /></a>
		</div>
		<div class="col-md-12">
			<h2>Tafsir Mimpi Sesuai Sunnah</h2>
		</div>
		<img src="<?=base_url("assets/images/identity_picture/".$identity->identity_picture);?>" style="object-fit:cover; height:70px; width:auto;" />
		<div class="col-md-12" id="fh5co-bio1">
			<?=$identity->identity_about;?>
		</div>
	</div>
	
	

  <!-- The Modal -->
  <div class="modal" id="infoModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        
        
        <!-- Modal body -->
        <div class="modal-body">
          <?=$this->session->flashdata("message");?>
          <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>