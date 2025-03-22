<!DOCTYPE html>
<html>
<head>
<?php require_once("meta.php");?>
 

  
      <style>
      

html { width: 100%; height:100%; overflow:hidden; }

body { 
	width: 100%;
	height:100%;
	font-family: 'Open Sans', sans-serif;
	//background: linear-gradient(to bottom right, #757575, #B0B0B0);
	background-image:url(<?=base_url("assets/images/global/background.jpg");?>);
}
.login { 
	position: absolute;
	top: 50%;
	left: 50%;
	transform:translate(-50%,-50%)
}

input { 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }
.relative-center{position:relative; top:50%; left:50%; transform:translate(-50%,-50%);}
.judul{margin-bottom:50px !important; color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; font-size:28px; height:50px;}
.register{text-decoration:none; color:#FFFFFF; font-size:16px; cursor:pointer; border:white dashed 1px; padding:5px;}
.register:hover{color:yellow; text-decoration:none;}
@media screen and (max-width: 880px) {
   .judul-picture{text-align:center;}
   .judul-name{text-align:center;}
   .form-login{margin-top:70px !important;}
   .judul{margin-bottom:110px !important;}
}
</style>


</head>

<body>
  <div class="login col-md-4 col-sm-8 col-xs-12 " align="center">
    <div class="judul ">
        <div class="col-md-12 judul-picture" align="center">
        <img src="<?=base_url("assets/images/identity_picture/".$identity->identity_picture);?>" style="height:90px; width:auto;">
        </div>
        
    </div>
	<div class="form-login" style="padding-left:30px; padding-right:30px; margin-top:30px;" align="left">
    <form method="post">
    	<label class="label label-danger col-md-12" style="padding:2.5px;"><?=$hasil;?></label>
    	<input type="text" name="name" placeholder="Username" required="required" />
        <input type="password" name="user_password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
    </form>	
	<br/>	
    <a href="<?=site_url("user?register=ok");?>" type="submit" class="register">Daftar Disini</a>
	</div>
</div>
  
    <script  src="js/index.js"></script>

</body>

</html>
