<?php

/**
 * Description of User
 *
 * @author budhidarmap
 */
class Instrument extends CI_Model {

    public function panggil_semua_data_instrument() {
        $result = $this->db->query("SELECT * FROM instrumen where jumlah > 0 and steril > 0");
        return $result->result();
    }

    function panggil_data_instrument() {
        $q = $this->db->query("SELECT * FROM instrumen WHERE jumlah > 0");
        return $q->result();
    }

    function panggil_jumlah_instrument_sejenis($key) {
        $q = $this->db->query("SELECT * FROM INSTRUMEN WHERE ID_INSTRUMEN LIKE '$key%'");
//        $row[] = $q->row();
        return $q->num_rows();
    }

    function cari_data_instrument($key) {
        $q = $this->db->query("SELECT * FROM `instrumen` "
                . "WHERE (ID_INSTRUMEN like '%$key%' OR NAMA_INSTRUMEN like '%$key%') AND "
                . "jumlah > 0");
        return $q->result();
    }

    function cari_data_instrument_peminjaman($key) {
        $q = $this->db->query("SELECT * FROM `instrumen` "
                . "WHERE (ID_INSTRUMEN like '%$key%' OR NAMA_INSTRUMEN like '%$key%') AND "
                . "STERIL > 0");
        return $q->result();
    }

    function panggil_data_id($id) {
        $q = $this->db->query("SELECT * FROM `instrumen` WHERE id_instrumen = '$id'");
        return $q->row();
    }

