<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Site extends CI_Controller {

    function __construct() {
        parent::__construct();
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

    function check_log_in_super_admin() {
        $is_logged_in_check = $this->session->userdata('is_logged_in');
        $status = $this->session->userdata('status_user');

        if ($is_logged_in_check == TRUE && $status != 0) {
            $data = array(
                'is_logged_in' => false,
                'not_user' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('welcome_message');
            $this->CI = & get_instance();
            $this->CI->output->_display();
            die();
        }
    }

    function check_log_in_admin_cssd() {
        $is_logged_in_check = $this->session->userdata('is_logged_in');
        $status = $this->session->userdata('status_user');

        if ($is_logged_in_check == TRUE && $status != 1) {
            $data = array(
                'is_logged_in' => false,
                'not_user' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('welcome_message');
            $this->CI = & get_instance();
            $this->CI->output->_display();
            die();
        }
    }

    function check_log_in_to_peminjaman() {
        $is_logged_in_check = $this->session->userdata('is_logged_in');
        $status = $this->session->userdata('status_user');

        if ($status == 0) {
            $data = array(
                'is_logged_in' => false,
                'not_user' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('welcome_message');
            $this->CI = & get_instance();
            $this->CI->output->_display();
            die();
        }
    }

    function halamanUtama() {
        $this->load->view('home');
    }
    
    function aktivitas_inventaris() {
        $status_user = $_SESSION['status_user'];
        if($status_user != 0 || $status_user !=1){
            $this->check_log_in_admin_cssd();
        }
        $this->load->model('Inventaris');
        $data['instrumen'] = $this->Inventaris->panggil_semua_data_inventaris_instrumen();
        $data['peminjaman'] = $this->Inventaris->panggil_semua_data_inventaris_peminjaman();
        $this->load->view('aktivitas_inventaris', $data);
    }

    function halamanLogin() {
        $this->load->view('welcome_message');
    }

    function halamanInstrumen() {
        $this->check_log_in_admin_cssd();
        $this->load->view('instrumen');
    }

    function instrumen() {
        $this->check_log_in_admin_cssd();
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_data_instrument();
        $this->load->view('data_instrumen', $data);
    }

    function ubah_password_konfirmasi() {
        $this->load->view('ubah_password_konfirmasi');
    }

    function ubah_password() {
        $this->load->view('ubah_password');
    }

    function tambah_user() {
        $this->check_log_in_super_admin();
        $this->load->model('Users');
        $data['data_user'] = $this->Users->panggil_data_user();
        $this->load->view('tambah_user', $data);
    }

    function edit_user() {
        $this->check_log_in_super_admin();
        $this->load->model('Users');
        $username = $_POST["id"];
        $data['edit_user'] = $this->Users->panggil_data_user_by_id($username);
        $this->load->view('edit_user', $data);
    }

    function hapus_user() {
        $this->check_log_in_super_admin();
        $this->load->model('Users');
        $username = $_GET["id"];
        $data['hapus_user'] = $this->Users->panggil_data_user_by_id($username);
        $this->load->view('hapus_user_konfirmasi', $data);
    }

    function peminjaman() {
        $this->check_log_in_to_peminjaman();
        $this->load->view('peminjaman');
    }

    function tambah_peminjaman() {
        $this->check_log_in_to_peminjaman();
        $this->load->model('Instrument');
        $this->load->model('Setting_Set');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $data['set'] = $this->Setting_Set->panggil_set();
        $this->load->view('tambah_peminjaman', $data);
    }

    function cek_peminjaman() {
        $this->check_log_in_admin_cssd();
        $this->load->view('cek_peminjaman');
    }

    function konfirmasi_pegawai() {
        $this->check_log_in_admin_cssd();
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        $data['peminjam'] = $this->Peminjaman->panggil_peminjam();
        $this->load->view('konfirmasi_pegawai', $data);
    }

    function lihat_peminjaman() {
        $this->check_log_in_admin_cssd();
        $this->load->model('Peminjaman');
        if (isset($_POST['kembali'])) {
            $tgl = $_POST['tgl_pinjam'];
            list($thn, $bln, $tgl, ) = explode('-', $tgl);
            $tgl = $tgl . '/' . $bln . '/' . $thn;
            $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($tgl);
            $data['tanggal'] = $tgl;
            $this->load->view('lihat_peminjaman', $data);
        } else {
            $tgl = date('d/m/Y');
            $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($tgl);
            $data['tanggal'] = $tgl;
            $this->load->view('lihat_peminjaman', $data);
        }
    }

    function lihat_peminjamanan_detail() {
        $this->check_log_in_admin_cssd();
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        //panggil tgl
        $id = $_POST['id'];
        $transaksi = $_POST['transaksi'];
        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman_detail($transaksi);
        //manggil data peminjam
        $query = $this->Users->panggil_data_user_by_id($id);
        $data['peminjam'] = $query->nama_user;
        //manggil data tanggal pinjam
        $tanggal;
        foreach ($data['pinjam_instrumen'] as $r):
            $tanggal = $r->tanggal_pinjam;
        endforeach;
        $data['id_transaksi'] = $transaksi;
        //panggil view
        $this->load->view('lihat_peminjaman_detail', $data);
    }

    function laporan() {
        $this->check_log_in_admin_cssd();
        $this->load->view('laporan');
    }

    function tambah_instrument() {
        $this->check_log_in_admin_cssd();
        $this->load->view('tambah_instrument');
    }

    function hapus_instrument() {
        $this->check_log_in_admin_cssd();
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_data_instrument();
        $this->load->view('hapus_instrument', $data);
    }

    function tambah_pemijaman() {
        $this->check_log_in_to_peminjaman();
        $this->load->view('tambah_pemijam');
    }

    function tambah_peminjam() {
        $this->check_log_in_admin_cssd();
        $this->load->view('tambah_peminjam');
    }
    
    function pengembalian() {
        $this->check_log_in_admin_cssd();
        $this->session->unset_userdata('konfirmasi');
        $this->load->view('pengembalian');
    }

}
