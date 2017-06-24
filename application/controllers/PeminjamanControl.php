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
        $this->load->model('Instrument');
        $nama = $_GET["id"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('konfirmasi_peminjaman', $data);
    }

    function konfirmasi() {
        $this->load->model('Peminjaman');
        $id_peminjam = $_SESSION["username"];
        $id_instrumen = $_GET["id_instrumen"];
        $jumlah = $_GET["jumlah"];
        $tgl_pinjam = $_GET["tgl_pinjam"];
        $tgl_kembali = $_GET["tgl_kembali"];
        $data['pinjam_instrumen'] = $this->Peminjaman->pinjam($id_peminjam, $id_instrumen, $jumlah, $tgl_pinjam, $tgl_kembali);
        $this->load->model('Instrument');
        $data['nama_instrumen'] = $this->Instrument->cari_data_instrument($id_instrumen);
        $this->load->view('result_peminjaman', $data);
    }
}