    function panggil_data_steril($id) {
        $q = $this->db->query("SELECT STERIL FROM `instrumen` WHERE id_instrumen = '$id'");
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
                $user = $_SESSION['username'];
                $tambahInventaris = $this->inventaris_tambah_barang($id, $user, $jumlah);
                if ($tambahInventaris) {
                    return TRUE;
                } else {
                    return FALSE;
                }
                //jika tidak berhasil
            } else {
                return FALSE;
            }
        } else if ($cek->row()->jumlah == 0) {
            $q = "UPDATE `instrumen` set `jumlah` = $jumlah, `steril` = $jumlah where `nama_instrumen` = '$nama'";
            $this->db->query($q);

            $q = "SELECT * FROM `instrumen` WHERE nama_instrumen = '$nama'";
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
        $user = $_SESSION['username'];
        foreach ($id as $index) {
            $this->db->query("UPDATE `instrumen` set jumlah = 0, steril = 0 where id_instrumen = '$index'");
            $this->inventaris_hapus_barang($index, $user);
        }
        return TRUE;
    }

    function tambah_stok_instrumen($id, $jumlah, $id_cssd) {
        $this->db->query("UPDATE `instrumen` set jumlah = jumlah + $jumlah where id_instrumen = '$id'");
        $this->inventaris_tambah_stok_barang($id, $id_cssd, $jumlah);
        return TRUE;
    }
    function tambah_stok_steril_instrumen($id, $jumlah, $id_cssd) {
        $this->db->query("UPDATE `instrumen` set steril = steril + $jumlah where id_instrumen = '$id'");
        $this->inventaris_tambah_stok_steril_barang($id, $id_cssd, $jumlah);
        return TRUE;
    }

    function panggil_jumlah_nomor_inventaris() {
        $q = $this->db->query("SELECT * FROM INVENTARIS");
        return $q->num_rows();
    }

    function inventaris_tambah_barang($id_instrumen, $id_user, $jumlah) {
        $nomor_riwayat = 'INVT';
        $setNomor = $this->panggil_jumlah_nomor_inventaris() + 1;

        if ($setNomor < 10) {
            $nomor_riwayat = $nomor_riwayat . '000' . $setNomor;
        } else if ($setNomor > 9 || $setNomor < 100) {
            $nomor_riwayat = $nomor_riwayat . '00' . $setNomor;
        } else if ($setNomor > 99 || $setNomor < 1000) {
            $nomor_riwayat = $nomor_riwayat . '0' . $setNomor;
        } else {
            $nomor_riwayat = $nomor_riwayat . $setNomor;
        }

        $q = $this->db->query("INSERT INTO `inventaris` VALUES ('$nomor_riwayat','$id_instrumen','$id_user','Menambah Sejumlah $jumlah', sysdate())");

        $test = $this->db->query("select * from inventaris where nomor_riwayat = '$nomor_riwayat'");
        if ($test->num_rows() > 0) {
            return true;
        } else {
            return FALSE;
        }
    }

    function inventaris_tambah_stok_barang($id_instrumen, $id_user, $jumlah) {
        $nomor_riwayat = 'INVT';
        $setNomor = $this->panggil_jumlah_nomor_inventaris() + 1;

        if ($setNomor < 10) {
            $nomor_riwayat = $nomor_riwayat . '000' . $setNomor;
        } else if ($setNomor > 9 || $setNomor < 100) {
            $nomor_riwayat = $nomor_riwayat . '00' . $setNomor;
        } else if ($setNomor > 99 || $setNomor < 1000) {
            $nomor_riwayat = $nomor_riwayat . '0' . $setNomor;
        } else {
            $nomor_riwayat = $nomor_riwayat . $setNomor;
        }

        if ($jumlah > 0) {
            $this->db->query("INSERT INTO `inventaris` VALUES ('$nomor_riwayat','$id_instrumen','$id_user','Menambah Stok Sejumlah $jumlah', sysdate())");
        } else {
            $jumlahKurang = substr($jumlah, 1);
            $this->db->query("INSERT INTO `inventaris` VALUES ('$nomor_riwayat','$id_instrumen','$id_user','Mengurangi Stok Sejumlah $jumlahKurang', sysdate())");
        }
        $test = $this->db->query("select * from inventaris where nomor_riwayat = '$nomor_riwayat'");
        if ($test->num_rows() > 0) {
            return true;
        } else {
            return FALSE;
        }
    }

    function inventaris_tambah_stok_steril_barang($id_instrumen, $id_user, $jumlah) {
        $nomor_riwayat = 'INVT';
        $setNomor = $this->panggil_jumlah_nomor_inventaris() + 1;

        if ($setNomor < 10) {
            $nomor_riwayat = $nomor_riwayat . '000' . $setNomor;
        } else if ($setNomor > 9 || $setNomor < 100) {
            $nomor_riwayat = $nomor_riwayat . '00' . $setNomor;
        } else if ($setNomor > 99 || $setNomor < 1000) {
            $nomor_riwayat = $nomor_riwayat . '0' . $setNomor;
        } else {
            $nomor_riwayat = $nomor_riwayat . $setNomor;
        }

        $q = $this->db->query("INSERT INTO `inventaris` VALUES ('$nomor_riwayat','$id_instrumen','$id_user','Menambah Stok Steril Sejumlah $jumlah', sysdate())");

        $test = $this->db->query("select * from inventaris where nomor_riwayat = '$nomor_riwayat'");
        if ($test->num_rows() > 0) {
            return true;
        } else {
            return FALSE;
        }
    }

    function inventaris_hapus_barang($id_instrumen, $id_user) {
        $nomor_riwayat = 'INVT';
        $setNomor = $this->panggil_jumlah_nomor_inventaris() + 1;

        if ($setNomor < 10) {
            $nomor_riwayat = $nomor_riwayat . '000' . $setNomor;
        } else if ($setNomor > 9 || $setNomor < 100) {
            $nomor_riwayat = $nomor_riwayat . '00' . $setNomor;
        } else if ($setNomor > 99 || $setNomor < 1000) {
            $nomor_riwayat = $nomor_riwayat . '0' . $setNomor;
        } else {
            $nomor_riwayat = $nomor_riwayat . $setNomor;
        }

        $q = $this->db->query("INSERT INTO `inventaris` VALUES ('$nomor_riwayat','$id_instrumen','$id_user','Menghapus', sysdate())");

        $test = $this->db->query("select * from inventaris where nomor_riwayat = '$nomor_riwayat'");
        if ($test->num_rows() > 0) {
            return true;
        } else {
            return FALSE;
        }
    }

}
