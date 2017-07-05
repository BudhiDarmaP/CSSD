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

        //load model
        $this->load->model("Peminjaman");
        $data = array(
            'tanggal'=>date('m/d/y'));
        $this->session->set_userdata($data);
        $this->load->view('laporan_harian');
        $this->load->view('laporan_pdf');
        //--footer--
        $this->load->view('laporan_footer');
    }

    function inputHarian() {
        
    }
    function bulanan() {
        //--header--
        $this->load->view('laporan_header');

        //load model
        $this->load->model("Peminjaman");
        $data = array(
            'bulan'=>date('m/y'));
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
            'tahun'=>date('y'));
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
        $tgl=$_SESSION('tanggal');
        //panggil data
        $laporan = $this->Peminjaman->laporan_harian_peminjaman($tgl);
        if ($laporan > 0) { // jika data ada di database
            //Create a new PDF file
            $pdf = new FPDF('P', 'mm', 'A4'); //Portait, ukuran A4
            $pdf->AddPage();
            //Menambahkan Gambar
            $pdf->Image('images/logo.png');
            $pdf->SetFont('times', 'B', 14);
            $pdf->Cell(125);
            $pdf->Cell(30, 10, 'Central Sterile Supply Department', 0, 0, 'C');
            $pdf->Ln();
            $pdf->Cell(125);
            $pdf->Cell(30, 10, 'RSUD KABUPATEN KARANGASEM', 0, 0, 'C');
            $pdf->Ln();
            $pdf->Output();
        } else { // jika data kosong
            redirect('laporan');
        }
        exit();
    }

}
