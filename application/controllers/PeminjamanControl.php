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
        $this->check_log_in();
    }

    function check_log_in() {
        $is_logged_in_check = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in_check) || $is_logged_in_check != TRUE) {
            $data = array(
                'is_logged_in' => false,
                'not_login' => 'Maaf Anda Harus Login'
            );
            $this->session->set_userdata($data);
            $this->load->view('welcome_message');
            $this->CI = & get_instance();
            $this->CI->output->_display();

            die();
        }
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
        if (count($id) == 0) {

            $data = array(
                'pinjam_instrumen' => false
            );
            $this->session->set_userdata($data);
            redirect(base_url('site/tambah_peminjaman'));
        } else {
            $data[count($id)] = null;
            $index = 1;
            foreach ($id as $key) {
                $data[$index] = $this->Instrument->panggil_data_id($key);
                $index++;
            }
            $id_peminjam = $this->Users->panggil_data_peminjam();
            $data['cari_instrumen'] = $data;
            $data['id_peminjam'] = $id_peminjam;
            $this->load->view('konfirmasi_peminjaman', $data);
        }
    }

    function konfirmasi() {
        //panggil model
        $this->load->model('Peminjaman');
        //cek user
        $user;
        $status;
        if ($_GET['peminjam'] != NULL) {
            $user = $_GET['peminjam'];
            $tgl_kembali = $_GET['tgl_kembali'];
            $status = 1;
        } else {
            $user = $_SESSION['username'];
            $status = 0;
            $tgl_kembali = NULL;
        }
        //get parameter
        $id = $_GET['id_instrumen'];
        $jumlah = $_GET['jumlah'];
        $steril = $_GET['steril'];
        $tgl_pinjam = $_GET['tgl_pinjam'];
        //generate id
        $tgl = date('YmdHis');
        $id_transaksi = $user . $tgl;
        //cek ketersediaan
        if ($tgl_pinjam != NULL) {
            //deklarasi array
            $data[count($id)] = null;
            $index = 1;
            //deklarasi input
            $input1;
            $input2;
            $cssd = 'CSSD';
            //melooping array input
            foreach ($jumlah as $input1) {
                
            }
            foreach ($steril as $input2) {
                
            }
            //looping array id
            foreach ($id as $key) {
                //simpan peminjaman
                if ($status == 1) {
                    $data[$index] = $this->Peminjaman->pinjam_pegawai($id_transaksi, $user, $key, $input1, $input2, $tgl_pinjam, $tgl_kembali, $status);
                } else {
                    $data[$index] = $this->Peminjaman->pinjam_user($id_transaksi, $user, $key, $input1, $tgl_pinjam, $status);
                }
                $index++;
            }
            //simpan hasil ke dalam array
            $tampil['pinjam_instrumen'] = $this->Peminjaman->panggil_pinjam($id_transaksi);
            //panggil view
            $data = array(
                'pinjam_instrumen' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('result_peminjaman', $tampil);
        } else {
            //simpan hasil ke dalam array
            $tampil['pinjam_instrumen'] = $this->Peminjaman->panggil_pinjam($id_transaksi);
            //panggil view
            $this->load->view('result_peminjaman', $tampil);
        }
    }

    function lihat_pinjaman() {
        //load model
        $this->load->model('Peminjaman');
        //panggil tgl
        $tgl = $_GET['tgl'];
        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($tgl);
        
        $data['tanggal'] = $tgl;
        //panggil view
        $this->load->view('lihat_peminjaman', $data);
        
    }

    function peminjam_belum_konfirmasi() {
        //load model
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        //panggil peminjam
        $peminjam = $_GET['peminjam'];
        //masukkan id sebagai pencarian peminjaman
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        $data['peminjam'] = $this->Peminjaman->panggil_peminjam_id($peminjam);
        //panggil view
        $this->load->view('konfirmasi_pegawai', $data);
    }

    function konfirmasi_peminjaman() {
        //load model
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        //panggil id
        $id = $_POST['id'];
        $transaksi = $_POST['transaksi'];
        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->panggil_konfirmasi_id($id, $transaksi);
        //manggil data peminjam
        $query = $this->Users->panggil_data_user_by_id($id);
        $data['peminjam'] = $query->nama_user;
        //panggil view
        $this->load->view('konfirmasi_halaman', $data);
    }

    function Approved() {
        //panggil model
        $this->load->model('Peminjaman');
        //get parameter
        $id = $_POST['transaksi'];
        $instrumen = $_POST['id_instrumen'];
        $jumlah = $_POST['jumlah'];
        $steril = $_POST['steril'];
        $tgl_kembali = $_POST['tgl_kembali'];
        //deklarasi input
        $input1;
        $input2;
        $input3;
        //melooping array input
        foreach ($instrumen as $input1) {
            
        }
        foreach ($jumlah as $input2) {
            
        }
        foreach ($steril as $input3) {
            
        }
        //looping array id
        foreach ($id as $key) {
            //simpan peminjaman
            $data['result'] = $this->Peminjaman->konfirmasi_update($key, $input1, $input2, $input3, $tgl_kembali);
        }
        if ($data) {
            $hasil = array(
                'konfirmasi' => true
            );
            $this->session->set_userdata($hasil);
            $this->load->view('konfirmasi_halaman');
        } else {
            $hasil = array(
                'konfirmasi' => false
            );
            $this->session->set_userdata($hasil);
            $this->load->view('konfirmasi_halaman');
        }
    }

}
