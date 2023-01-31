<?php
// memanggil berkas koneksi.php
session_start();// Memulai Session
$a = isset($_SESSION['kode']);

if ($a != NULL)

{
?>

<?php
include '../config/koneksi.php';
require('../laporan/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('icon.png',1,1,2,3);
$pdf->MultiCell(0,0.6,'');
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'Badan Pendapatan Daerah Provinsi Riau',0,'L');
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'Jl. Jend. Sudirman No. 6 Simpang Tiga Pekanbaru 28284',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'Website : www.badanpendapatan.riau.go.id',0,'L');
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'email : adminweb.dipenda@riau.go.id',0,'L');
$pdf->Line(1,4.2,20,4.2);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,4.3,20,4.3);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(18,1.3,"Laporan Monitoring Server Utama",0,10,'C');
$pdf->ln(0.5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("d-M-Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Subjek Monitoring', 1, 0, 'C');
$pdf->Cell(11, 0.8, 'Log Notifikasi', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$ya=10;
$row=0.8;
$query=mysqli_query($con, "SELECT * FROM t_notif") or die(mysql_error());
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['comment_subject'],1, 0, 'C');
	$pdf->Cell(11, 0.8, $lihat['comment_text'], 1, 1,'L');

	$no++;
	$ya= $ya+$row;
}

$pdf->text(14,$ya,"Pekanbaru, ".date("d-M-Y"));
$pdf->text(13.4,$ya+2,"Network Administrator Bapenda");


$pdf->Output("laporanMonitoringServerBapenda1.pdf","I");
?>

<?php
}else{
    echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini, login terlebih dahulu'); window.location = '../index.php'</script>";
}
?>
