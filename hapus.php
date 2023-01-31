<?php
        include('config/koneksi.php');


        if($_POST['id']){
        $id=$_POST['id'];
        $delete = mysqli_query ($con, "DELETE FROM t_service WHERE id_service=$id" ) or die (mysql_error());

             if ($delete) {
            //jika  berhasil langsung diarahkan kembali ke file bootstrap.php
            header('location:home.php');
            } else {
                // jika gagal tampil ini
                echo "Gagal Melakukan penghapusan data: " . $koneksi->error;
            }


        }


?>