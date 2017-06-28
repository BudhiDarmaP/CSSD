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
        $this->load->model('Users');
        $id = $_GET['id'];
        $data[count($id)] = null;
        $index = 1;
        foreach ($id as $key) {
            $data[$index] = $this->Instrument->panggil_data_id($key);
            $index++;
        }
//        $data['id_user'] = $this->User->panggil_data_peminjam();
        $id_peminjam = $this->Users->panggil_data_peminjam();
        $data['cari_instrumen'] = $data;
        $data['id_peminjam'] = $id_peminjam;
        $this->load->view('konfirmasi_peminjaman', $data);
    }

    function konfirmasi() {
        //panggil model
        $this->load->model('Peminjaman');
        //cek user
        $user;$status;
        if ($_GET['peminjam']!=NULL) {
            $user=$_GET['peminjam'];
            $status=1;
        }else{
        $user = $_SESSION['username'];
        $status=0;
        }
        //get parameter
        $id = $_GET['id_instrumen'];
        $jumlah = $_GET['jumlah'];
        $tgl_pinjam = $_GET['tgl_pinjam'];
        $tgl_kembali = $_GET['tgl_kembali'];
        //generate id
        $tgl = date('YmdHis');
        $id_transaksi = $user . $tgl;
        //cek ketersediaan
        if ($tgl_pinjam != NULL && $tgl_kembali != NULL) {
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
                $data[$index] = $this->Peminjaman->pinjam($id_transaksi, $user, $key, $input, $tgl_pinjam, $tgl_kembali,$status);
                $index++;
            }
            //simpan hasil ke dalam array
            $tampil['pinjam_instrumen'] = $this->Peminjaman->panggil_pinjam($id_transaksi);
            //panggil view
            $this->load->view('result_peminjaman', $tampil);
        } else {
            //simpan hasil ke dalam array
            $tampil['pinjam_instrumen'] = $this->Peminjaman->panggil_pinjam($id_transaksi);
            //panggil view
            $this->load->view('result_peminjaman', $tampil);
        }
    }

}
