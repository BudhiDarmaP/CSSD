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
    function laporan(){
        $this->load->view('laporan');
    }
    function tambah_pemijaman(){
        $this->load->view('tambah_pemijam');
    }
    function ubah_password(){
        $this->load->view('ubah_password');
    }
}
