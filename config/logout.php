<?php  session_start();
if(isset($_SESSION['kode']))
{
	session_destroy();
	header('Location:../index.php?status=Anda sudah Keluar');
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login!');
}
?>