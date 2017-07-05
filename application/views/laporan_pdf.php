<?php

/**
 * Description of laporan_pdf
 *
 * @author budhidarmap
 */
require('fpdf17/fpdf.php');
$user = $_SESSION('nama_user');

$column_id_transaksi = "";
$column_nama_instrumen = "";
$column_jumlah_pinjam = "";
$column_nama_user = "";
$column_tanggal_pinjam = "";
$column_tanggal_kembali = "";
$column_waktu_approve = "";
$column_id_cssd = "";
$yPdf = 40;
//For each row, add the field to the corresponding column
while ($row = mysql_fetch_array($data)) {
$id_transaksi = $row["id_transaksi"];
$nama_instrumen = $row["nama_instrumen"];
$jumlah_pinjam = $row["jumlah_pinjam"];
$nama_user = $row["nama_user"];
$tanggal_pinjam = $row["tanggal_pinjam"];
$tanggal_kembali = $row["tanggal_kembali"];
$waktu_approve = $row["waktu_approve"];
$id_cssd = $row["id_cssd"];
$yPdf+=6;
$column_id_transaksi = $column_id_transaksi . $id_transaksi . "\n";
$column_nama_instrumen = $column_nama_instrumen . $nama_instrumen . "\n";
$column_jumlah_pinjam = $column_jumlah_pinjam . $jumlah_pinjam . "\n";
$column_nama_user = $column_nama_user . $column_nama_user . "\n";
$column_tanggal_pinjam = $column_tanggal_pinjam . $tanggal_pinjam . "\n";
$column_tanggal_kembali = $column_tanggal_kembali . $tanggal_kembali . "\n";
$column_waktu_approve = $column_waktu_approve . $waktu_approve . "\n";
$column_id_cssd = $column_id_cssd . $id_cssd . "\n";

//Create a new PDF file
$pdf = new FPDF('P', 'mm', 'A4'); //P For Portrait dengan ukuran A4
$pdf->AddPage();

//Menambahkan Gambar
$pdf->Image('images/logo.png');

$pdf->SetFont('times', 'B', 14);
$pdf->Cell(125);
$pdf->Cell(30, 10, 'RSUD KABUPATEN KARANGASEM', 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(125);
$pdf->Cell(30, 10, 'Central Sterile Supply Department', 0, 0, 'C');
$pdf->Ln();
}
//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110, 180, 230);
//Bold Font for Field Name
$pdf->SetFont('times', 'B', 12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(12);
$pdf->Cell(25, 8, 'ID Transaksi', 1, 0, 'C', 1);
$pdf->SetX(35);
$pdf->Cell(25, 8, 'Nama Instrumen', 1, 0, 'C', 1);
$pdf->SetX(60);
$pdf->Cell(20, 8, 'Jumlah Pinjam', 1, 0, 'C', 1);
$pdf->SetX(80);
$pdf->Cell(25, 8, 'Nama Peminjam', 1, 0, 'C', 1);
$pdf->SetX(105);
$pdf->Cell(25, 8, 'Tanggal Pinjam', 1, 0, 'C', 1);
$pdf->SetX(130);
$pdf->Cell(17, 8, 'Tanggal Kembali', 1, 0, 'C', 1);
$pdf->SetX(147);
$pdf->Cell(25, 8, 'Tanggal Approve', 1, 0, 'C', 1);
$pdf->SetX(172);
$pdf->Cell(25, 8, 'Petugas', 1, 0, 'C', 1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

//Now show the columns
$pdf->SetFont('Times', '', 12);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(10);
$pdf->MultiCell(25, 6, $column_id_transaksi, 1, 'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(35);
$pdf->MultiCell(25, 6, $column_nama_instrumen, 1, 'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(60);
$pdf->MultiCell(20, 6, $column_jumlah_pinjam, 1, 'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(80);
$pdf->MultiCell(25, 6, $column_nama_user, 1, 'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(105);
$pdf->MultiCell(25, 6, $column_tanggal_pinjam, 1, 'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(130);
$pdf->MultiCell(17, 6, $column_tanggal_kembali, 1, 'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(147);
$pdf->MultiCell(25, 6, $column_waktu_approve, 1, 'R');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(172);
$pdf->MultiCell(25, 6, $column_id_cssd, 1, 'R');

$yTTD = $yPdf + 32;
$pdf->SetY($yTTD);
$pdf->SetX(152);
$pdf->Cell(25, 6, 'Karangasem, ', 0, 0, 'C');
$pdf->SetX(172);
$pdf->Cell(25, 6, (date('d-M-Y', time())), 0, 0, 'C');

$yTTD2 = $yTTD + 5;
$pdf->SetY($yTTD2);
$pdf->SetX(163);
$pdf->Cell(25, 6, $user.',', 0, 0, 'C');

$yTTD2 = $yTTD + 27;
$pdf->SetY($yTTD2);
$pdf->SetX(162);
$pdf->Cell(25, 6, '_________________________', 0, 0, 'C');

$pdf->Output();
?>

