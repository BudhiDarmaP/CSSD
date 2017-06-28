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
        $oldpassword = $_GET["oldpassword"];
        $newpassword = $_GET["newpassword"];
        $confirmpassword = $_GET["confirmpassword"];

        $this->load->model('Users');
        $query = $this->Users->ubah_password($username, $oldpassword, $newpassword, $confirmpassword);

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
    function tambahEksternal(){
        $nama=$_GET["nama_peminjam"];
        $no_tlp=$_GET["no_telepon"];
        $password=$_GET["password"];
        $this->load->model('Users');
        $query = $this->Users->tambah_data_eksternal($nama, $password, $no_tlp);
        if ($query) {
             $data = array(
                'tambah_eksternal' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('tambah_peminjam');
        } else {
            $data = array(
                'tambah_eksternal' => false
            );
            $this->session->set_userdata($data);
            $this->load->view('tambah_peminjam');
        }
    }
}