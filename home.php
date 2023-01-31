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
$comm = $serv['community'];
$hostname = $serv['hostname'];
$servst = $serv['n_status'];

$sqlhrdw = mysqli_query($con, "SELECT * FROM t_hardware WHERE ip_server='$ip' ORDER BY no DESC LIMIT 1") or die(mysql_error());
$hrdw = mysqli_fetch_array($sqlhrdw);
$cpu_perc = $hrdw['cpu_perc'];
$ram_tot = $hrdw['ram_tot'];
$ram_tot_mb = $ram_tot/1024;
$ram_avail = $hrdw['ram_avail'];
$ram_used = $hrdw['ram_used'];
$ram_used_mb = $ram_used/1024;
$ram_perc = $hrdw['ram_perc'];
$disk_tot = $hrdw['disk_tot'];
$disk_tot_mb = $disk_tot/1024;
$disk_avail = $hrdw['disk_avail'];
$disk_used = $hrdw['disk_used'];
$disk_used_mb = $disk_used/1024;
$disk_perc = $hrdw['disk_perc'];
$uptime = $hrdw['uptime'];


?>

<?php
   $data_penjualan = mysqli_query($con, "SELECT cpu_perc, ram_perc, disk_perc, TIME(date) waktu FROM t_hardware ORDER BY no DESC LIMIT 10");
   // $data_penjualan = mysqli_query($connect, "SELECT tanggal, SUM(total) AS total FROM penjualan GROUP BY tanggal");
    $data_tanggal = array();
    $data_cpu = array();
    $data_ram = array();
    $data_disk = array();

    while ($data = mysqli_fetch_array($data_penjualan)) {
      $data_tanggal[] = date('H:i:s A', strtotime($data['waktu'])); // Memasukan tanggal ke dalam array
      $data_cpu[] = $data['cpu_perc']; // Memasukan total ke dalam array
      $data_ram[] = $data['ram_perc']; // Memasukan total ke dalam array
      $data_disk[] = $data['disk_perc']; // Memasukan total ke dalam array
    }
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
				<li><a href="#">Dashboard</a></li>
			</ul>

			<div class="row-fluid">

				<div class="row-fluid sortable">	
				<div class="box span4">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Server Description</h2>
						<div class="box-icon">
							<a href="serverset.php" title="Edit Server" class="btn-small"><i class="halflings-icon cog white"></i></a>
						</div>
					</div>
					<div class="box-content">
						<dl>
						  <dt>Hostname</dt>
						 <?php echo "<dd>$hostname</dd>" ?> 
						  <dt>IP Address</dt>
						 <?php echo "<dd>$ip</dd>" ?>
						  <dt>System Uptime</dt>
						  <?php echo "<dd>$uptime</dd>" ?>
						  <dt>Media</dt>
						  <?php echo "<dd>RAM: ".round($ram_tot_mb); echo " MB </dd>" ?>
						  <?php echo "<dd>Disk: ".round($disk_tot_mb); echo " MB </dd>" ?>
						  <dt>Rocomunity SNMP</dt>
						  <?php echo "<dd>$comm</dd>" ?>
						  <dt> Status </dt>
						  <?php
						  if ($servst == 1) { echo "<span class='label label-success'>ON</span>"; }
						  else { echo "<span class='label label-important'>OFF</span>";}
						  ?>
						  </dl>            
					</div>
				</div><!--/span-->
				
				<div class="box span8">
					<div class="box-header">
						<h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Table Service</h2>
						<div class="box-icon">
							<a href="tmbhsrvc.php" title="Tambah Service" class="btn-small"><i class="halflings-icon plus white"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>Service Name</th>
									  <th>Port</th>
									  <th>Status</th>
									  <th>Actions</th>                                           
								  </tr>
							  </thead>   
							  <tbody>
								<?php
								$q = mysqli_query ($con, "SELECT * FROM t_service") or die (mysql_error());
								while ($h = mysqli_fetch_array($q)) {
								$srvn = $h['service_name'];
								$srvp = $h['port'];
								$srvid = $h['id_service'];

							if ($servst == 1) {

								if ($h['status'] == 1) {
									echo "<tr><input type='hidden' name='id' value='$srvid'><input type='hidden' name='name' value='$srvn'><td>$srvn</td><td class='center'>$srvp</td><td class='center'><span class='label label-success'>ON</span></td><td class='center'>";
									
								}
								else {

									echo "<tr><input type='hidden' name='id' value='$srvid'><input type='hidden' name='name' value='$srvn'><td>$srvn</td><td class='center'>$srvp</td><td class='center'><span class='label label-important'>OFF</span></td><td class='center'>";

								}

								}

							else {

									echo "<tr><input type='hidden' name='id' value='$srvid'><input type='hidden' name='name' value='$srvn'><td>$srvn</td><td class='center'>$srvp</td><td class='center'><span class='label label-important'>OFF</span></td><td class='center'>";
						}
			
								?>
									<a class='btn btn-default' href='editsrvc.php?&id=<?php echo $srvid; ?>&name=<?php echo $srvn; ?>&port=<?php echo $srvp; ?>' id="<?php echo $srvp ?>" target='blank' name='btn-edit'><i class='halflings-icon pencil' title='Edit Service'></i></a>

									<a class='btn btn-danger delete'  href="#" id="<?php echo $srvid; ?>"><i class="halflings-icon trash" title="Hapus Service"></i></a>
								</td></tr>
			
					<?php				
						}
					?>

                
							  </tbody>
						 </table>						     
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header">
						<h2><i class="halflings-icon white list-alt"></i><span class="break"></span>Persentase Penggunaan CPU</h2>
					</div>
					<div class="box-content">
						<div class="chart" class="center">	
				          <canvas id="line-cpu"></canvas>
				        </div> 
					</div>
				</div>
		
				<div class="box span4">
					<div class="box-header">
						<h2><i class="halflings-icon white list-alt"></i><span class="break"></span>Persentase Penggunaan RAM</h2>
					</div>
					<div class="box-containt">
							<div class="chart">	
					        <canvas id="line-ram"></canvas>
					</div>
					</div>
				</div>
			
				<div class="box span4">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white list-alt"></i><span class="break"></span>Persentase Penggunaan Disk</h2>
					</div>
					<div class="box-containt">
							<div class="chart">	
					          <canvas id="line-disk"></canvas>
					</div>
					</div>
				</div>
			
			</div><!--/row-->									
		

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

