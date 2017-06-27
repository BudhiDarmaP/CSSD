<?php

/**
 * Description of PeminjamanControl
 *
 * @author budhidarmap
 */
class PeminjamanControl extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation'); // digunakan untuk proses validasi yg di input
        $this->load->database(); // Load our cart model for our entire class
        $this->load->helper(array('url', 'form')); // Load our cart model for our entire class
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
        $id = $_GET['id'];
        $data[count($id)] = null;
        $index = 1;
        foreach ($id as $key) {
            $data[$index] = $this->Instrument->panggil_data_id($key);
            $index++;
        }
        $data['cari_instrumen'] = $data;
        $this->load->view('konfirmasi_peminjaman', $data);
    }

    function konfirmasi() {
        //panggil model
        $this->load->model('Peminjaman');
        //get parameter
        $user = $_SESSION['username'];
        $id = $_GET['id_instrumen'];
        $jumlah = $_GET['jumlah'];
        $tgl_pinjam = $_GET['tgl_pinjam'];
        $tgl_kembali = $_GET['tgl_kembali'];
        //deklarasi array
        $data[count($id)] = null;
        $index = 1;
        //deklarasi input
        $input;
        //melooping array input
        foreach ($jumlah as $input) {
        }
        //looping array id
        foreach ($id as $key) {
            //simpan peminjaman
                $data[$index] = $this->Peminjaman->pinjam($user, $key, $input, $tgl_pinjam, $tgl_kembali);
            $index++;
        }
        //simpan hasil ke dalam array
        $data['pinjam_instrumen'] = $data;
        //panggil view
        $this->load->view('result_peminjaman', $data);
    }

}
