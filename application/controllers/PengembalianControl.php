<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TambahInstrumentControl
 *
 * @author budhidarmap
 */
class PengembalianControl extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_log_in();
        $this->check_notifikasi_pengembalian();
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
    
    function check_notifikasi_pengembalian() {
        $status = $_SESSION['status_user'];
        if($status == 0 || $status == 1){
            $this->load->model('Peminjaman');
            $data = array(
                'pengembalian' => $this->Peminjaman->notifikasi_pengembalian()
            );
            $this->session->set_userdata($data);
        }
    }

    function pengembalian() {
        //model
        $this->load->model('Peminjaman');
        //unset session
        $this->session->unset_userdata('konfirmasi');
        //transaksi
        $transaksi = $_GET['id_transaksi'];
        //jika maka ada
        if ($transaksi != NULL) {
            //lakukan transaksi
            $data['pengembalian'] = $this->Peminjaman->panggil_transaksi($transaksi);
            $data['id_transaksi'] = $transaksi;
            //jika kembalian NULL
            if ($data['pengembalian'] == NULL) {
                $data = array(
                    'konfirmasi' => true,
                    'transaksi' => $transaksi
                );
                //set settion gagal
                $this->session->set_userdata($data);
            }
            //panggil view
            $this->load->view('konfirmasi_pengembalian', $data);
            //jika kosong maka
        } else {
            $data = array(
                'konfirmasi' => false,
            );
            $data['id_transaksi'] = $transaksi;
            $this->session->set_userdata($data);
            //panggil view
            $this->load->view('pengembalian', $data);
        }
    }

    function konfirm() {
        //panggil model
        $this->load->model('Peminjaman');
        $tgl_kembali = $tgl = date('m/d/Y');
        ;
        //transaksi single
        $id_transaksi = $_POST['transaksi'];
        //instrumen array
        $id = null;
        if (isset($_POST['id_instrumen'])) {
            $id = $_POST['id_instrumen'];
        }
        //keterangan array
        //$ket = $_POST['ket'];
        //panggil index untuk array
        $index = 0;
        //looping array instrumen
        $data;
        if ($id != null) {
            foreach ($id as $instrumen) {
                $data['pengembalian'] = $this->Peminjaman->konfirmasi_pengembalian($id_transaksi, $instrumen, $tgl_kembali/* , $ket[$index] */);
                $index++;
            }
            
            $data = array(
                'konfirmasi' => TRUE,
                'pengembalian' => $this->Peminjaman->notifikasi_pengembalian()
            );
        } else {
            $data = array(
                'konfirmasi' => FALSE,
            );
        }
        //set session true

        $this->session->set_userdata($data);
        //panggil view
        $this->load->view('pengembalian', $data);
    }

    function kendala() {
        //panggil model
        $this->load->model('Peminjaman');
        $this->load->model('Riwayat_Instrumen');
        $tgl_kembali = $tgl = date('m/d/Y');

        //panggil semua atribut
        $id_transaksi = $_GET['id_transaksi'];
        $id = $_GET['id_instrumen'];
        $jumlah = $_GET['jumlah'];

        //update pengembalian
        $this->Peminjaman->konfirmasi_pengembalian($id_transaksi, $id, $tgl_kembali/* , $ket[$index] */);

        //mengetahui barang hilang dan rusak
        $rusak = 0;
        $hilang = 0;

        for ($i = 1; $i <= $jumlah; $i++) {
            $barang = 'kondisi' . $i;
            $kondisi = $_GET[$barang];
            if ($kondisi == 'Rusak') {
                $rusak++;
            } elseif ($kondisi == 'Hilang') {
                $hilang++;
            }

            if ($kondisi != 'Baik') {
                $this->Riwayat_Instrumen->insert_riwayat($id, $id_transaksi, $kondisi);
            }
        }

        $total_kurangi_stok = 0 - ($rusak + $hilang);

        //mengurangi stok jumlah di table instrumen
        $this->Riwayat_Instrumen->kurangi_stok_instrumen($id, $total_kurangi_stok);

        //membuat inventaris mengurangi barang
        $id_cssd = $_SESSION['username'];
        $this->load->model('Instrument');
        if ($total_kurangi_stok < 0) {
            $this->Instrument->inventaris_tambah_stok_barang($id, $id_cssd, $total_kurangi_stok);
        }

        //kembali ke halaman konfirmasi pengembalian
        $data['pengembalian'] = $this->Peminjaman->panggil_transaksi($id_transaksi);
        $data['id_transaksi'] = $id_transaksi;
        //jika kembalian NULL
        if ($data['pengembalian'] == NULL) {
            $data = array(
                'konfirmasi' => true,
                'pengembalian' => $this->Peminjaman->notifikasi_pengembalian()
            );
            $data['id_transaksi'] = $id_transaksi;
            $this->session->set_userdata($data);
            //panggil view
            $this->load->view('pengembalian', $data);
        } else {
            //panggil view
            $this->load->view('konfirmasi_pengembalian', $data);
        }
    }

}
