<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Site extends CI_Controller {

    function __construct() {
        parent::__construct();
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

    function ubah_password() {
        $this->load->view('ubah_password');
    }

    function peminjaman() {
        $this->load->view('peminjaman');
    }
    
    function tambah_peminjaman() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_data_instrument();
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

    function tambah_peminjam() {
        $this->load->view('tambah_peminjam');
    }
}
