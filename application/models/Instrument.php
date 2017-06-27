<?php

/**
 * Description of User
 *
 * @author budhidarmap
 */
class Instrument extends CI_Model {

    public function panggil_semua_data_instrument() {
        $result = $this->db->query("SELECT * FROM instrumen");
        return $result->result();
    }

    function panggil_data_instrument() {
        $q = $this->db->query("SELECT * FROM instrumen WHERE STERIL > 0");
        return $q->result;
    }

    function panggil_jumlah_instrument_sejenis($key) {
        $q = $this->db->query("SELECT COUNT(*) FROM INSTRUMEN WHERE ID_INSTRUMEN LIKE '$key%'");
        return $q;
    }

    function cari_data_instrument($key) {
        $q = $this->db->query("SELECT * FROM `instrumen` "
                . "WHERE (ID_INSTRUMEN like '%$key%' OR NAMA_INSTRUMEN like '%$key%') AND "
                . "STERIL > 0");
        return $q->result();
    }

    function panggil_data_id($id) {
            $q = $this->db->query("SELECT * FROM `instrumen` WHERE id_instrumen = '$id'");
            return $q->row();        
    }

    function panggil_data_jumlah() {
        $q = $this->db->query("SELECT * FROM `instrumen` WHERE STERIL > 0");
        return $q->result;
    }

    function tambah_data_instrument($nama, $jumlah, $steril) {
        //cek keadaan barang
        $q = "SELECT * FROM WHERE nama_instrumen='$nama'";
        $cek = $this->db->query($q);
        //generate id
        if ($cek->num_rows() == 0) {
            $key = strtoupper(substr($nama, 0, 2));
            $jumlah = $this->panggil_jumlah_instrument_sejenis($key);
            if ($jumlah < 10) {
                $id = $key + '0' + $jumlah;
            } else {
                $id = $key + $jumlah;
            }
            //input user
            $q = "INSERT INTO `user`(`id_instrumen`, `nama_instrumen`, `jumlah_instrumen`, `steril`) "
                    . "VALUES ('$id','$nama','$jumlah','$steril')";
            $this->db->query($q);
            $this->db->commit();

            $q = "SELECT * FROM WHERE id_user = '$id'";
            $cek = $this->db->query($q);
            //jika berhasil
            if ($cek->num_rows() == 1) {
                return TRUE;
                //jika tidak berhasil
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
