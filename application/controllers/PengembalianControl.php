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

}
