<?php
/**
 * Description of Setting_Set
 *
 * @author budhidarmap
 */
class Setting_Set extends CI_Model{
    function panggil_set(){
        $result = $this->db->query("SELECT nama_set, id_set FROM SETTING_SET GROUP BY nama_set");
        return $result->result();
    }
    function panggil_isi_set(){
        $result = $this->db->query("SELECT a.*, b.nama_instrumen, b.steril FROM SETTING_SET a "
                . "JOIN INSTRUMEN b ON (a.id_instrumen = b.id_instrumen)");
        return $result->result();
    }
    function panggil_set_nama($nama){
        $result = $this->db->query("SELECT a.*, b.nama_instrumen FROM SETTING_SET a "
                . "JOIN INSTRUMEN b ON (a.id_instrumen = b.id_instrumen) "
                . "WHERE nama_set='$nama'");
        return $result->result();
    }
    function panggil_set_id($id, $jumlah){
        $result = $this->db->query("SELECT a.id_set, a.id_instrumen, a.nama_set, "
                . "b.nama_instrumen, b.steril, (a.jumlah*$jumlah) jumlah "
                . "FROM SETTING_SET a "
                . "JOIN INSTRUMEN b ON (a.id_instrumen = b.id_instrumen) "
                . "WHERE id_set='$id'");
        return $result->result();
    }
    function panggil_id_instrumen($id){
        $result = $this->db->query("SELECT id_instrumen FROM SETTING_SET "
                . "WHERE id_set='$id'");
        return $result->result();
    }
    function panggil_nama($id){
        $result = $this->db->query("SELECT nama_set FROM SETTING_SET "
                . "WHERE id_set='$id' GROUP BY nama_set");
        return $result->row();
    }
}
