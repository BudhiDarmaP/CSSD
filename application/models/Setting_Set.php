<?php

/**
 * Description of Setting_Set
 *
 * @author budhidarmap
 */
class Setting_Set extends CI_Model {

    function panggil_set() {
        $result = $this->db->query("SELECT nama_set, id_set FROM SETTING_SET GROUP BY nama_set");
        return $result->result();
    }

    function panggil_isi_set() {
        $result = $this->db->query("SELECT a.*, b.nama_instrumen, b.steril FROM SETTING_SET a "
                . "JOIN INSTRUMEN b ON (a.id_instrumen = b.id_instrumen)");
        return $result->result();
    }

    function panggil_set_nama($nama) {
        $result = $this->db->query("SELECT a.*, b.nama_instrumen FROM SETTING_SET a "
                . "JOIN INSTRUMEN b ON (a.id_instrumen = b.id_instrumen) "
                . "WHERE nama_set='$nama'");
        return $result->result();
    }

    function panggil_set_id($id, $jumlah) {
        $result = $this->db->query("SELECT a.id_set, a.id_instrumen, a.nama_set, "
                . "b.nama_instrumen, b.steril, (a.jumlah*$jumlah) jumlah, b.jumlah AS data "
                . "FROM SETTING_SET a "
                . "JOIN INSTRUMEN b ON (a.id_instrumen = b.id_instrumen) "
                . "WHERE id_set='$id'");
        return $result->result();
    }

    function panggil_id_instrumen($id) {
        $result = $this->db->query("SELECT id_instrumen FROM SETTING_SET "
                . "WHERE id_set='$id'");
        return $result->result();
    }

    function panggil_nama($id) {
        $result = $this->db->query("SELECT nama_set FROM SETTING_SET "
                . "WHERE id_set='$id' GROUP BY nama_set");
        return $result->row();
    }

    function tambah_setting_set($id_set, $nama_setting_set, $id, $jumlah) {
        $this->db->query("INSERT INTO `setting_set` VALUES ('$id_set', '$nama_setting_set', '$id', $jumlah)");
        return true;
    }

    function hapus_setting_set($id) {
        $result = $this->db->query("DELETE FROM `setting_set` WHERE id_set='$id'");
        return true;
    }
    
    function ubah_nama_setting_set($nama, $id) {
        $result = $this->db->query("UPDATE `setting_set` SET nama_set='$nama' WHERE id_set='$id'");
        return true;
    }

    function id_setting_set_otomatis() {
        $result = $this->db->query("select * from setting_set GROUP BY id_set");
        $id_set_otomatis = '';

        $jumlah_max_id = $result->num_rows() + 2;
        if ($jumlah_max_id <= 10) {
            $id_set_otomatis = '00' . $jumlah_max_id;
        } else if ($jumlah_max_id > 9 || $jumlah_max_id <= 100) {
            $id_set_otomatis = '0' . $jumlah_max_id;
        } else {
            $id_set_otomatis = $jumlah_max_id;
        }

        return $id_set_otomatis;
    }

}
