<!doctype html>
<html>

<head>
    <?php 
	require_once("meta.php");
	require_once("meta_m.php");
	?>
</head>

<body class="no-skin">
<?php require_once("header.php");?>
	<div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="<?=site_url();?>">Home</a>
                    </li>
                    <li class="active">User</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        User
                    </h1>
					<?php if((!isset($_POST['new'])&&!isset($_POST['edit'])&&$this->session->userdata("position_id")==1&&!isset($_GET['id']))||isset($_GET['register'])){?>
                    
                    <form method="post" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button name="new" class="btn btn-info btn-block btn-sm" value="OK" style="">
						<?=(isset($_GET['register']))?"Daftar Baru":"New";?>
						</button>
                        <input type="hidden" name="user_id"/>
                       
                    </form>
                  
                    <?php }
					
					if(isset($_POST['new'])||isset($_POST['edit'])){?>
					<form action="<?=site_url("user");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button class="btn btn-warning btn-block btn-sm" value="OK" style="">Back</button>		
                       
                    </form>
					<?php }?>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <?php if(isset($_POST['new'])||isset($_POST['edit'])||isset($_GET['register'])){?>
                                <div class="">
                                    <?php if(isset($_POST['edit'])){$namabutton='name="change"';$judul="Update User";}else{$namabutton='name="create"';$judul="New User";}?>	
                                    <div class="lead"><h3><?=$judul;?></h3></div>
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                      
                                      
                                    
								  <div class="form-group">
									<label class="control-label col-sm-2" for="user_name">User Name :</label>
									<div class="col-sm-10">
									  <input type="user_name" class="form-control" id="user_name" name="user_name" placeholder="Enter Username" value="<?=$user_name;?>">
									</div>							  
								</div>
									
									<div class="col-md-offset-2 col-md-10 alert alert-danger alert-dismissable fade in" id="cekuser" style="display:none;">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Perhatian!</strong> Username telah digunakan.
                                    </div>
        
                                      <script>
                                      $("#user_name").keyup(function(){                                       
                                          $.get("<?=site_url("api/cekuser");?>",{user:'user_name',isi:$("#user_name").val()})
                                          .done(function(data){
                                            if(data>0){
                                                $("#cekuser").fadeIn();$("#submit").prop("disabled","disabled");
                                            }else{
                                                $("#cekuser").fadeOut();$("#submit").prop("disabled","");
                                            }
                                          });
                                      });
                                      </script>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="user_password">Password:</label>
                                        <div class="col-sm-10"> 
                                          <input type="text" class="form-control" id="user_password" name="user_password" placeholder="Enter password" value="<?=($user_password!="")?my_decryptv($user_password, $key):"";?>">
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label class="control-label col-sm-2" for="user_email">Email:</label>
                                        <div class="col-sm-10"> 
                                          <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter Email" value="<?=$user_email;?>">
                                        </div>
                                      </div>
									  
									  <div class="form-group">
                                        <label class="control-label col-sm-2" for="user_lengkap">Nama Lengkap:</label>
                                        <div class="col-sm-10"> 
                                          <input type="text" class="form-control" id="user_lengkap" name="user_lengkap" value="<?=$user_lengkap;?>">
                                        </div>
                                      </div>
									  
									  <div class="form-group">
										<label for="user_nik" class="control-label col-sm-2">NIK:</label>
                                        <div class="col-sm-10"> 
											<input type="text" class="form-control" id="user_nik" name="user_nik" value="<?=$user_nik;?>">
										</div>
									  </div>
									  
									  <div class="form-group">
                                        <label class="control-label col-sm-2" for="user_address">Alamat:</label>
                                        <div class="col-sm-10"> 
                                          <input type="text" class="form-control" id="user_address" name="user_address" value="<?=$user_address;?>">
                                        </div>
                                      </div>
									  
									  
									  
									  <div class="form-group">
										<label for="user_posisikerja" class="control-label col-sm-2">Tempat, Tgl Lahir:</label>
										<div class="col-sm-10">
                                          <input type="text" class="" id="user_user_birthplace" name="user_birthplace" value="<?=$user_birthplace;?>">
                                          <input type="date" class="" id="user_birthdate" name="user_birthdate" value="<?=$user_birthdate;?>">
										</div>
									  </div>
									  
									  
									  
									  <div class="form-group">
										<label for="user_gender" class="control-label col-sm-2">Gender:</label>
										<div class="col-sm-10">
											<img onClick="gender('Pria')" title="Men" data-togle="tooltip" src="<?=base_url("assets/images/global/men.png");?>" class="img img-responsive img-rounded" style="width:50px; height:auto; float:left; cursor:pointer;">
											<img onClick="gender('Wanita')" title="Women" data-togle="tooltip" src="<?=base_url("assets/images/global/women.png");?>" class="img img-responsive img-rounded" style="width:50px; height:auto; cursor:pointer;">
                                          <input required type="text" class="form-control" id="user_gender" name="user_gender" value="<?=$user_gender;?>">
										  <script>
										  function gender(a){
										  	$("#user_gender").val(a);
										  }
										  </script>
										</div>
									  </div>
									  
									  
									  
									  <div class="form-group">
										<label for="user_posisikerja" class="control-label col-sm-2">Posisi Pekerjaan:</label>
										<div class="col-sm-10">
                                          <input type="text" class="form-control" id="user_posisikerja" name="user_posisikerja" value="<?=$user_posisikerja;?>">
										</div>
									  </div>
									  
									  <div class="form-group">
                                        <label class="control-label col-sm-2" for="user_phone">Telepon:</label>
                                        <div class="col-sm-10"> 
                                          <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?=$user_phone;?>">
                                        </div>
                                      </div>
									  
									  <?php if($this->session->userdata("position_id")==1){?>
									  <div class="form-group">
									<label class="control-label col-sm-2" for="position_id">Posisi:</label>
									<div class="col-sm-10">
									  <select class="form-control" id="position_id" name="position_id">
									  	<option <?=($position_id==0)?"selected":"";?>>Pilih Posisi</option>
										  <?php $posi=$this->db->get("position");
										  foreach($posi->result() as $position){?>
										  <option value="<?=$position->position_id;?>" <?=($position_id==$position->position_id)?"selected":"";?>><?=$position->position_name;?></option>
										  <?php }?>
									  </select>
									</div>							  
								</div>
										
										
										<?php }?>
                                      
                                      
									 
									
									
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="user_picture">Picture:</label>
                                        <div class="col-sm-10" align="left"> 
                                          <input type="file"  id="user_picture" name="user_picture"><br/>
                                        <?php if($user_picture!=""){$user_image="assets/images/user_picture/".$user_picture;}else{$user_image="assets/images/user_picture/user.gif";}?>
                                          <img id="user_picture_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                          <script>
                                            function readURL(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();
                                        
                                                    reader.onload = function (e) {
                                                        $('#user_picture_image').attr('src', e.target.result);
                                                    }
                                        
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        
                                            $("#user_picture").change(function () {
                                                readURL(this);
                                            });
                                          </script>
                                        </div>
                                      </div>
									  
                                      
                                      <input type="hidden" name="user_id" value="<?=$user_id;?>"/>					  					  
                                      <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" id="submit" class="btn btn-primary col-md-5" <?=$namabutton;?> value="OK">Submit</button>
                                            <button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?=site_url("user");?>">Back</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                                <?php }else{?>	
                                    <?php if($message!=""){?>
                                    <div class="alert alert-info alert-dismissable">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong><?=$message;?></strong><br/><?=$uploaduser_picture;?>
                                    </div>
									
                                    <?php }?>
									

                                    <div class="box">
                                      <div id="collapse4" class="body table-responsive">
										<?php if(!isset($_GET['id'])){$idtable="dataTable";}else{$idtable="";}	?>			
                                        <table id="<?=$idtable;?>" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                  <th>NIK</th>
                                                    <th>Posisi</th>
                                                    <th>Name</th>
                                                    <th>Photo</th>
													<?php
													if($this->session->userdata("position_id")==1){
													?>
                                                    <th class="col-md-1">&nbsp;</th>
													<?php }?>
                                                    <th class="col-md-1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php 
												if($this->input->get("position_id")>0){
													$this->db->where("user.position_id",$this->input->get("position_id"));
												}
												if($this->input->get("id")>0){
													$this->db->where("user.user_id",$this->input->get("id"));
												}
												if(isset($_GET['register'])){
													$this->db->where("user.user_id",-3);
												}
												if($this->session->userdata("position_id")!=1){
													$this->db->where("user.user_id",$this->session->userdata("user_id"));
												}
												$usr=$this->db
                                                ->join("position","position.position_id=user.position_id","left")
                                                ->get("user");
												//echo $this->db->last_query();
                                                foreach($usr->result() as $user){?>
                                                <tr>
                                                  <td><?=$user->user_nik;?></td>											
                                                    <td><?=$user->user_posisikerja;?></td>
                                                    <td><?=$user->user_lengkap;?></td>
                                                    <td>
													<?php if($user->user_picture==""){$user_picture=base_url("assets/images/global/noimage.jpg");}else{$user_picture=site_url("imagess?path=".base_url("assets/images/user_picture/".$user->user_picture)."&resize=kecil");}?>
													<img src="<?=$user_picture;?>" alt="photo" width="50" height="50" style="cursor:pointer;" onClick="tampilimg(this)"></td>
                                                    
													<?php
													if($this->session->userdata("position_id")==1){
													?>
													<td>
													<?php if($user->position_id==0){?>													
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-success " name="update" value="OK"><span class="fa fa-check" style="color:white;"></span> </button>
                                                            <input type="hidden" name="user_id" value="<?=$user->user_id;?>"/>
                                                            <input type="hidden" name="position_id" value="2"/>
                                                        </form>
													<?php }?>
													</td>
													<?php }?>
                                                    <td style="padding-left:0px; padding-right:0px;">
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="user_id" value="<?=$user->user_id;?>"/>
                                                        </form>
                                                   <?php if($this->session->userdata("position_id")==1){?>		 
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-danger delete" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                            <input type="hidden" name="user_id" value="<?=$user->user_id;?>"/>
                                                        </form>	
													<?php }?>										</td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
										
										<hr/>
										
										<?php if($this->session->userdata("position_id")!="1"){?>
										<table  class="table table-condensed table-hover">
										  <tr>
											<th scope="row" class="col-md-3">Nama</th>
											<td class="col-md-1">:</td>
											<td class="text-left"><?=$user_name;?></td>
										  </tr>
										  <tr>
											<th scope="row">Alamat</th>
											<td>:</td>
											<td class="text-left"><?=$user_address;?></td>
										  </tr>
										  <tr>
											<th scope="row">Tempat, Tanggal Lahir</th>
											<td>:</td>
											<td class="text-left"><?=$user_birthplace;?>, <?=date("d M Y",strtotime($user_birthdate));?></td>
										  </tr>
										  <tr>
										    <th scope="row">Posisi Pekerjaan</th>
										    <td>:</td>
										    <td class="text-left"><?=$user_posisikerja;?></td>
									      </tr>
										  <tr>
										    <th scope="row">Jenis kelamin</th>
										    <td>:</td>
										    <td class="text-left"><?=$user_gender;?></td>
									      </tr>
										  <tr>
										    <th scope="row">Telepon</th>
										    <td>:</td>
										    <td class="text-left"><?=$user_phone;?></td>
									      </tr>
										  <tr>
										    <th scope="row">Email</th>
										    <td>:</td>
										    <td class="text-left"><?=$user_email;?></td>
									      </tr>
										</table>

										<?php }?>
                                      </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
	<!-- /#wrap -->
	<?php require_once("footer.php");?>
</body>

</html>
