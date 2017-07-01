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
    function pengembalian(){
        //model
        $this->load->model('Peminjaman');
        //transaksi
        $transaksi= $_GET['id_transaksi'];
        if ($transaksi!=NULL) {   
        $data['pengembalian'] = $this->Peminjaman->panggil_transaksi($transaksi);
        }  else {
            $data = array(
                'konfirmasi' => false,
            );
            $this->session->set_userdata($data);
        }
        //panggil view
        $this->load->view('konfirmasi_pengembalian', $data);
    }
}
