<?php
/**
 * Description of User
 *
 * @author budhidarmap
 */
class users extends CI_Model {

    function panggil_data_user() {
        $q = $this->db->query("SELECT * FROM `user` WHERE id_user != 'admin' ");
        return $q->result;
    }

    function panggil_data_pegawai() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 1");
        return $q->result;
    }

    function panggil_data_internal() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 2");
        return $q->result;
    }

    function panggil_data_eksternal() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 3");
        return $q->result;
    }

    function panggil_data_peminjam() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 2 AND STATUS_USER = 3");
        return $q->result;
    }

    function panggil_jumlah_pegawai() {
        $q = $this->db->query("SELECT COUNT(*) FROM user WHERE STATUS_USER = 1");
        return $q->result;
    }

    function panggil_jumlah_internal() {
        $q = $this->db->query("SELECT COUNT(*) FROM user WHERE STATUS_USER = 2");
        return $q->result;
    }

    function panggil_jumlah_eksternal() {
        $q = $this->db->query("SELECT COUNT(*) FROM user WHERE STATUS_USER = 3");
        return $q->result;
    }

    function tambah_data_pegawai($nama_instansi, $password, $no_tlp) {
        $jumlah = $this->panggil_jumlah_pegawai();
        $id = 'CSSD' + $jumlah;
        $q = $this->db->query("INSERT INTO `user`(`id_user`, `nama_user`, `password`, `no_telepon`, `status_user`) "
                . "VALUES ('$id','$nama_instansi','$password','$no_tlp',1)");
        return $q->result;
    }

    function tambah_data_internal($nama_instansi, $password, $no_tlp) {
        $jumlah = $this->panggil_jumlah_pegawai();
        $id = 'INT' + $jumlah;
        $q = $this->db->query("INSERT INTO `user`(`id_user`, `nama_user`, `password`, `no_telepon`, `status_user`) "
                . "VALUES ('$id ','$nama_instansi','$password','$no_tlp',2)");
        return $q->result;
    }

    function tambah_data_eksternal($nama_instansi, $password, $no_tlp) {
        $jumlah = $this->panggil_jumlah_pegawai();
        $id = 'EKS' + $jumlah;
        $q = $this->db->query("INSERT INTO `user`(`id_user`, `nama_user`, `password`, `no_telepon`, `status_user`) "
                . "VALUES ('$id','$nama_instansi','$password','$no_tlp',3)");
        return $q->result;
    }

    function hapus_data_pegawai($user_name) {
        $q = $this->db->query("DELETE FROM `user` WHERE nama_user = '$user_name' AND status_user = 1");
        return $q->result;
    }

    function hapus_data_internal($user_name) {
        $q = $this->db->query("DELETE FROM `user` WHERE nama_user = '$user_name' AND status_user = 2");
        return $q->result;
    }

    function hapus_data_eksternal($user_name) {
        $q = $this->db->query("DELETE FROM `user` WHERE nama_user = '$user_name' AND status_user = 3");
        return $q->result;
    }
    public function login($username, $password) {
        if (strpos($username, 'CS') !== FALSE) {

            $sql = "SELECT * FROM user WHERE id_user = '$username'";
            $result = $this->db->query($sql);
            
            if ($result->num_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}
