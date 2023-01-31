<?php
// memanggil berkas koneksi.php
session_start();// Memulai Session
$a = isset($_SESSION['kode']);

if ($a != NULL)

{
?>

<?php

include('config/koneksi.php');
$sqlserv = mysqli_query($con, "SELECT * FROM t_server") or die(mysql_error());
$serv = mysqli_fetch_array($sqlserv); 
$ip = $serv['ip_server'];

	$srvid = $_GET['id'];
	$srvport = $_GET['port'];
	$srvnm = $_GET['name'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include "head.php";?>
<body>
<?php include "header.php";?>
						
<div class="container-fluid-full">
<div class="row-fluid">
	
<?php include "mainmenu.php";?>		
			
			<!-- start: Content -->
			<div id="content" class="span10">
						
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="home.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="settings.php">Settings</a></li>
			</ul>

			<div class="row-fluid">
				
<?php
 if($_POST){
	
	$srvcnm = $_POST['sname'];
	$srvcport = $_POST['psrvc'];

		if(!empty($srvcnm) && !empty($srvcport)){
		$sql = mysqli_query($con, "UPDATE t_service SET service_name='$srvcnm', port='$srvcport' WHERE id_service='$srvid'") or die (mysql_error());
		if ($sql) {
		echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i>Service $srvnm port $srvport berhasil dirubah menjadi $srvcnm port $srvcport</strong>
			<br/></div>";

			?>

			<title> Refresh Halaman setelah 5 detik </title>
		    <script>
		    function autoRefresh()
		    {
		        window.location = 'home.php';
		    }
		     setInterval('autoRefresh()', 2000);
		    </script>

			<?php
			
			} else {


				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Service Gagal diedit<br/></div>";

			}
	}

	else {

		echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i>Mohon isi seluruh kolom Konfigurasi</strong><br/></div>";
	}
}	
?>
	
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Form edit Service</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="" method="POST">
							<fieldset>
								<div class="control-group">
								<label class="control-label">Service Name</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><?php echo $srvnm; ?></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Port</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><?php echo $srvport; ?></span>
								</div>
							  </div>
							    <div class="control-group">
								<label class="control-label" for="focusedInput">New Service Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="sname" name="sname" type="text" maxlength="30">
								</div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">New Port</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="psrvc" name="psrvc" type="number" name="quantity" min="1" max="65535" >
								</div>
							  </div>
							     <div class="form-actions">
								<button type="submit" name="change" class="btn btn-primary" >Change Service</button>
								<button type="reset" class="btn">Reset</button>
							  </div>
							</fieldset>
						  </form>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
												
								
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-content">
			<ul class="list-inline item-details">
				<li><a href="http://themifycloud.com">Admin templates</a></li>
				<li><a href="http://themescloud.org">Bootstrap themes</a></li>
			</ul>
		</div>
	</div>
	
	<div class="clearfix"></div>
<?php
include "footer.php";
?>
</body>
</html>

<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini, login terlebih dahulu'); window.location = 'index.php'</script>";
}
?>