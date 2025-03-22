<!DOCTYPE html>
<html>
<head>
<?php require_once("meta.php");?>
<style>
.bigger{font-size:14px !important;}
.infobox-yellow .infobox-icon .ace-icon{ background-color:orange;}
</style>
</head>

<body class="no-skin">
<?php require_once("header.php");?>
	


    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Dashboard</li>
                </ul>               
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Dashboard
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-md-12" style="font-size:36px; font-weight:bold; margin-top:50px;">
						<div class="col-md-12" align="center" style="margin-bottom:30px;">
						<img src="<?=base_url("assets/images/identity_picture/".$identity->identity_picture);?>" style="height:90px; width:auto;">
						</div>
						<div class="col-md-12" align="center">
						Selamat Datang<br/>
						di <?=$identity->identity_name;?>
						</div>
                        <div class="hr hr32 hr-dotted"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script>
	function detail_member(a,b){
		$.get("<?=site_url("api/detail_member");?>",{user_id:a,pendataan:b})
		.done(function(data){
		$(".modal-header").html("<h3>Detail User</h3>");
		$(".modal-body").html(data);
		$("#myModal").modal();
		});
	}
	</script>

  

<?php require_once("footer.php");?>	
</body>

</html>
