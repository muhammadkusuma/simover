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
//cek UPTUP
//membuat query membaca record dari tabel    
 $qupt="SELECT * FROM t_uptup";   

 //menjalankan query   
 if (mysql_query($qupt)) {   
 $result=mysql_query($qupt);  
 } else die ("Error menjalankan query". mysql_error());   

 //mengecek record kosong  
 if (mysql_num_rows($result) > 0)  
 {  
      //menampilkan hasil query   
      while($iupt = mysql_fetch_array($result)) {    
           				$id_uptup = $iupt['id_uptup'];
				        $ipupt = $iupt['ip_uptup'];
				        $hostupt = $iupt['h_uptup'];
				        $statusupt = $iupt['status'];
				        //cek port open -c untuk jumlah
				       	$pingupt = shell_exec("ping -c 3 $ipupt");
						//memecah hasil ping
						$pinghsl = explode(",",$pingupt);
						//check hasil ping
						if (preg_match("/3 received/", $pinghsl[1]))
						{
				            $portuptst = 1;
				            if($statusupt != $portuptst)
				            {
				            $psnup = "UPTUP $hostupt ON Kembali Pada $date";
				            //kirim pemberitahuan
							file_get_contents("https://api.telegram.org/bot599107091:AAFtC9C50P_Y3xfMYCQ9oubwNmIQ0uSCuCY/sendMessage?chat_id=$idtele&text=$psnup");
							// return $url;
							echo 'Notif service UPT/UP Terkirim';
				            // Update Table notif
				            $upduptnotif = mysql_query("INSERT INTO t_notif VALUES ('','UPTUP $hostupt ON','$psnup','0','0','$date')");
				            }

				        }
				        else
				        {
				            $portuptst = 0;				            
				            if ($statusupt != $portuptst)
				            {
				           	//pesan
				            $psndwn = "WARNING! UPTUP $hostupt OFF Pada $date";
				            //kirim pemberitahuan
							file_get_contents("https://api.telegram.org/bot599107091:AAFtC9C50P_Y3xfMYCQ9oubwNmIQ0uSCuCY/sendMessage?chat_id=$idtele&text=$psndwn");
							// return $url;
							echo 'Notif service Down Terkirim';
				            // Update Table notif
				            $updsrnotif = mysql_query("INSERT INTO t_notif VALUES ('','Service $hostupt OFF','$psndwn','1','0','$date')");
				        	}
				        }

				        $portuptbr = mysql_query("UPDATE t_uptup SET status = '$portuptst' WHERE ip_uptup = '$ipupt'");
				    }
				}


 //menutup koneksi mysql  
 mysql_close($conn);  

?>