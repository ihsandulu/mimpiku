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
                    <li class="active">Customer</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Customer
                    </h1>
					<?php if((!isset($_POST['new'])&&!isset($_POST['edit'])&&$this->session->userdata("position_id")==1&&!isset($_GET['id']))||isset($_GET['register'])){?>
                    
                    <form method="post" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button name="new" class="btn btn-info btn-block btn-sm" value="OK" style="">
						<?=(isset($_GET['register']))?"Daftar Baru":"New";?>
						</button>
                        <input type="hidden" name="customer_id"/>
                       
                    </form>
                  
                    <?php }
					
					if(isset($_POST['new'])||isset($_POST['edit'])){?>
					<form action="<?=site_url("customer");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
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
                                    <?php if(isset($_POST['edit'])){$namabutton='name="change"';$judul="Update Customer";}else{$namabutton='name="create"';$judul="New Customer";}?>	
                                    <div class="lead"><h3><?=$judul;?></h3></div>
                                    <form method="post">
										<label class="label label-danger col-md-12" style="padding:15px;"><?=$message;?></label>
										<div class="form-group">
											<label for="customer_email"><span class="red">*</span> Email:</label>
											<input class="form-control inputstandard" type="email" id="customer_email" name="customer_email" placeholder="Email" required="required" value="<?=$customer_email;?>" />
										</div>
										<div class="form-group">
											<label for="customer_password"><span class="red">*</span> Password:</label>
											<input class="form-control inputstandard" type="text" id="customer_password" name="customer_password" placeholder="Password" required="required" value="" />
										</div>
										<div class="form-group">
											<label for="customer_name"><span class="red">*</span> Name:</label>
											<input class="form-control inputstandard" type="text" id="customer_name" name="customer_name" placeholder="Nama Lengkap" required="required" value="<?=$customer_name;?>" />
										</div>
										<div class="form-group">
											<label for="customer_country"><span class="red">*</span> Country:</label>
											<input class="form-control inputstandard" type="text" id="customer_country" name="customer_country" placeholder="Negara" required="required" value="<?=$customer_country;?>" />
										</div>
										<div class="form-group">
											<label for="customer_wa"><span class="red">*</span> Whatsapp:</label>
											<input class="form-control inputstandard" type="text" id="customer_wa" name="customer_wa" placeholder="Whatsapp" required="required" value="<?=$customer_wa;?>" />
										</div>
										<div class="form-group">
											<label for="customer_fb">Facebook:</label>
											<input class="form-control inputstandard" type="text" id="customer_fb" name="customer_fb" placeholder="Nama Pengguna Facebook" value="<?=$customer_fb;?>" />
										</div>
                                      <input type="hidden" name="customer_id" value="<?=$customer_id;?>"/>					  					  
                                      <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" id="submit" class="btn btn-primary col-md-5" <?=$namabutton;?> value="OK">Submit</button>
                                            <button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?=site_url("customer");?>">Back</button>
                                        </div>
                                      </div>
									</form>	
                                </div>
                                <?php }else{?>	
                                    <?php if($message!=""){?>
                                    <div class="alert alert-info alert-dismissable">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong><?=$message;?></strong><br/><?=$uploadcustomer_picture;?>
                                    </div>
									
                                    <?php }?>
									

                                    <div class="box">
                                      <div id="collapse4" class="body table-responsive">
										<?php if(!isset($_GET['id'])){$idtable="dataTable";}else{$idtable="";}	?>			
                                        <table id="<?=$idtable;?>" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                  <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>WA</th>
                                                    <th>FB</th>
                                                    <th>Country</th>
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
												if($this->input->get("id")>0){
													$this->db->where("customer.customer_id",$this->input->get("id"));
												}
												if(isset($_GET['register'])){
													$this->db->where("customer.customer_id",-3);
												}
												if($this->session->userdata("position_id")!=1){
													$this->db->where("customer.customer_id",$this->session->userdata("customer_id"));
												}
												$usr=$this->db
                                                ->get("customer");
												//echo $this->db->last_query();
                                                foreach($usr->result() as $customer){?>
                                                <tr>
                                                  <td><?=$customer->customer_name;?></td>											
                                                    <td><?=$customer->customer_email;?></td>
                                                    <td><?=my_decrypt($customer->customer_password, $key);?></td>									
                                                    <td><?=$customer->customer_wa;?></td>									
                                                    <td><a target="_blank" href="https://www.facebook.com/<?=$customer->customer_fb;?>/"><?=$customer->customer_fb;?></td>								
                                                    <td><?=$customer->customer_country;?></td>							
                                                    <td style="padding-left:0px; padding-right:0px; text-align:center;">
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-warning btn-block" name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="customer_id" value="<?=$customer->customer_id;?>"/>
                                                        </form>
                                                   		<?php if($this->session->userdata("position_id")==1){?>		 
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-danger btn-block delete" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                            <input type="hidden" name="customer_id" value="<?=$customer->customer_id;?>"/>
                                                        </form>	
														<?php }?>										
													</td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
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
