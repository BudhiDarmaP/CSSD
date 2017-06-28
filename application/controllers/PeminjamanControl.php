<?php

/**
 * Description of PeminjamanControl
 *
 * @author budhidarmap
 */
class PeminjamanControl extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function cari() {
        $this->load->model('Instrument');
        $nama = $_GET["namainstrumen"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('tambah_peminjaman', $data);
    }

    function pinjam() {
        $this->load->model('Peminjaman');
        $nama = $_GET["id"];
        $data['cari_instrumen'] = $this->Peminjaman->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('konfirmasi_peminjaman', $data);
    }

    function konfirmasi() {
        $this->load->model('Peminjaman');
        $nama = $_GET["id"];
        $data['cari_instrumen'] = $this->Peminjaman->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
//        $data['_instrumen'] = $;
        $this->load->view('konfirmasi_peminjaman', $data);
    }

}
