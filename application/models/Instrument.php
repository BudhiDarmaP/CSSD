<?php

/**
 * Description of User
 *
 * @author budhidarmap
 */
class Instrument extends CI_Model {

    public function panggil_semua_data_instrument() {
        $result = $this->db->query("SELECT * FROM instrumen where jumlah > 0");
        return $result->result();
    }

    function panggil_data_instrument() {
        $q = $this->db->query("SELECT * FROM instrumen WHERE STERIL > 0");
        return $q->result;
    }

    function panggil_jumlah_instrument_sejenis($key) {
        $q = $this->db->query("SELECT * FROM INSTRUMEN WHERE ID_INSTRUMEN LIKE '$key%'");
//        $row[] = $q->row();
        return $q->num_rows();
    }

    function cari_data_instrument($key) {
        $q = $this->db->query("SELECT * FROM `instrumen` "
                . "WHERE (ID_INSTRUMEN like '%$key%' OR NAMA_INSTRUMEN like '%$key%') AND "
                . "STERIL > 0");
        return $q->result();
    }

    function panggil_data_jumlah() {
        $q = $this->db->query("SELECT * FROM `instrument` WHERE STERIL > 0");
        return $q->result;
    }

    function tambah_data_instrument($nama, $jumlah) {
        //cek keadaan barang
        $q = "SELECT * FROM `instrumen` WHERE nama_instrumen='$nama'";
        $cek = $this->db->query($q);
        //generate id
        if ($cek->num_rows() == 0) {
            $key = strtoupper(substr($nama, 0, 3));
            $jumlah2 = $this->panggil_jumlah_instrument_sejenis($key);
//            $jumlahInstrumen = $jumlah2;
            $id = '0';
            if ($jumlah2 < 10) {
                $id = $key . '0' . $jumlah2;
            } else {
                $id = $key . $jumlah2;
            }
            //input user
            $q = "INSERT INTO `instrumen`(`id_instrumen`, `nama_instrumen`, `jumlah`, `steril`) "
                    . "VALUES ('$id','$nama',$jumlah,$jumlah)";
            $this->db->query($q);
//            $this->db->query("commit");

            $q = "SELECT * FROM `instrumen` WHERE id_instrumen = '$id'";
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

    function hapus_instrumen($id) {
        foreach ($id as $index){
            $this->db->query("UPDATE `instrumen` set jumlah = 0, steril = 0 where id_instrumen = '$index'");
        }
        return TRUE;
    }

}
