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
        $this->check_notifikasi_pengembalian();
        $this->check_notifikasi_konfirmasi_persetujuan();
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

    function check_notifikasi_pengembalian() {
        $status = $_SESSION['status_user'];
        if ($status == 0 || $status == 1) {
            $this->load->model('Peminjaman');
            $data = array(
                'pengembalian' => $this->Peminjaman->notifikasi_pengembalian()
            );
            $this->session->set_userdata($data);
        }
    }

    function check_notifikasi_konfirmasi_persetujuan() {
        $status = $_SESSION['status_user'];
        if ($status == 0 || $status == 1) {
            $this->load->model('Peminjaman');
            $data = array(
                'konfirmasi_approve' => $this->Peminjaman->panggil_peminjam()
            );
            $this->session->set_userdata($data);
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
        if ($status_user != 0 && $status_user != 1) {
            //$this->check_log_in_admin_cssd();
        }
        $this->load->model('Inventaris');
        $data['instrumen'] = $this->Inventaris->panggil_semua_data_inventaris_instrumen();
        $data['peminjaman'] = $this->Inventaris->panggil_semua_data_inventaris_peminjaman();
        //mengirim data pegawai cssd
        $this->load->model('Users');
        $data['pegawai'] = $this->Users->panggil_data_pegawai();
        $this->load->view('aktivitas_inventaris', $data);
    }

    function cari_aktivitas_inventaris() {
        $status_user = $_SESSION['status_user'];
        $this->load->model('Users');
        $cari;
        if (isset($_GET["pegawai"])) {
            $cari = $_GET["pegawai"];
        }
        if (isset($_GET["tanggal"])) {
            $cari = $_GET["tanggal"];
        }
        $this->load->model('Inventaris');
        $data['cari_instrumen'] = $this->Inventaris->cari_semua_data_inventaris_instrumen($cari);
        $data['cari_peminjaman'] = $this->Inventaris->cari_semua_data_inventaris_peminjaman($cari);
        //mengirim data pegawai cssd
        $data['pegawai'] = $this->Users->panggil_data_pegawai();
        if (isset($_GET["pegawai"])) {
            $query = $this->Users->panggil_data_user_by_id($cari);
            $cari = $query->nama_user;
        }
        $data['cari'] = $cari;
        $this->load->view('aktivitas_inventaris', $data);
    }

    function halamanLogin() {
        $this->load->view('welcome_message');
    }

    function halamanInstrumen() {
        //$this->check_log_in_admin_cssd();
        $this->load->view('instrumen');
    }

    function instrumen() {
        //$this->check_log_in_admin_cssd();
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
        //$this->check_log_in_super_admin();
        $this->load->model('Users');
        $data['data_user'] = $this->Users->panggil_data_user();
        $this->load->view('tambah_user', $data);
    }

    function edit_user() {
        //$this->check_log_in_super_admin();
        $this->load->model('Users');
        $username = $_POST["id"];
        $data['edit_user'] = $this->Users->panggil_data_user_by_id($username);
        $this->load->view('edit_user', $data);
    }

    function hapus_user() {
        //$this->check_log_in_super_admin();
        $this->load->model('Users');
        $username = $_GET["id"];
        $data['hapus_user'] = $this->Users->panggil_data_user_by_id($username);
        $this->load->view('hapus_user_konfirmasi', $data);
    }

    function peminjaman() {
        //$this->check_log_in_to_peminjaman();
        $this->load->view('peminjaman');
    }

    function tambah_peminjaman() {
        //$this->check_log_in_to_peminjaman();
        $this->load->model('Instrument');
        $this->load->model('Setting_Set');
        $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
        $data['set'] = $this->Setting_Set->panggil_set();
        //hilangkan session sudah pinjam. agar bisa minjam
        $this->session->unset_userdata('sudah_pinjam');
        $this->load->view('tambah_peminjaman', $data);
    }

    function cek_peminjaman() {
        //$this->check_log_in_admin_cssd();
        $this->load->view('cek_peminjaman');
    }

    function konfirmasi_pegawai() {
        //$this->check_log_in_admin_cssd();
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        $data['peminjam'] = $this->Peminjaman->panggil_peminjam();
        $this->load->view('konfirmasi_pegawai', $data);
    }

    function lihat_peminjaman() {
        //$this->check_log_in_admin_cssd();
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();

        $tgl = date('d/m/Y');
        $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($tgl);
        $data['tanggal'] = $tgl;
        $this->load->view('lihat_peminjaman', $data);
    }

    function lihat_peminjamanan_detail() {
        //$this->check_log_in_to_peminjaman();
        $this->load->model('Peminjaman');
        $this->load->model('Users');
        //panggil tgl
        $id = $_POST['id'];
        $transaksi = $_POST['transaksi'];
        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman_detail($transaksi);
        //manggil data peminjam
        $query = $this->Users->panggil_data_user_by_id($id);
        $data['peminjam'] = $query;
        //manggil data tanggal pinjam
        $tanggal;
        foreach ($data['pinjam_instrumen'] as $r):
            $tanggal = $r->tanggal_pinjam;
        endforeach;
        $data['id_transaksi'] = $transaksi;
        //panggil view
        $this->load->view('lihat_peminjaman_detail', $data);
    }

    function lihat_pinjaman_status() {
        //$this->check_log_in_admin_cssd();
        $this->load->model('Peminjaman');
        //panggil tgl
        $status = $_GET['statusApprove'];
        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman_status($status);
        $data['pinjam_instrumen_belum_kembali'] = $this->Peminjaman->lihat_peminjaman_belum_kembali();
        //manggil data peminjam
        $data['statusApprove'] = $status;
        $this->load->model('Users');
        $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
        //manggil data tanggal pinjam
        //panggil view
        $this->load->view('lihat_peminjaman_status', $data);
    }

    function riwayat_pinjam() {
        //$this->check_log_in_to_peminjaman();
        $this->load->model('Peminjaman');
        //panggil tgl
        $cari = $_SESSION['username'];

        //masukkan tanggal sebagai pencarian peminjaman
        $data['pinjam_instrumen'] = $this->Peminjaman->lihat_peminjaman($cari);
        $this->load->model('Users');
        $data['peminjam'] = $this->Users->panggil_data_user_by_id($cari);
        //panggil view
        $this->load->view('riwayat_pinjam', $data);
    }

    function laporan() {
        //$this->check_log_in_admin_cssd();
        $this->load->view('laporan');
    }

    function perbarui_instrument() {
        //$this->check_log_in_admin_cssd();
        $this->load->model('Instrument');
        $data['instrumen'] = $this->Instrument->cari_data_instrument('');
        $this->load->view('perbarui_instrument', $data);
    }

    function tambah_instrument() {
        //$this->check_log_in_admin_cssd();
        $this->load->view('tambah_instrument');
    }

    function hapus_instrument() {
        //$this->check_log_in_admin_cssd();
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_data_instrument();
        $this->load->view('hapus_instrument', $data);
    }

    function tambah_setting_set() {
        //$this->check_log_in_admin_cssd();
        $this->load->model('Instrument');
        $data['ada_instrumen'] = $this->Instrument->panggil_data_instrument();
        $this->load->view('tambah_setting_set', $data);
    }

    function tambah_pemijaman() {
        ////$this->check_log_in_to_peminjaman();
        $this->load->view('tambah_pemijam');
    }

    function tambah_peminjam() {
        //$this->check_log_in_admin_cssd();
        $this->load->view('tambah_peminjam');
    }

    function pengembalian() {
        //$this->check_log_in_admin_cssd();
        $this->session->unset_userdata('konfirmasi');
        $this->load->view('pengembalian');
    }

    function konfirmasi_pengembalian_trouble() {
        //$this->check_log_in_admin_cssd();
        $this->session->unset_userdata('konfirmasi');
        $this->load->view('konfirmasi_pengembalian_trouble');
    }

    function notifikasi_pengembalian() {
        //$this->check_log_in_admin_cssd();
        $this->load->view('notifikasi_pengembalian');
    }

}
