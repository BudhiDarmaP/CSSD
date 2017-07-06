<?php

/**
 * Description of LaporanControl
 *
 * @author budhidarmap
 */
class LaporanControl extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_log_in();
    }

    function check_log_in() {
        $is_logged_in_check = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in_check) || $is_logged_in_check != TRUE) {
            $data = array(
                'is_logged_in' => false,
                'not_login' => 'Maaf Anda Harus Login'
            );
            $this->session->set_userdata($data);
            $this->load->view('welcome_message');
            $this->CI = & get_instance();
            $this->CI->output->_display();

            die();
        }
    }

    function harian() {
        //--header--
        $this->load->view('laporan_header');
        //--hapus session--
        $this->session->unset_userdata('cetak');
        //load model
        $tgl = date('m/d/y');
        $this->load->model("Peminjaman");
        if ($_SESSION != NULL) {
            if ($_POST != NULL) {
                $tgl = $_POST['tgl'];
            } else {
                $tgl = date('m/d/y');
            }
        }
        //panggil data
        $laporan['laporan_harian'] = $this->Peminjaman->laporan_harian_peminjaman($tgl);
        $laporan['tanggal'] = $tgl;
        $data = array(
            'cetak' => $this->Peminjaman->sql_laporan_harian_peminjaman($tgl),
            'tanggal' => $tgl
        );
        if (true) {
            $this->session->set_userdata($data);
            $this->load->view('laporan_harian', $laporan);
//        $this->load->view('laporan_pdf');
            //--footer--
            $this->load->view('laporan_footer');
        }
    }

    function inputHarian() {
        
    }

    function bulanan() {
        //--header--
        $this->load->view('laporan_header');

        //load model
        $this->load->model("Peminjaman");
        $data = array(
            'bulan' => date('m/y'));
        $this->session->set_userdata($data);
        $this->load->view('laporan_bulanan');

        //--footer--
        $this->load->view('laporan_footer');
    }

    function inputBulanan() {
        
    }

    function tahunan() {
        //--header--
        $this->load->view('laporan_header');

        //load model
        $this->load->model("Peminjaman");
        $data = array(
            'tahun' => date('y'));
        $this->session->set_userdata($data);
        $this->load->view('laporan_tahunan');

        //--footer--
        $this->load->view('laporan_footer');
    }

    function inputTahunan() {
        
    }

    function cetak() {
        //panggil include
        include 'fpdf17/fpdf.php';
        $pdf = new FPDF();
        //panggil model
        $this->load->model('Peminjaman');
        //panggil hari ini
        if ($_SESSION != NULL) {
            $tgl = $_SESSION['tanggal'];
            if ($tgl = NULL) {
                $tgl = date('m/d/y');
            }
        } else {
            $tgl = date('m/d/y');
        }
        //panggil data
        $laporan = $_SESSION['cetak'];
        if ($laporan != NULL) { // jika data ada di database
            //Create a new PDF file
            $user = $_SESSION['nama_user'];

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
//            while ($row = mysql_fetch_row($laporan)) {
//                $id_transaksi = $row["id_transaksi"];
//                $nama_instrumen = $row["nama_instrumen"];
//                $jumlah_pinjam = $row["jumlah_pinjam"];
//                $nama_user = $row["nama_user"];
//                $tanggal_pinjam = $row["tanggal_pinjam"];
//                $tanggal_kembali = $row["tanggal_kembali"];
//                $waktu_approve = $row["waktu_approve"];
//                $id_cssd = $row["id_cssd"];
//                $yPdf+=6;
//                $column_id_transaksi = $column_id_transaksi . $id_transaksi . "\n";
//                $column_nama_instrumen = $column_nama_instrumen . $nama_instrumen . "\n";
//                $column_jumlah_pinjam = $column_jumlah_pinjam . $jumlah_pinjam . "\n";
//                $column_nama_user = $column_nama_user . $column_nama_user . "\n";
//                $column_tanggal_pinjam = $column_tanggal_pinjam . $tanggal_pinjam . "\n";
//                $column_tanggal_kembali = $column_tanggal_kembali . $tanggal_kembali . "\n";
//                $column_waktu_approve = $column_waktu_approve . $waktu_approve . "\n";
//                $column_id_cssd = $column_id_cssd . $id_cssd . "\n";
//            }
            //Create a new PDF file
            $pdf = new FPDF('P', 'mm', 'A4'); //P For Portrait dengan ukuran A4
            $pdf->AddPage();

            //Menambahkan Gambar
            $pdf->Image('images/karangasem_logo.png', 25, 10, 24, 28); //logo kabupaten karangasem
            $pdf->Image('images/Logo.png', 157, 10, 27, 30); //logo RSUD Karangasem
            //kop surat
            $pdf->SetFont('times', '', 14);
            $pdf->Cell(1);
            $pdf->Cell(0, 5, 'PEMERINTAH KABUPATEN KARANGASEM', 0, 1, 'C');
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(1);
            $pdf->Cell(0, 5, 'RSUD KABUPATEN KARANGASEM', 0, 1, 'C');
            $pdf->SetFont('times', 'I', 14);
            $pdf->Cell(1);
            $pdf->Cell(0, 5, 'Central Sterile Supply Department', 0, 1, 'C');
            $pdf->SetFont('times', 'I', 8);
            $pdf->Cell(1);
            $pdf->Cell(0, 5, 'Jl. Ngurah Rai, Amlapura, Tlp.(0363)21470,21011', 0, 1, 'C');
            $pdf->Cell(1);
            $pdf->Cell(0, 5, 'Fax.(0363)23582, Email: rsud_karangasem@yahoo.co.id', 0, 1, 'C');
            $pdf->SetFont('times', '', 8);
            $pdf->Cell(1);
            $pdf->Cell(0, 5, 'website: http://rsud.karangasemkab.go.id/', 0, 1, 'C');
            $pdf->SetLineWidth(1);
            $pdf->Line(25, 40, 183, 40);
            $pdf->SetLineWidth(0);
            $pdf->Line(25, 41, 183, 41);
            //First create each Field Name
            //Gray color filling each Field Name box
            $pdf->SetFont('times', '', 14);
            $pdf->Cell(1);
            $pdf->Cell(100, 25, 'Laporan Amprah: '.$_SESSION['tanggal'], 0, 1, 'C');
            $pdf->SetFillColor(110, 180, 230);
            //Bold Font for Field Name
//            $pdf->SetFont('times', 'B', 12);
//            $pdf->SetY(50);
//            $pdf->SetX(50);
//            $pdf->Cell(0, 8, 'ID Transaksi', 1, 0, 'C', 1);
//            $pdf->SetX(35);
//            $pdf->Cell(25, 8, 'Nama Instrumen', 1, 0, 'C', 1);
//            $pdf->SetX(60);
//            $pdf->Cell(20, 8, 'Jumlah Pinjam', 1, 0, 'C', 1);
//            $pdf->SetX(80);
//            $pdf->Cell(25, 8, 'Nama Peminjam', 1, 0, 'C', 1);
//            $pdf->SetX(105);
//            $pdf->Cell(25, 8, 'Tanggal Pinjam', 1, 0, 'C', 1);
//            $pdf->SetX(130);
//            $pdf->Cell(17, 8, 'Tanggal Kembali', 1, 0, 'C', 1);
//            $pdf->SetX(147);
//            $pdf->Cell(25, 8, 'Tanggal Approve', 1, 0, 'C', 1);
//            $pdf->SetX(172);
//            $pdf->Cell(25, 8, 'Petugas', 1, 0, 'C', 1);
//            $pdf->Ln();
//
//            //Table position, under Fields Name
//            $Y_Table_Position = 38;
//
//            //Now show the columns
//            $pdf->SetFont('Times', '', 12);
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(10);
//            $pdf->MultiCell(25, 6, $column_id_transaksi, 1, 'C');
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(35);
//            $pdf->MultiCell(25, 6, $column_nama_instrumen, 1, 'C');
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(60);
//            $pdf->MultiCell(20, 6, $column_jumlah_pinjam, 1, 'C');
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(80);
//            $pdf->MultiCell(25, 6, $column_nama_user, 1, 'C');
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(105);
//            $pdf->MultiCell(25, 6, $column_tanggal_pinjam, 1, 'C');
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(130);
//            $pdf->MultiCell(17, 6, $column_tanggal_kembali, 1, 'C');
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(147);
//            $pdf->MultiCell(25, 6, $column_waktu_approve, 1, 'R');
//
//            $pdf->SetY($Y_Table_Position);
//            $pdf->SetX(172);
//            $pdf->MultiCell(25, 6, $column_id_cssd, 1, 'R');
//
//            $yTTD = $yPdf + 32;
//            $pdf->SetY($yTTD);
//            $pdf->SetX(152);
//            $pdf->Cell(25, 6, 'Karangasem , ', 0, 0, 'C');
//            $pdf->SetX(172);
//            $pdf->Cell(25, 6, (date('d-M-Y', time())), 0, 0, 'C');
//
//            $yTTD2 = $yTTD + 5;
//            $pdf->SetY($yTTD2);
//            $pdf->SetX(163);
//            $pdf->Cell(25, 6, $user . ',', 0, 0, 'C');
//
//            $yTTD2 = $yTTD + 27;
//            $pdf->SetY($yTTD2);
//            $pdf->SetX(162);
//            $pdf->Cell(25, 6, '_________________________', 0, 0, 'C');

            $pdf->Output();
        } else { // jika data kosong
            redirect('laporan');
        }
        exit();
    }

}
