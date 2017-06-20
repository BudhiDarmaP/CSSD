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
    private $no_telp;
    private $status;

    public function tambah_user($nama_instansi, $no_tlp, $status) {
        $new_user_insert_data = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'no_tlp' => $this->input->post('no_tlp'),
            'status' => $this->input->post('status'),
        );
    }
    public function edit_user($nama_instansi, $no_tlp, $status) {
        $new_user_insert_data = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'no_tlp' => $this->input->post('no_tlp'),
            'status' => $this->input->post('status'),
        );
    }
    public function hapus_user($nama_instansi, $no_tlp, $status) {
        $new_user_insert_data = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'no_tlp' => $this->input->post('no_tlp'),
            'status' => $this->input->post('status'),
        );
    }
}
