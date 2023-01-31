  
<?php
error_reporting(0);
include "koneksi.php";
function anti_injection($data){
$filter=mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
return $filter;
}
$user = $_POST['username'];
$pass = $_POST['passlogin'];

if (!ctype_alnum($user) OR !ctype_alnum($pass)){
echo "<div id='gagal' class='alert alert-danger'>Maaf mohon isi username dan password<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";

}
// pastikan username dan password adalah berupa huruf atau angka.

$login=sprintf("SELECT * FROM t_user WHERE username='$user' AND password='$pass' ", mysql_real_escape_string($user), mysql_real_escape_string($pass));
$cek_lagi=mysqli_query($con, $login);
$ketemu=mysqli_num_rows($cek_lagi);
$r=mysqli_fetch_array($cek_lagi);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
   $_SESSION['kode']         = $r['id_user'];
  $_SESSION['namauser']     = $r['username'];
  $_SESSION['passuser']     = $r['password'];
  $_SESSION['w_login']      = $r['w_login'];
//  $id_user=$_SESSION['kode'];	
  
	echo "<div id='sukses' class='alert alert-info'><strong>BERHASIL...</strong><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div><script>window.location ='home.php'</script>";
	mysql_query("update t_user set w_login=NOW() where id_user='$id_user'");
      
}

else{

 echo "<div id='gagal' class='alert alert-danger'>Mohon maaf username & password anda salah<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
}

?>
