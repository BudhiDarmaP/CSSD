<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserControl extends CI_Controller {

    function __construct() {
        parent::__construct();
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

}

?>
