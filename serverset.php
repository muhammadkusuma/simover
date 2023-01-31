<?php
// memanggil berkas koneksi.php
session_start();// Memulai Session
$a = isset($_SESSION['kode']);

if ($a != NULL)

{
?>

<?php

include('config/koneksi.php');

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
	$ipserver = $_POST['ipserver'];
	$hserver = $_POST['hserver'];
	$rsnmp = $_POST['rsnmp'];

	if(!empty($ipserver) && !empty($hserver) && !empty($rsnmp)){
		
		$sql = mysqli_query($con, "UPDATE t_server SET ip_server='$ipserver', hostname='$hserver', community='$rsnmp', n_status='0'") or die (mysql_error());
		$sqlsrv = mysqli_query($con, "UPDATE t_service SET ip_server='$ipserver'") or die (mysql_error());
		$hitung = mysqli_query($con, "SELECT * FROM t_server where ip_server='$ipserver'");
		$count = mysqli_num_rows($hitung);
		if ($count > 0) {
		echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i>Server BERHASIL Dikonfigurasi Ulang</strong> <br/></div>";
			
			?>

			<title> Refresh Halaman setelah 1 detik </title>
		    <script>
		    function autoRefresh()
		    {
		        window.location = 'home.php';
		    }
		     setInterval('autoRefresh()', 1000);
		    </script>

			<?php
			


			} else {


				echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>Gagal Mengkonfigurasi Ulang Server<br/></div>";

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
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Form Setting Server</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="" method="POST">
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">IP Server</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="ipserver" name="ipserver" type="text" maxlength="15">
								</div>
							  </div>
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Hostname Server</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="hserver" name="hserver" type="text" maxlength="30">
								</div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Rocommunity SNMP</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="rsnmp" name="rsnmp" type="text" maxlength="60">
								</div>
							  </div>
							  
							   <div class="form-actions">
								<button type="submit" name="change" class="btn btn-primary" >Konfigurasi Ulang Server</button>
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
