<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Site extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_log_in();
    }

    function check_log_in() {
        $is_logged_in_check = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in_check) || $is_logged_in_check != TRUE) {
            $data['not_login'] = 'Maaf Anda tidak dapat mengakses halaman ini.<br/><br/> Silakan login terlebih dahulu';

            $this->load->view('welcome_message', $data);
            $this->CI = & get_instance();
            $this->CI->output->_display();

            die();
        }
    }

    function halamanUtama() {
        $this->load->view('home');
    }

    function halamanLogin() {
        $this->load->view('welcome_message');
    }

    function instrumen() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $this->load->view('data_instrumen', $data);
    }

    function ubah_password_konfirmasi() {
        $this->load->view('ubah_password_konfirmasi');
    }

    function ubah_password() {
        $this->load->view('ubah_password');
    }

    function tambah_user() {
        $this->load->model('Users');
        $data['data_user'] = $this->Users->panggil_data_user();
        $this->load->view('tambah_user', $data);
    }
    
    function edit_user() {
        $this->load->model('Users');
        $username = $_POST["id"];
        $data['edit_user'] = $this->Users->panggil_data_user_by_id($username);
        $this->load->view('edit_user', $data);
    }
    
    function hapus_user() {
        $this->load->model('Users');
        $username = $_GET["id"];
        $data['hapus_user'] = $this->Users->panggil_data_user_by_id($username);
        $this->load->view('hapus_user_konfirmasi', $data);
    }

    function peminjaman() {
        $this->load->view('peminjaman');
    }

    function tambah_peminjaman() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $this->load->view('tambah_peminjaman', $data);
    }

    function laporan() {
        $this->load->view('laporan');
    }

    function tambah_instrument() {
        $this->load->view('tambah_instrument');
    }

    function hapus_instrument() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $this->load->view('hapus_instrument', $data);
    }

    function tambah_pemijaman() {
        $this->load->view('tambah_pemijam');
    }

    function tambah_peminjam() {
        $this->load->view('tambah_peminjam');
    }

}
