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

    //halaman utama
    function halamanUtama() {
        $this->load->view('home');
    }

    //halaman login
    function halamanLogin() {
        $this->load->view('welcome_message');
    }

    //instrumen
    function instrumen() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $this->load->view('data_instrumen', $data);
    }

    function tambah_instrument() {
        $this->load->view('tambah_instrument');
    }

    function hapus_instrument() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $this->load->view('hapus_instrument', $data);
    }

    //peminjaman
    function tambah_peminjam() {
        $this->load->view('tambah_peminjam');
    }

    function peminjaman() {
        $this->load->view('peminjaman');
    }

    function tambah_peminjaman() {
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_data_instrument();
        $this->load->view('tambah_peminjaman', $data);
    }

    //cek peminjaman
    function cek_peminjaman() {
        $this->load->view('cek_peminjaman');
    }

    function konfirmasi_pegawai() {
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        $data['peminjam']=  $this->Peminjaman->panggil_peminjam();
        $this->load->view('konfirmasi_pegawai',$data);
    }

    function lihat_peminjaman() {
        $this->load->model('Peminjaman');
        $tgl = date('m/d/Y');
        $data['pinjam_instrumen']=  $this->Peminjaman->lihat_peminjaman($tgl);
        $this->load->view('lihat_peminjaman',$data);
    }

    //laporan
    function laporan() {
        $this->load->view('laporan');
    }

    //user
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

}
