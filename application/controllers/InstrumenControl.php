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
class InstrumenControl extends CI_Controller {

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

    function tambah() {
        $this->load->model('Instrument');
        $nama = $_GET["nama_instrumen"];
        $jumlah = $_GET["jumlah_instrumen"];
//        $steril = $_GET["steril"];
        $query = $this->Instrument->tambah_data_instrument($nama, $jumlah);

        if ($query) {

            $data = array(
                'tambah_instrumen' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('tambah_instrument');
        } else {

            $data = array(
                'tambah_instrumen' => false
            );
            $this->session->set_userdata($data);
            $this->load->view('tambah_instrument');
        }
    }

    function cari() {
        $this->load->model('Instrument');
        $nama = $_GET["namainstrumen"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('data_instrumen', $data);
    }

    function cariHapus() {
        $this->load->model('Instrument');
        $nama = $_GET["namainstrumen"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('hapus_instrument', $data);
    }

    function hapus() {
        $this->load->model('Instrument');
        $id = $_GET['id'];

        if (count($id) == 0) {

            $data = array(
                'hapus_instrumen' => 2
            );
            $this->session->set_userdata($data);
            redirect(base_url('site/hapus_instrument'));
        } else {
            $data = array(
                'hapus_instrumen_confirm' => TRUE,
                'listid' => $id
            );
            $this->session->set_userdata($data);
            redirect(base_url('site/hapus_instrument'));
        }
    }

    function hapusFix() {
        $confirm = $_GET['denied'];
        $data;
        if ($confirm == 1) {
            $this->load->model('Instrument');
            $id = $_SESSION['listid'];
            $query = $this->Instrument->hapus_instrumen($id);
            $this->session->unset_userdata('listid');
            $data = array(
                'hapus_instrumen' => 1,
                'listid' => 'habis'
            );
        } else {
            $data = array(
                'hapus_instrumen' => 0,
                'listid' => 'habis'
            );
        }

        $this->session->set_userdata($data);
        redirect(base_url('site/hapus_instrument'));
    }

}
