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
            //jika kembalian NULL
            if ($data['pengembalian']==NULL) {
                $data = array(
                'konfirmasi' => true,
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
            $this->session->set_userdata($data);
            //panggil view
            $this->load->view('pengembalian', $data);
        }
    }

    function konfirm() {
        //panggil model
        $this->load->model('Peminjaman');
        $tgl_kembali = $_POST['tgl_kembali'];
        //transaksi single
        $id_transaksi = $_POST['transaksi'];
        //instrumen array
        $id = $_POST['id_instrumen'];
        //keterangan array
        //$ket = $_POST['ket'];
        //panggil index untuk array
        $index = 0;
        //looping array instrumen
        foreach ($id as $instrumen) {
            $data['pengembalian'] = $this->Peminjaman->konfirmasi_pengembalian($id_transaksi, $instrumen, $tgl_kembali/*, $ket[$index]*/);
            $index++;
        }
        //set session true
        $data = array(
            'konfirmasi' => TRUE,
        );
        $this->session->set_userdata($data);
        //panggil view
        $this->load->view('pengembalian', $data);
    }

}
