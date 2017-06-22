<?php
/**
 * Description of User
 *
 * @author budhidarmap
 */
class Instrument extends CI_Model {
   
    function panggil_semua_data_instrument() {
        $q = $this->db->query("SELECT * FROM `instrument`");
        return $q->result;
    }
    function panggil_data_instrument() {
        $q = $this->db->query("SELECT * FROM `instrument` WHERE STERIL > 0");
        return $q->result;
    }
    function cari_data_instrument($key) {
        $q = $this->db->query("SELECT * FROM `instrument` "
                . "WHERE (ID_INSTRUMEN ='$key' AND NAMA_INSTRUMEN = '$key') AND"
                . "STERIL > 0");
        return $q->result;
    }
    function panggil_data_jumlah() {
        $q = $this->db->query("SELECT * FROM `instrument` WHERE STERIL > 0");
        return $q->result;
    }
}
