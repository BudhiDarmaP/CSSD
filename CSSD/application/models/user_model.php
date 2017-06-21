<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author budhidarmap
 */
class user_model extends CI_Model {

    private $nama_instansi;
    private $password;
    private $no_telp;
    private $status;

    function getNama_instansi() {
        return $this->nama_instansi;
    }

    function getPassword() {
        return $this->password;
    }

    function getNo_telp() {
        return $this->no_telp;
    }

    function getStatus() {
        return $this->status;
    }

    function setNama_instansi($nama_instansi) {
        $this->nama_instansi = $nama_instansi;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNo_telp($no_telp) {
        $this->no_telp = $no_telp;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    public function tambah_user($nama_instansi, $no_tlp, $status) {
        $new_user_insert_data = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'password' => $this->input->post('password'),
            'no_tlp' => $this->input->post('no_tlp'),
            'status' => $this->input->post('status'),
        );
    }

    public function edit_user($nama_instansi, $no_tlp, $status) {
        $new_user_update_data = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'password' => $this->input->post('password'),
            'no_tlp' => $this->input->post('no_tlp'),
            'status' => $this->input->post('status'),
        );
    }

    public function hapus_user($nama_instansi, $no_tlp, $status) {
        $new_user_delete_data = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'password' => $this->input->post('password'),
            'no_tlp' => $this->input->post('no_tlp'),
            'status' => $this->input->post('status'),
        );
    }
    public function lihat_user(){
        $new_user_look_data = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'password' => $this->input->post('password'),
            'no_tlp' => $this->input->post('no_tlp'),
            'status' => $this->input->post('status'),
        );
    }
}
