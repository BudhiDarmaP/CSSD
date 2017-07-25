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
        $this->load->view('header_footer/header_laporan');
        //load model
        $tgl = date('m/d/Y');
        $this->load->model("Peminjaman");
        if ($_SESSION != NULL) {
            if ($_POST != NULL) {
                $tgl = $_POST['tgl'];
            } else {
                $tgl = date('m/d/Y');
            }
        }
        $laporan['laporan_harian'] = $this->Peminjaman->laporan_harian_peminjaman($tgl);
        $laporan['ket'] = 'distribusi';
        $laporan['tanggal'] = $tgl;
        //set session
        $data = array(
            'tanggal' => $tgl,
            'ket' => 'distribusi'
        );
        $this->session->set_userdata($data);
        $this->load->view('laporan/laporan_harian', $laporan);
        //--footer--
        $this->load->view('header_footer/footer_laporan');
    }

    function inputHarian() {
        //--header--
        $this->load->view('header_footer/header_laporan');
        //load model
        $this->load->model('Peminjaman');
        //panggil data
        $ket = $_GET['ket'];
        $tgl = $_SESSION['tanggal'];
        if ($ket == 'instrumen') {
            $laporan['laporan_harian'] = $this->Peminjaman->laporan_harian_peminjaman_sort_by_instrumen($tgl);
        } else if ($ket == 'setting') {
            $laporan['laporan_harian'] = $this->Peminjaman->laporan_harian_peminjaman_sort_by_setting($tgl);
        } else if ($ket == 'peminjam') {
            $laporan['laporan_harian'] = $this->Peminjaman->laporan_harian_peminjaman_sort_by_peminjam($tgl);
        } else if ($ket == 'inventaris') {
            $this->load->model('Riwayat_Instrumen');
            $laporan['laporan_harian'] = $this->Riwayat_Instrumen->laporan_harian($tgl);
        } else {
            $laporan['laporan_harian'] = $this->Peminjaman->laporan_harian_peminjaman($tgl);
        }
        $laporan['ket'] = $ket;
        $laporan['tanggal'] = $tgl;
        //set session
        $data = array(
            'tanggal' => $tgl,
            'ket' => 'distribusi'
        );
        $this->session->set_userdata($data);
        //--laporan harian--
        $this->load->view('laporan/laporan_harian', $laporan);
        //--footer--
        $this->load->view('header_footer/footer_laporan');
    }

    function bulanan() {
        //---header---//
        $this->load->view('header_footer/header_laporan');
        //unset session
        $this->session->unset_userdata('ket');
        $this->session->unset_userdata('tanggal');
        $this->session->unset_userdata('tahun');
        //load model
        $bln = date('m/Y');
        $this->load->model("Peminjaman");
        if ($_SESSION != NULL) {
            if ($_POST != NULL) {
                $bln = $_POST['bln'];
            } else {
                $bln = date('m/Y');
            }
        }
        //panggil data
        $laporan['laporan_bulanan'] = $this->Peminjaman->laporan_bulanan_peminjaman_sort_by_instrumen($bln);
        $laporan['ket'] = 'instrumen';
        $laporan['bulan'] = $bln;
        $data = array(
            'bulan' => $bln,
            'ket' => 'instrumen'
        );
        $this->session->set_userdata($data);
        $this->load->view('laporan/laporan_bulanan', $laporan);
        //--footer--//
        $this->load->view('header_footer/footer_laporan');
    }

    function inputBulanan() {
        //--header--
        $this->load->view('header_footer/header_laporan');
        //load model
        $this->load->model('Peminjaman');
        //panggil data
        $ket = $_GET['ket'];
        $bln = $_SESSION['bulan'];
        if ($ket == 'peminjam') {
            $laporan['laporan_bulanan'] = $this->Peminjaman->laporan_bulanan_peminjaman_sort_by_peminjam($bln);
        } else if ($ket == 'setting') {
            $laporan['laporan_bulanan'] = $this->Peminjaman->laporan_bulanan_peminjaman_sort_by_setting($bln);
        } else if ($ket == 'inventaris') {
            $this->load->model('Riwayat_Instrumen');
            $laporan['laporan_bulanan'] = $this->Riwayat_Instrumen->laporan_bulanan($bln);
        } else {
            $laporan['laporan_bulanan'] = $this->Peminjaman->laporan_bulanan_peminjaman_sort_by_instrumen($bln);
        }
        $laporan['ket'] = $ket;
        $laporan['bulan'] = $bln;
        //set session
        $data = array(
            'bulan' => $bln,
            'ket' => $ket
        );
        $this->session->set_userdata($data);
        //--laporan harian--
        $this->load->view('laporan/laporan_bulanan', $laporan);
        //--footer--
        $this->load->view('header_footer/footer_laporan');
    }

    function tahunan() {
        //---header---//
        $this->load->view('header_footer/header_laporan');
        //unset session
        $this->session->unset_userdata('ket');
        $this->session->unset_userdata('tanggal');
        $this->session->unset_userdata('bulan');
        //load model
        $thn = date('Y');
        $this->load->model("Peminjaman");
        if ($_SESSION != NULL) {
            if ($_POST != NULL) {
                $thn = $_POST['thn'];
            } else {
                $thn = date('Y');
            }
        }
        //panggil data
        $laporan['laporan_tahunan'] = $this->Peminjaman->laporan_tahunan_peminjaman_sort_by_instrumen($thn);
        $laporan['ket'] = 'instrumen';
        $laporan['tahun'] = $thn;
        $data = array(
            'tahun' => $thn,
            'ket' => 'instrumen'
        );
        $this->session->set_userdata($data);
        $this->load->view('laporan/laporan_tahunan', $laporan);
        //--footer--//
        $this->load->view('header_footer/footer_laporan');
    }

    function inputTahunan() {
        //--header--
        $this->load->view('header_footer/header_laporan');
        //load model
        $this->load->model('Peminjaman');
        //panggil data
        $ket = $_GET['ket'];
        $thn = $_SESSION['tahun'];
        if ($ket == 'peminjam') {
            $laporan['laporan_tahunan'] = $this->Peminjaman->laporan_tahunan_peminjaman_sort_by_peminjam($thn);
        } else if ($ket == 'setting') {
            $laporan['laporan_tahunan'] = $this->Peminjaman->laporan_tahunan_peminjaman_sort_by_setting($thn);
        } else if ($ket == 'inventaris') {
            $this->load->model('Riwayat_Instrumen');
            $laporan['laporan_tahunan'] = $this->Riwayat_Instrumen->laporan_tahunan($thn);
        } else {
            $laporan['laporan_tahunan'] = $this->Peminjaman->laporan_tahunan_peminjaman_sort_by_instrumen($thn);
        }
        $laporan['ket'] = $ket;
        $laporan['tahun'] = $thn;
        //set session
        $data = array(
            'tahun' => $thn,
            'ket' => $ket
        );
        $this->session->set_userdata($data);
        //--laporan harian--
        $this->load->view('laporan/laporan_tahunan', $laporan);
        //--footer--
        $this->load->view('header_footer/footer_laporan');
    }

    function cetak() {
        //panggil include
        include 'fpdf17/fpdf.php';
        $pdf = new FPDF();
        //panggil model
        $this->load->model('Peminjaman');
        $this->load->model('Inventaris');
        $date;
        $ket = $_SESSION['ket'];
        if ($_SESSION['tanggal'] != NULL) {
            $date = $_SESSION['tanggal'];
            if ($ket == 'distribusi') {
                $result = $this->Peminjaman->laporan_harian_peminjaman($date);
            } else if ($ket == 'instrumen') {
                $result = $this->Peminjaman->laporan_harian_peminjaman_sort_by_instrumen($date);
            } else if ($ket == 'peminjam') {
                $result = $this->Peminjaman->laporan_harian_peminjaman_sort_by_instrumen($date);
            } else {
                $result = $this->Inventaris->laporan_harian($date);
            }
        } else if ($_SESSION['bulan']) {
            $date = $_SESSION['bulan'];
            if ($ket == 'instrumen') {
                $result = $this->Peminjaman->laporan_bulanan_peminjaman_sort_by_instrumen($date);
            } else if ($ket == 'peminjam') {
                $result = $this->Peminjaman->laporan_bulanan_peminjaman_sort_by_instrumen($date);
            } else {
                $result = $this->Inventaris->laporan_bulanan($date);
            }
        } else {
            $date = $_SESSION['tahun'];
            if ($ket == 'instrumen') {
                $result = $this->Peminjaman->laporan_tahunan_peminjaman_sort_by_instrumen($date);
            } else if ($ket == 'peminjam') {
                $result = $this->Peminjaman->laporan_tahunan_peminjaman_sort_by_instrumen($date);
            } else {
                $result = $this->Inventaris->laporan_tahunan($date);
            }
        }
        //panggil data
        if ($result != NULL) { // jika data ada di database
            //Create a new PDF file
            $user = $_SESSION['nama_user'];
            if ($ket == 'distribusi') {
                $column_nomor = "";
                $column_id_transaksi = "";
                $column_nama_instrumen = "";
                $column_jumlah_pinjam = "";
                $column_nama_user = "";
                $column_tanggal_pinjam = "";
                $column_tanggal_kembali = "";
                $column_waktu_approve = "";
                $column_id_cssd = "";
                $yPdf = 40;
                $index = 1;
                //For each row, add the field to the corresponding column
                foreach ($result as $row) {
                    $nomor = $index;
                    $id_transaksi = $row->id_transaksi;
                    $nama_instrumen = $row->nama_instrumen;
                    $jumlah_pinjam = $row->jumlah_pinjam;
                    $nama_user = $row->nama_user;
                    $tanggal_pinjam = $row->tanggal_pinjam;
                    $tanggal_kembali = $row->tanggal_kembali;
                    $waktu_approve = $row->waktu_approve;
                    $id_cssd = $row->id_cssd;
                    $yPdf+=6;
                    $column_nomor = $column_nomor . $nomor . "\n";
                    $column_id_transaksi = $column_id_transaksi . $id_transaksi . "\n";
                    $column_nama_instrumen = $column_nama_instrumen . $nama_instrumen . "\n";
                    $column_jumlah_pinjam = $column_jumlah_pinjam . $jumlah_pinjam . "\n";
                    $column_nama_user = $column_nama_user . $nama_user . "\n";
                    $column_tanggal_pinjam = $column_tanggal_pinjam . $tanggal_pinjam . "\n";
                    $column_tanggal_kembali = $column_tanggal_kembali . $tanggal_kembali . "\n";
                    $column_waktu_approve = $column_waktu_approve . $waktu_approve . "\n";
                    $column_id_cssd = $column_id_cssd . $id_cssd . "\n";
                    $index++;
                    //Create a new PDF file
                    $pdf = new FPDF('P', 'mm', 'A4'); //P For Portrait dengan ukuran A4
                    $pdf->AddPage();
                    $pdf->SetAutoPageBreak(false);
                }
                //table break page
                $height_of_cell = 60; // mm
                $page_height = 286.93; // mm (portrait letter)
                $bottom_margin = 0; // mm
                for ($i = 0; $i <= 30; $i++) :
                    $space_left = $page_height - ($pdf->GetY() + $bottom_margin); // space left on page
                    if ($i / 9 == floor($i / 9) && $height_of_cell > $space_left + 40) {
                        $pdf->AddPage(); // page break
                    }
                endfor;
                //laporan
                $pdf->SetFont('times', '', 14);
                $pdf->Cell(1);
                $pdf->Cell(90, 25, 'Laporan Amprah: ' . $_SESSION['tanggal'], 0, 1, 'C');
                $pdf->SetFillColor(255, 255, 255);
                //Bold Font for Field Name
                $pdf->SetFont('times', 'B', 10);
                $pdf->SetY(60);
                $pdf->SetX(15);
                $pdf->Cell(7, 7, 'No.', 1, 0, 'C', 1);
                $pdf->SetX(22);
                $pdf->Cell(30, 7, 'ID Transaksi', 1, 0, 'C', 1);
                $pdf->SetX(52);
                $pdf->Cell(30, 7, 'Nama Instrumen', 1, 0, 'C', 1);
                $pdf->SetFont('times', 'B', 6);
                $pdf->SetX(82);
                $pdf->MultiCell(10, 3.5, 'Jumlah Pinjam', 1, 'C', 1);
                $pdf->SetFont('times', 'B', 10);
                $pdf->SetY(60);
                $pdf->SetX(92);
                $pdf->Cell(30, 7, 'Nama Peminjam', 1, 0, 'C', 1);
                $pdf->SetFont('times', 'B', 8);
                $pdf->SetX(122);
                $pdf->MultiCell(17, 3.5, 'Tanggal Pinjam', 1, 'C', 1);
                $pdf->SetY(60);
                $pdf->SetX(139);
                $pdf->MultiCell(17, 3.5, 'Tanggal Kembali', 1, 'C', 1);
                $pdf->SetY(60);
                $pdf->SetX(156);
                $pdf->Cell(30, 7, 'Tanggal Approve', 1, 0, 'C', 1);
                $pdf->SetX(186);
                $pdf->Cell(15, 7, 'Petugas', 1, 0, 'C', 1);
                $pdf->Ln();

                //Table position, under Fields Name
                $Y_Table_Position = 67;

                //Now show the columns
                $pdf->SetFont('Times', '', 8);
                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(15);
                $pdf->MultiCell(7, 6, $column_nomor, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(22);
                $pdf->MultiCell(30, 6, $column_id_transaksi, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(52);
                $pdf->MultiCell(30, 6, $column_nama_instrumen, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(82);
                $pdf->MultiCell(10, 6, $column_jumlah_pinjam, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(92);
                $pdf->MultiCell(30, 6, $column_nama_user, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(122);
                $pdf->MultiCell(17, 6, $column_tanggal_pinjam, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(139);
                $pdf->MultiCell(17, 6, $column_tanggal_kembali, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(156);
                $pdf->MultiCell(30, 6, $column_waktu_approve, 1, 'C');

                $pdf->SetY($Y_Table_Position);
                $pdf->SetX(186);
                $pdf->MultiCell(15, 6, $column_id_cssd, 1, 'C');
            }

            //tempat, tanggal
            $yTTD = -40;
            $pdf->SetY($yTTD);
            $pdf->SetX(155);
            $pdf->Cell(20, 6, 'Amlapura, ', 0, 0, 'C');
            $pdf->SetX(165);
            $pdf->Cell(25, 6, (date('d-M-Y', time())), 0, 0, 'C');
            //nama_user
            $yTTD2 = $yTTD + 5;
            $pdf->SetY($yTTD2);
            $pdf->SetX(160);
            $pdf->Cell(25, 6, $_SESSION['nama_user'] . ',', 0, 0, 'C');
            //ttd
            $yTTD2 = $yTTD + 27;
            $pdf->SetY($yTTD2);
            $pdf->SetX(162);
            $pdf->Cell(25, 6, '_________________________', 0, 0, 'C');
            $pdf->SetAutoPageBreak(-40);

            $pdf->Output();
        } else { // jika data kosong
            redirect(base_url('site/laporan'));
        }
        exit();
    }

}
