<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserControl extends CI_Controller {

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

    function ubahPassword() {
        $username = $_GET["username"];
        $newpassword = $_GET["newpassword"];

        $this->load->model('Users');

        if (isset($_GET["status"])) {
            $status = $_GET["status"];
            if ($status == 1) {
                $query = $this->Users->ubah_password_super($username, $newpassword);
            } else {
                $oldpassword = $_GET["oldpassword"];
                $confirmpassword = $_GET["confirmpassword"];
                $query = $this->Users->ubah_password($username, $oldpassword, $newpassword, $confirmpassword);
            }
        }

        if ($query) {
            $data = array(
                'password' => $newpassword,
                'ubah_password' => true
            );

            $this->session->set_userdata($data);
            $this->load->view('ubah_password');
        } else {

            $data = array(
                'ubah_password' => false
            );
            $this->session->set_userdata($data);
            $this->load->view('ubah_password');
        }
    }

    function tambahUser() {
        $namauser = $_GET["nama_user"];
        $notelp = $_GET["no_telp"];
        $statususer = $_GET["status_user"];

        $password_bantu = strtolower(substr($namauser, 0, 4));
        $password = $password_bantu . $password_bantu;

        if ($statususer == 3) {
            $password = '';
        }

        $this->load->model('Users');
        $query = $this->Users->tambah_data_pegawai($namauser, $password, $notelp, $statususer);

        $data;
        if ($query) {
            $data = array(
                'tambah_user' => true
            );
        } else {
            $data = array(
                'tambah_user' => FALSE
            );
        }
        $this->session->set_userdata($data);
        if ($statususer == 3) {
            $this->load->view('tambah_peminjam');
        } else {
            $data['data_user'] = $this->Users->panggil_data_user();
            $this->load->view('tambah_user', $data);
        }
    }

    function editUser() {
        $this->load->model('Users');
        $namauser = $_GET["nama_user"];
        $notelp = $_GET["no_telp"];
        $username = $_GET["id_user"];

        $ubah = $this->Users->edit_data_user($username, $namauser, $notelp);

        $data;
        if ($ubah) {
            $data = array(
                'nama_user_edit' => $namauser,
                'id_user_edit' => $username,
                'edit_user' => true
            );
        } else {
            $data = array(
                'nama_user_edit' => $namauser,
                'id_user_edit' => $username,
                'edit_user' => FALSE
            );
        }
        $this->session->set_userdata($data);
        redirect(base_url('site/tambah_user'));
    }
    
    function hapusUser() {
        $this->load->model('Users');
        $username = $_GET["id_user"];

        $ubah = $this->Users->hapus_data_pegawai($username);

        $data;
        if ($ubah) {
            $data = array(
                'nama_user_edit' => $namauser,
                'id_user_edit' => $username,
                'edit_user' => true
            );
        } else {
            $data = array(
                'nama_user_edit' => $namauser,
                'id_user_edit' => $username,
                'edit_user' => FALSE
            );
        }
        $this->session->set_userdata($data);
        redirect(base_url('site/tambah_user'));
    }

}

?>
