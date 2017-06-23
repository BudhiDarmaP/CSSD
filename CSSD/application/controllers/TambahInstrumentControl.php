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
class TambahInstrumentControl extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function tambah() {
        $this->load->model('Instrumen');
        $nama = $_GET["nama_instrumen"];
        $jumlah = $_GET["jumlah_instrumen"];
        $steril = $_GET["steril"];
        $query = $this->Instrumen->tambah_data_instrumen($nama, $jumlah, $steril);
        
        if ($query) {
            $this->load->view('tambah_instrument');
            echo 'Sukses!';
        } else {
            $this->load->view('tambah_instrument');
            echo 'Gagal!';
        }
    }

}
