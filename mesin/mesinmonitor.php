 <?php  
 $dbHost = "localhost";  
 $dbUser = "root";  
 $dbPass = "qwerty";  
 $dbName = 'db_simover';  

 // membuat koneksi mysql  
 $conn = mysql_connect($dbHost, $dbUser, $dbPass, $dbName);  

 // Mengecek koneksi mysql  
 if (!$conn) die("Koneksi Gagal: " . mysql_error());  
 else echo "Koneksi MySQL Berhasil ...<br/>";   

 //membuat koneksi database   
 $dbSelected = mysql_select_db($dbName, $conn);    

 // Mengecek koneksi database  
 if (!$dbSelected) die ('Koneksi Gatabase Gagal: ' . mysql_error());  
 else echo "Koneksi Database ".$dbName." Berhasil ...<br/>";    

//time
date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d h:i:sa");

//ambil data telegram
$sqltele = mysql_query("SELECT * FROM t_telegram");
$sqltl = mysql_fetch_array($sqltele);
$idtele = $sqltl['tele_id'];
echo "id dari telegram adalah $idtele";

// ambil data server
$sqlserv = mysql_query("SELECT * FROM t_server");
while ($serv = mysql_fetch_array($sqlserv)) {
				$ip = $serv['ip_server'];
				$comm = $serv['community'];
				$hostname = $serv['hostname'];
				$servst = $serv['n_status'];
}

//ping
$result = shell_exec("ping -c 3 $ip");
		//memecah hasil ping
