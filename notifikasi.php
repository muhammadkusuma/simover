<?php
// memanggil berkas koneksi.php
session_start();// Memulai Session
$a = isset($_SESSION['kode']);

if ($a != NULL)

{
?>

<?php

include('config/koneksi.php');

$sqlserv = mysqli_query($con, "SELECT * FROM t_telegram") or die(mysql_error());
$tele = mysqli_fetch_array($sqlserv); 
$idtele = $tele['tele_id'];
$ntele = $tele['tele_name'];

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
				<li><a href="notifikasi.php">Notifikasi</a></li>
			</ul>

			<div class="row-fluid">
				
				<?php
				if($_POST){
					$idtelenw = $_POST['idt'];
					$ntelenw = $_POST['nt'];

					if(!empty($idtelenw) && !empty($ntelenw)){
						$sql = mysqli_query($con, "UPDATE t_telegram SET tele_id='$idtelenw', tele_name='$ntelenw'") or die (mysql_error());
						$hitung = mysqli_query($con, "SELECT * FROM t_telegram where tele_id='$idtelenw'");
						$count = mysqli_num_rows($hitung);
						if ($count > 0) {
						echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-check'></i>ID telegram berhasil diubah ke $idtelenw atas nama $ntelenw</strong> <br/></div>";
							
							} else {


								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>ID Telegram gagal diubah<br/></div>";

							}
					}

					else {

						echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i>Mohon isi seluruh kolom Konfigurasi</strong><br/></div>";
					}
					

				}
				?>

				<div class="row-fluid">	
				<div class="box span12">
					
					<div class="box-header">
						<h2><i class="halflings-icon white white bullhorn"></i><span class="break"></span>Notifikasi</h2>
						<div class="box-icon">
							<a href="laporan/lap_notifikasi.php" title="Cetak Laporan" class="btn-small"><i class="halflings-icon print white"></i></a>
							<a href="#" class="btn-setting" title="Konfigurasi akun telegram"><i class="halflings-icon white wrench"></i></a>
						</div>
					</div>
					<div class="box-content alerts">
						
						
						<?php
						$q = mysqli_query ($con, "SELECT * FROM t_notif ORDER BY comment_id DESC") or die (mysql_error());
						while ($h = mysqli_fetch_array($q)) {
							$sub = $h['comment_subject'];
							$isi = $h['comment_text'];

							if ($h['warning'] == 0) {
								echo "<div class='alert alert-info'><strong>$sub</strong> $isi </div>";
							}
							else {

								echo "<div class='alert alert-error'><strong>$sub</strong> $isi </div>";
							}	

						}
						?>

						</div>
					
				</div><!--/span-->
			</div><!--/row-->
				
		</div>		
									
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
					<form class="form-horizontal" action="" method="POST">
							<fieldset>
								<div class="control-group">
								<label class="control-label">ID Telegram</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><?php echo $idtele ?></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Acount Name</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><?php echo $ntele ?></span>
								</div>
							  </div>
							    <div class="control-group">
								<label class="control-label" for="focusedInput">New ID Telegram</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="idt" name="idt" type="text" maxlength="30">
								</div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">New Acount Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="nt" name="nt" type="text" maxlength="60">
								</div>
							  </div>
							     <div class="form-actions">
								<button type="submit" name="change" class="btn btn-primary" >Change Telegram ID</button>
								<button type="reset" class="btn">Reset</button>
							  </div>
							</fieldset>
						</form>
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
