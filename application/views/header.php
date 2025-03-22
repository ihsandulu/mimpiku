<?php
	$ip = getenv('HTTP_CLIENT_IP')?:
	getenv('HTTP_X_FORWARDED_FOR')?:
	getenv('HTTP_X_FORWARDED')?:
	getenv('HTTP_FORWARDED_FOR')?:
	getenv('HTTP_FORWARDED')?:
	getenv('REMOTE_ADDR');
	$input["hitstat_date"]=date("Y-m-d");
	$input["hitstat_ip"]=$ip;
	$input["hitstat_page"]=current_url();
	$this->db->insert("hitstat",$input);
	$hitstat=$this->db
	->where("hitstat_date",date("Y-m-d"))
	->group_by("hitstat_ip")
	->get("hitstat");
	$hitstat_numrows = $hitstat->num_rows();	
?>
<div class="hitstat fa fa-bar-chart" title="<?=$hitstat_numrows;?> pengunjung hari ini" data-toggle="tooltip"> 
 <?=$hitstat_numrows;?> pengunjung hari ini
</div>

<div id="loading" style="position:fixed; top:50%; left:50%; tranform:translate(-50%,-50%); z-index:100; font-size:38px; color:#975833; display:none;" class="fa fa-spinner fa-pulse"></div>

<!-- My Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>		  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	<script>
	function aktivas(){
		var aktivasi = $("#aktivasi").val();
		$.get("https://www.qithy.com/aktivasi/api/cekaktivasi",{aktivasi:aktivasi})
		.done(function(data){
			if(data!=-1){
				$.get("<?=site_url("api/inputaktivasi");?>",{activate_no:aktivasi,activate_max:data})
				.done(function(id){
					
						alert("Aktifasi Berhasil."); window.location.href="<?=site_url("logout");?>";
					
						//$(".modal-body").text("Aktivasi tidak berhasil!");
					
				})
				.fail(function(){
				alert( "error" );
				});
			}else{
				alert("Aktifasi Gagal!."); 
			}
		});
	}
	</script>

 <!-- Balas pesan-->
 <div class="modal fade" id="pesanmodal" role="dialog">
    <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Balas Pesan</h4>
        </div>
        <div class="modal-body">
			 <form class="form-horizontal">
			  <div class="form-group">
				<label class="control-label col-sm-2" for="email">Email:</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" id="emailpesan" placeholder="Enter email" readonly="">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="pwd">Isi Pesan:</label>
				<div class="col-sm-10">
				  <textarea type="password" class="form-control" id="pesannya" ></textarea>
				  <script>
					var roxyFileman = '<?=site_url("fileman/index.html");?>'; 
					  CKEDITOR.replace(
						'pesan',{filebrowserBrowseUrl:roxyFileman,
													filebrowserImageBrowseUrl:roxyFileman+'?type=image',
													removeDialogTabs: 'link:upload;image:upload',
													height: '200px',
													stylesSet: 'my_custom_style'}
						); 
					</script>
				</div>
			  </div>
			  <input type="hidden" id="message_content">
			  <input type="hidden" id="message_id">
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button onclick="kirimpesan()" type="button" class="btn btn-default">Submit</button>
				</div>
			  </div>
			</form> 		  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>      
    </div>
  </div>
  <script>
  function kirimpesan(){
  $.get("<?=site_url("api/kirimemail");?>",{emailtujuan:$("#emailpesan").val(),pesan:$("#pesannya").val(),message_id:$("#message_id").val(),message_content:$("#message_content").val()})
  .done(function(data){
  	alert(data);
	var id = "#balas"+$("#message_id").val();
	var balasan = "#balasan"+$("#message_id").val();
	var status = "#status"+$("#message_id").val();
	$(id).hide();
	$(balasan).html($("#pesannya").val());
	$(status).html("Terbalas");
  	$("#pesanmodal").modal("hide");
	$("#emailpesan").val("");
	$("#pesannya").val("");
	$("#message_id").val("");
  });
  }
  </script>
  
 <!-- Image Modal -->
  <div class="modal fade" id="myImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
			<button type="button" class="close btn btn-xs btn-danger" data-dismiss="modal" style="padding:5px;">&times;</button>
			<div id="imgcontent">
          		<img id="imgumum" src="<?=base_url("assets/images/global/image.gif");?>" style="width:100%; height:100%;"/>
			</div>
        </div>
      </div>
      
    </div>
  </div>