$ping = explode(",",$result);
		//check hasil ping
	if (preg_match("/3 received/", $ping[1])) {
	//available
	//snmp get value
	snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
	//penggunaan CPU
	//$cpu1mnt = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.10.1.3.1'); //penggunaan CPU 1 menit terakhir
	$cpu1 = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.11.10.0'); //persentase penggunaan system cpu
	
	$cpuPerc = floatval($cpu1); 	//ubah nilai string ke float dan kali 100
	//ram
	$ramAvail = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.4.6.0');
	$ramTot = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.4.5.0');
	//calculate RAM Used
	$ramUsed = $ramTot - $ramAvail;
	//$ramBuffers = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.4.14.0');
	//$ramCached = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.4.15.0');
	//calculate % RAM used
	$ramPerc = $ramUsed/$ramTot *100;
	//disk
	$diskAvail = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.9.1.7.1');
	$diskUse = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.9.1.8.1');
	$diskTot = snmp2_get($ip, $comm,'.1.3.6.1.4.1.2021.9.1.6.1');
	//calculate % Disk
	$diskPerc = ($diskUse/$diskTot * 100);
	//network packet interface eth
	// $ifup1 = snmp2_get($ip, $comm,'.1.3.6.1.2.1.31.1.1.1.6.1'); //up lo
	// $ifup2 = snmp2_get($ip, $comm,'.1.3.6.1.2.1.31.1.1.1.6.2'); //up eth0
	// $ifup3 = snmp2_get($ip, $comm,'.1.3.6.1.2.1.31.1.1.1.6.3'); //up eth1
	// $ifup3 = snmp2_get($ip, $comm,'.1.3.6.1.2.1.31.1.1.1.6.4'); //up eth2
	// $ifup = ($ifup1+$ifup2+$ifup3+$ifup3); //total upload dari lo, eth0, eth1
	// echo "total up = $ifup1 tambah $ifup2 tambah $ifup3 = $ifup";

	// $ifdo = snmp2_get($ip, $comm,'.1.3.6.1.2.1.31.1.1.1.10.2'); //dwn eth0

	//uptime
	$tmckuptime = snmp2_get($ip, $comm,'.1.3.6.1.2.1.1.3.0');
	// Convert Ticks to secondes
	if($tmckuptime<=0){
		$ConvertSeconds = "0 Days - 0 Hours - 0 Mins - 0 Secs";
	} else{
		$lntSecs = intval($tmckuptime / 100);
		$intDays = intval($lntSecs / 86400);
		$intHours = intval(($lntSecs - ($intDays * 86400)) / 3600);
		$intMinutes = intval(($lntSecs - ($intDays * 86400) - ($intHours * 3600)) / 60);
		$intSeconds = intval(($lntSecs - ($intDays * 86400) - ($intHours * 3600) - ($intMinutes * 60)));
		$uptime = "$intDays Days - $intHours Hours - $intMinutes Mins - $intSeconds Secs";
	}
	echo $uptime;


	//insert into t_hardware
	$monitor	= mysql_query("INSERT INTO t_hardware VALUES ('','$ip','$cpuPerc','$ramTot','$ramAvail','$ramUsed','$ramPerc','$diskTot','$diskAvail','$diskUse','$diskPerc','$uptime','$date')");


		if ($monitor) {
		echo "BERHASIL Data monitoring Berhasil di simpan";
		} 
		else {
		echo "MAAF!" .mysql_error()."Gagal";

		}
		echo "server status $servst";

	//notif server
		$stsntf = 1;
			if($servst != $stsntf)
			{
				     		$psnup = "$hostname ON Kembali Pada $date";
				     		//kirim pemberitahuan
							file_get_contents("https://api.telegram.org/bot599107091:AAFtC9C50P_Y3xfMYCQ9oubwNmIQ0uSCuCY/sendMessage?chat_id=$idtele&text=$psnup");
							// return $url;
							echo 'Notif UP Terkirim';
				            // Update Table notif
				            $updtnotif = mysql_query("INSERT INTO t_notif VALUES ('','Server ON','$psnup','0','0','$date')");
				        	//update n_status
				        	$qntif = mysql_query("UPDATE t_server SET n_status='$stsntf' WHERE ip_server = '$ip'");
				        }

//cek service
//membuat query membaca record dari tabel User   
 $query="SELECT * FROM t_service WHERE ip_server = '$ip'";   

 //menjalankan query   
 if (mysql_query($query)) {   
 $result=mysql_query($query);  
 } else die ("Error menjalankan query". mysql_error());   

 //mengecek record kosong  
 if (mysql_num_rows($result) > 0)  
 {  
      //menampilkan hasil query   
      while($ports = mysql_fetch_array($result)) {    
           				$id_service = $ports['id_service'];
				        $service_name = $ports['service_name'];
				        $port = $ports['port'];
				        $statusport = $ports['status'];
				        //cek port open
				        $cekopen = @fsockopen($ip, $port);
				        //if not open
				        if (is_resource($cekopen))
				        {
				            $portst = 1;

				            if($statusport != $portst)
				            {
				            $psnsrup = "Service $service_name ON Kembali Pada $date";
				            //kirim pemberitahuan
							file_get_contents("https://api.telegram.org/bot599107091:AAFtC9C50P_Y3xfMYCQ9oubwNmIQ0uSCuCY/sendMessage?chat_id=$idtele&text=$psnsrup");
							// return $url;
							echo 'Notif service UP Terkirim';
				            // Update Table notif
				            $updsrnotif = mysql_query("INSERT INTO t_notif VALUES ('','Service $service_name ON','$psnsrup','0','0','$date')");
				            }

				            fclose($cekopen);
				        }
				        else
				        {
				            $portst = 0;				            
				            if ($statusport != $portst)
				            {
				            $psnsrdwn = "WARNING! Service $service_name OFF Pada $date";
				            //kirim pemberitahuan
							file_get_contents("https://api.telegram.org/bot599107091:AAFtC9C50P_Y3xfMYCQ9oubwNmIQ0uSCuCY/sendMessage?chat_id=$idtele&text=$psnsrdwn");
							// return $url;
							echo 'Notif service Down Terkirim';
				            // Update Table notif
				            $updsrnotif = mysql_query("INSERT INTO t_notif VALUES ('','Service $service_name OFF','$psnsrdwn','1','0','$date')");
				        	}
				        }

				        $portsv = mysql_query("UPDATE t_service SET status = '$portst' WHERE port = '$port'");
						      }   
						}  
						 else
						 {
						 	echo "Tidak ada Service yang tersedia untuk dimonitoring";  
						 }
}  			 
else {
			$stsntf = 0;
			if($servst != $stsntf)
			{
				     		$psndwn = "WARNING! $hostname OFF Pada $date";
				     		//kirim pemberitahuan
							file_get_contents("https://api.telegram.org/bot599107091:AAFtC9C50P_Y3xfMYCQ9oubwNmIQ0uSCuCY/sendMessage?chat_id=$idtele&text=$psndwn");
							// return $url;
							echo 'Notif Down Terkirim';
				            // Update Table notif
				            $updtnotif = mysql_query("INSERT INTO t_notif VALUES ('','Server OFF','$psndwn','1','0','$date')");
				        	//update n_status
				        	$qntif = mysql_query("UPDATE t_server SET n_status='$stsntf' WHERE ip_server = '$ip'");
				        }
			else {

				echo "server down tanpa notif";
					}
				        
	}
			
 //menutup koneksi mysql  
 mysql_close($conn);  

?>