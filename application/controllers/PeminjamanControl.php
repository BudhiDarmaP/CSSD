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
        $id = $this->input->post('id');
        $result=array();
        foreach ($id as $key=>$val){
            $result[] = array(
                'id'=>$_POST['id'][$key]);
        }
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($result);
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
        $pinjam=array(
            'id_peminjam'=>  $this->input->post(),
            'id_instrumen'=>  $this->input->post($id_instrumen),
            'jumlah_pinjam'=>  $this->input->post($jumlah),
            'tanggal_pinjam'=>  $this->input->post($tgl_pinjam),
            'tanggal_kembali'=>  $this->input->post($tgl_kembali),
            'status_peminjaman'=>  $this->input->post(0)
        );
        $this->Peminjaman->insert_pinjam($pinjam);
        $this->load->view('result_peminjaman', $data);
    }
}