<div id="navbar" class="navbar navbar-default          ace-save-state" style="background: linear-gradient(to bottom right, #999999, #CCCCCC);">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?=site_url("utama");?>" class="navbar-brand">
						<small>
							<img src="<?=base_url("assets/images/identity_picture/".$identity->identity_picture);?>" style="height:25px; width:auto;">
							<?=$identity->identity_name;?>
						</small>
					</a>
				</div>
				<?php if(!isset($_GET['register'])){?>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle" id="userdetail" style="background: linear-gradient(to bottom right, #757575, #B0B0B0);">
								<?php if($this->session->userdata("user_picture")==""){$imgprofil="user.gif";}else{$imgprofil=$this->session->userdata("user_picture");}?>
								<img class="nav-user-photo" src="<?=base_url("assets/images/user_picture/".$imgprofil);?>" alt="Photo" style="height:40px; width:auto;"/>
								<span class="user-info">
									<small>Welcome,</small>
									<?=ucfirst($this->session->userdata("user_name"));?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close" role="menu" aria-labelledby="userdetail">
								<li role="presentation">
									<a role="menuitem" href="<?=site_url("user?id=".$this->session->userdata("user_id"));?>">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li role="presentation">
									<a role="menuitem" href="<?=site_url("logout");?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<?php }?>
			</div><!-- /.navbar-container -->
		</div>
        
        <div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar responsive ace-save-state" style="background-color:#E0E0E0;">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <ul class="nav nav-list">
            <li class="active">
                <a href="<?=site_url("utama");?>" style="background: linear-gradient(to bottom right, #757575, #B0B0B0); color:#FFFFFF;">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>
			<?php if($this->session->userdata("position_id")==1){?>
            <li class="">
                <a href="#" class="dropdown-toggle limenu">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
                        Master
                    </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>
				
                <ul class="submenu">
					<li class="">
						<a href="<?=site_url("user");?>">
							<i class="menu-icon fa fa-user"></i>
							User						</a>						
						<b class="arrow"></b>					
					</li>
					<li class="">
						<a href="<?=site_url("identity");?>">
							<i class="menu-icon fa fa-marker"></i>
							Identity						
						</a>						
						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="<?=site_url("customer");?>">
							<i class="menu-icon fa fa-marker"></i>
							Customer						
						</a>						
						<b class="arrow"></b>
					</li>
				</ul>
				
            </li>
			<?php }?>
			<?php if(!isset($_GET['register'])){?>
            <li class="">
                <a href="#" class="dropdown-toggle limenu">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Transaksi</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">								      
					<li class="">
						<a href="<?=site_url("mimpi");?>">
							<i class="menu-icon fa fa-cube"></i>
							Mimpi
						</a>
					</li> 								      
					<li class="">
						<a href="<?=site_url("mpaket");?>">
							<i class="menu-icon fa fa-cube"></i>
							Generate Paket
						</a>
					</li> 							      
					<li class="">
						<a href="<?=site_url("paket");?>">
							<i class="menu-icon fa fa-cube"></i>
							Paket
						</a>
					</li> 
					<li class="">
						<a href="<?=site_url("tanyajawab");?>">
							<i class="menu-icon fa fa-user"></i>
							Tanya Jawab Admin
						</a>
					</li> 	
                </ul>
            </li>
			<li class="">
                <a target="_blank" href="<?=site_url("inde");?>" class="limenu">
                    <i class="menu-icon fa fa-globe"></i>
                    <span class="menu-text"> Website </span>
                </a>
			</li>
			<li class="">
                <a href="<?=site_url("logout");?>" class="limenu">
                    <i class="menu-icon fa fa-sign-out"></i>
                    <span class="menu-text"> Logout </span>
                </a>
			</li>
			<?php }?>
        </ul>
    </div>
    <?php //print_r($_SESSION);?>