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
    }

    function tambah() {
        $this->load->model('Instrument');
        $nama = $_GET["nama_instrumen"];
        $jumlah = $_GET["jumlah_instrumen"];
        $steril = $_GET["steril"];
        $query = $this->Instrument->tambah_data_instrument($nama, $jumlah, $steril);

        if ($query) {
            $this->load->view('tambah_instrument');
            echo 'Sukses!';
        } else {
            $this->load->view('tambah_instrument');
            echo 'Gagal!';
        }
    }

    function cari() {
        $this->load->model('Instrument');
        $nama = $_GET["namainstrumen"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('data_instrumen', $data);
    }
}