<script>
		    function autoRefresh()
		    {
		        window.location = 'home.php';
		    }
		     setInterval('autoRefresh()', 10000);
</script>

<script type="text/javascript">
	$(document).ready(function(){
		var linechart = document.getElementById('line-cpu');
        var chart = new Chart(linechart, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
            datasets: [{
              label: 'Persentase Penggunaan CPU',
              data: <?php echo json_encode($data_cpu) ?>,
              borderColor: 'rgba(255,99,132,1)',
              backgroundColor: 'transparent',
              borderWidth: 2
            }]
          }
        });

         var linechart = document.getElementById('line-ram');
        var chart = new Chart(linechart, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
            datasets: [{
              label: 'Persentase Penggunaan RAM',
              data: <?php echo json_encode($data_ram) ?>,
              borderColor: 'rgba(255,99,132,1)',
              backgroundColor: 'transparent',
              borderWidth: 2
            }]
          }
        });

        var linechart = document.getElementById('line-disk');
        var chart = new Chart(linechart, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($data_tanggal) ?>, // Merubah data tanggal menjadi format JSON
            datasets: [{
              label: 'Persentase Penggunaan Disk',
              data: <?php echo json_encode($data_disk) ?>,
              borderColor: 'rgba(255,99,132,1)',
              backgroundColor: 'transparent',
              borderWidth: 2
            }]
          }
        });

        $(".delete").click(function(){
			var element = $(this);
			var del_id = element.attr("id");
			var info = 'id=' + del_id;
			if(confirm("Apakah Anda Yakin Ingin Mengapus Data ini ?")){
				$.ajax({
					type: "POST",
					url: "hapus.php",
					data: info,
					success: function(){
						window.location = 'home.php';
					}
				});
				$(this).parents(".show").animate({ backgroundColor: "#003" }, "slow")
				.animate({ opacity: "hide" }, "slow");
			}
			return false;
		});
	})
</script>
</body>
</html>

<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini, login terlebih dahulu'); window.location = 'index.php'</script>";
}
?>
