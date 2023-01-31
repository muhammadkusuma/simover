<?php
// panggil fungsi validasi xss dan injection
require_once('fungsi_validasi.php');

// definisikan koneksi ke database
$server = "localhost";
$username = "root";
$password = "qwerty";
$database = "db_simover";

// Koneksi dan memilih database di server
$con = mysqli_connect($server , $username , $password , $database) or die("Koneksi gagal");
// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new Lokovalidasi;
?>
