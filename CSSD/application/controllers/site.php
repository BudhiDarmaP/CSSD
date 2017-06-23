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
    
    function halamanUtama(){
        $this->load->view('home');
    }
    function instrument(){
        $this->load->view('instrument');
    }
    function peminjaman(){
        $this->load->view('peminjaman');
    }
    function laporan(){
        $this->load->view('laporan');
    }
    function instrumen() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $this->load->view('data_instrumen', $data);
    }
    function tambah_instrument(){
        $this->load->view('tambah_instrument');
    }
    function hapus_instrument(){
        $this->load->view('hapus_instrument');
    }
    function tambah_pemijaman(){
        $this->load->view('tambah_pemijam');
    }
    function ubah_password(){
        $this->load->view('ubah_password');
    }
}
