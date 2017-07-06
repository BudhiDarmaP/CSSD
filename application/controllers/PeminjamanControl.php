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
        $this->load->model('Setting_Set');
        $nama = $_GET["namainstrumen"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument_peminjaman($nama);
        $data['set'] = $this->Setting_Set->panggil_set();
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

    function pinjam_setting() {
        //panggil model
        $this->load->model('Setting_Set');
        $this->load->model('Users');
        //get data
        $id = $_GET['set'];
        $jumlah = $_GET['banyak_set'];
        //set session
        $kode = array(
            'kode_set' => $id . ":" . $_GET['banyak_set']
        );
        $this->session->set_userdata($kode);
        //input ke function
        $data['cari_instrumen'] = $this->Setting_Set->panggil_set_id($id, $jumlah);
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        //view halaman
        $this->load->view('konfirmasi_peminjaman_setting', $data);
    }

    function konfirmasi() {
        //panggil model
        $this->load->model('Peminjaman');
        //cek user
        $user;
        $status;
        if ($_POST['peminjam'] != NULL) {
            $user = $_POST['peminjam'];
            $tgl_kembali = $_POST['tgl_kembali'];
            $pegawai_cssd = $_SESSION['username'];
            $status = 1;
        } else {
            $user = $_SESSION['username'];
            $status = 0;
            $tgl_kembali = NULL;
        }
        //get parameter
        $id = $_POST['id_instrumen'];
        $jumlah = $_POST['jumlah'];
        $steril = $_POST['steril'];
        $tgl_pinjam = $_POST['tgl_pinjam'];
        //generate id
        $tgl = date('YmdHis');
        $id_transaksi = 'ORD' . $tgl;
        //cek ketersediaan
        if ($tgl_pinjam != NULL) {
            //deklarasi array
            $data[count($id)] = null;
            $input1 = 0;
            //melooping array input
            //looping array id

            foreach ($id as $key) {
                //simpan peminjaman
                if ($status == 1) {
                    $data[$input1 + 1] = $this->Peminjaman->pinjam_pegawai($id_transaksi, $user, $key, $jumlah[$input1], $steril[$input1], $tgl_pinjam, $tgl_kembali, $status, $pegawai_cssd);
                } else {
                    $data[$input1 + 1] = $this->Peminjaman->pinjam_user($id_transaksi, $user, $key, $jumlah[$input1], $tgl_pinjam, $status);
                }
                $input1++;
            }

            //panggil view
            $data['pinjam_intrumen'] = true;
            $data['id_transaksi'] = $id_transaksi;

            if ($status == 1) {
                $tgl = $tgl_pinjam;
                list($bln, $tgl, $thn) = explode('/', $tgl);
                $tgl = $tgl . '/' . $bln . '/' . $thn;
                $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($tgl);
                $this->load->model('Users');
                $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
                $data['pinjam_intrumen'] = true;
                $data['tanggal'] = $tgl;
                $this->load->view('lihat_peminjaman', $data);
            } else {
                $this->load->view('result_peminjaman', $data);
            }
        } else {
            //simpan hasil ke dalam array
            $tampil['pinjam_instrumen'] = $this->Peminjaman->panggil_pinjam($id_transaksi);
            //panggil view
            $this->load->view('result_peminjaman', $tampil);
        }
    }

    function konfirmasi_set() {
        //panggil model
        $this->load->model('Peminjaman');
        //cek user
        $user;
        $status;
        if ($_GET['peminjam'] != NULL) {
            $user = $_GET['peminjam'];
            $tgl_kembali = $_GET['tgl_kembali'];
            $pegawai_cssd = $_SESSION['username'];
            $status = 1;
        } else {
            $user = $_SESSION['username'];
            $status = 0;
            $tgl_kembali = NULL;
        }
        //get parameter
        $id = $_GET['id_instrumen'];
        $kode = $_SESSION['kode_set'];
        $jumlah = $_GET['jumlah'];
        $steril = $_GET['steril'];
        $tgl_pinjam = $_GET['tgl_pinjam'];
        //generate id
        $tgl = date('YmdHis');
        $id_transaksi = 'ORD' . $tgl;
        //cek ketersediaan
        if ($tgl_pinjam != NULL) {
            //deklarasi array
            $data[count($id)] = null;
            $input1 = 0;
            //melooping array input
            //looping array id

            foreach ($id as $key) {
                //simpan peminjaman
                if ($status == 1) {
                    $data[$input1 + 1] = $this->Peminjaman->pinjam_set_pegawai($id_transaksi, $user, $kode, $key, $jumlah[$input1], $steril[$input1], $tgl_pinjam, $tgl_kembali, $status, $pegawai_cssd);
                } else {
                    $data[$input1 + 1] = $this->Peminjaman->pinjam_set_user($id_transaksi, $user, $kode, $key, $jumlah[$input1], $tgl_pinjam, $status);
                }
                $input1++;
            }

            //panggil view
            $data['pinjam_intrumen'] = true;
            $data['id_transaksi'] = $id_transaksi;

            if ($status == 1) {
                $tgl = $tgl_pinjam;
                list($bln, $tgl, $thn) = explode('/', $tgl);
                $tgl = $tgl . '/' . $bln . '/' . $thn;
                $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($tgl);
                $this->load->model('Users');
                $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
                $data['pinjam_intrumen'] = true;
                $data['tanggal'] = $tgl;
                $this->load->view('lihat_peminjaman', $data);
            } else {
                $this->load->view('result_peminjaman', $data);
            }
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
        $cari;
        $headerKirim;
        if (isset($_GET['tgl'])) {
            $cari = $_GET['tgl'];
            $headerKirim = 1;
        }
        if (isset($_GET['peminjam'])) {
            $cari = $_GET['peminjam'];
            $headerKirim = 2;
        }
        if (isset($_GET['id_transaksi'])) {
            $cari = $_GET['id_transaksi'];
            $headerKirim = 3;
        }

        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($cari);
        $this->load->model('Users');
        if ($headerKirim == 1) {
            $data['tanggal'] = $cari;
        } else if ($headerKirim == 2) {
            $peminjam = $this->Users->panggil_data_user_by_id($cari);
            $data['peminjam'] = $peminjam->nama_user;
        } else if ($headerKirim == 3) {
            $data['transaksi'] = $cari;
        }
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        //panggil view
        $this->load->view('lihat_peminjaman', $data);
    }

    function peminjam_belum_konfirmasi() {
        //load model
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        //panggil peminjam
        $peminjam;
        if (isset($_GET['peminjam'])) {
            $peminjam = $_GET['peminjam'];
        }
        if (isset($_GET['id_transaksi'])) {
            $peminjam = $_GET['id_transaksi'];
        }
        
        //masukkan id sebagai pencarian peminjaman
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        $data['peminjam'] = $this->Peminjaman->panggil_peminjam_id($peminjam);
        if (isset($_GET['cari'])) {
            $data['cari'] = true;
        }
        //panggil view
        $this->load->view('konfirmasi_pegawai', $data);
    }

    function konfirmasi_peminjaman() {
        //load model
        $this->load->model('Peminjaman');
        $this->load->model('Setting_Set');
        $this->load->model('Users');
        //panggil tgl
        $id = $_POST['id'];
        $transaksi = $_POST['transaksi'];
        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->panggil_konfirmasi_id($id, $transaksi);
        //panggil data setting peminjaman
        $query1 = $this->Peminjaman->panggil_kode_setting_set($transaksi);
        $set = $query1->setting_set;
        //jika set tidak NULL
        if ($set != NULL) {
            //explode menjadi xxx<kode> x<jumlah>
            $split = explode(":", $set);
            //panggil nama set
            $queryX = $this->Setting_Set->panggil_nama($split[0]);
            $data['nama_set'] = $queryX->nama_set;
            $data['jumlah_set'] = $split[1];
        }
        //manggil data peminjam
        $query2 = $this->Users->panggil_data_user_by_id($id);
        $data['peminjam'] = $query2->nama_user;
        //manggil data tanggal pinjam
        $tanggal;
        foreach ($data['pinjam_instrumen'] as $r):
            $tanggal = $r->tanggal_pinjam;
        endforeach;
        $data['tanggal_pinjam'] = $tanggal;
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
        $pegawai_cssd = $_SESSION['username'];
        //deklarasi input untuk index tiap array(instrumen, jumlah alat pinjam, steril)
        $input1 = 0;
        //melooping array input
        //looping array id
        foreach ($id as $key) {
            //simpan peminjaman
            $data['result'] = $this->Peminjaman->konfirmasi_update($key, $instrumen[$input1], $jumlah[$input1], $steril[$input1], $tgl_kembali, $pegawai_cssd);
            $input1++;
        }
        if ($data) {
            $hasil = array(
                'konfirmasi' => true
            );
            $this->session->set_userdata($hasil);
//            redirect(base_url('site/lihat_peminjaman'));
            $tgl = $_POST['tgl_pinjam'];
            list($tgl, $bln, $thn) = explode('-', $tgl);
            $tgl = $tgl . '/' . $bln . '/' . $thn;
            $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($tgl);
            $this->load->model('Users');
            $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
            $data['pinjam_intrumen'] = true;
            $data['tanggal'] = $tgl;
            $this->load->view('lihat_peminjaman', $data);
        } else {
            $hasil = array(
                'konfirmasi' => false
            );
            $this->session->set_userdata($hasil);
            $this->load->view('konfirmasi_halaman');
        }
    }

}
