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
				<li><a href="#">UPT/UP</a></li>
			</ul>

			<div class="row-fluid">
				
				<div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Unit Pelaksana Teknis</h2>
						<div class="box-icon">
							<a href="tmbhuptup.php" title="Tambah UPT UP" class="btn-small"><i class="halflings-icon plus white"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>UPT/UP</th>
									  <th>IP Address</th>
									  <th>Status</th>
									  <th>Actions</th>                                          
								  </tr>
							  </thead>   
							  <tbody>

							  	<?php
							$q = mysqli_query ($con, "SELECT * FROM t_uptup") or die (mysql_error());
							while ($h = mysqli_fetch_array($q)) {
							$uptip = $h['ip_uptup'];
							$upth = $h['h_uptup'];
							$idup = $h['id_uptup'];

							if ($h['status'] == 1) {
									echo "<tr><td>$upth</td><td class='center'>$uptip</td><td class='center'><span class='label label-success'>ON</span></td><td class='center'>";
									
								}
								else {

									echo "<tr><td>$upth</td><td class='center'>$uptip</td><td class='center'><span class='label label-important'>OFF</span></td><td class='center'>";

								}			
								?>
									<a class='btn btn-default' href='edituptup.php?&id=<?php echo $idup; ?>&name=<?php echo $upth; ?>&address=<?php echo $uptip; ?>' id="<?php echo $idup ?>" target='blank' name='btn-edit'><i class='halflings-icon pencil' title='Edit UPT UP'></i></a>

									<a class='btn btn-danger delete'  href="#" id="<?php echo $idup; ?>"><i class="halflings-icon trash" title="Hapus Service"></i></a>
								</td></tr>
			
					<?php				
						}
					?>
								                        
							  </tbody>
						 </table>  
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

<script>
		    function autoRefresh()
		    {
		        window.location = 'uptup.php';
		    }
		     setInterval('autoRefresh()', 10000);
</script>
	
<?php
include "footer.php";
?>

<script type="text/javascript">
			$(function() {
			$(".delete").click(function(){
			var element = $(this);
			var del_id = element.attr("id");
			var info = 'id=' + del_id;
			if(confirm("Apakah Anda Yakin Ingin Mengapus Data ini ?")){
			 $.ajax({
			   type: "POST",
			   url: "hapusuptup.php",
			   data: info,
			   success: function(){
			   	 window.location = 'uptup.php';
			 }
			});
			  $(this).parents(".show").animate({ backgroundColor: "#003" }, "slow")
			  .animate({ opacity: "hide" }, "slow");
			 }
			return false;
			});
			});
</script>

</body>
</html>

<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini, login terlebih dahulu'); window.location = 'index.php'</script>";
}
?>
