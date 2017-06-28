<?php

/**
 * Description of User
 *
 * @author budhidarmap
 */
class Users extends CI_Model {

    function panggil_data_user() {
        $q = $this->db->query("SELECT * FROM `user` WHERE id_user != 'admin' ");
        return $q;
    }

    function panggil_data_pegawai() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 1");
        return $q->num_rows();
        ;
    }

    function panggil_data_internal() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 2");
        return $q->num_rows();
        ;
    }

    function panggil_data_eksternal() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 3");
        return $q->num_rows();
        ;
    }

    function panggil_data_peminjam() {
        $q = $this->db->query("SELECT * FROM `user` WHERE STATUS_USER = 2 AND STATUS_USER = 3");
        return $q;
    }

    function panggil_jumlah_pegawai() {
        $q = $this->db->query("SELECT COUNT(*) FROM user WHERE STATUS_USER = 1");
        return $q->num_rows();
        ;
    }

    function panggil_jumlah_internal() {
        $q = $this->db->query("SELECT COUNT(*) FROM user WHERE STATUS_USER = 2");
        return $q->num_rows();
        ;
    }

    function panggil_jumlah_eksternal() {
        $q = $this->db->query("SELECT COUNT(*) FROM user WHERE STATUS_USER = 3");
        return $q->num_rows();
        ;
    }

    function tambah_data_pegawai($nama_instansi, $password, $no_tlp) {
        //generate id
        $jumlah = $this->panggil_jumlah_pegawai();
        $id = 'CSSD' + $jumlah;
        //input user
        $q = "INSERT INTO `user`(`id_user`, `nama_user`, `password`, `no_telepon`, `status_user`) "
                . "VALUES ('$id','$nama_instansi','$password','$no_tlp',1)";
        $this->db->query($q);

        $q = "SELECT * FROM user WHERE id_user = '$id'";
        $cek = $this->db->query($q);
        //jika berhasil
        if ($cek->num_rows() == 1) {
            return TRUE;
            //jika tidak berhasil
        } else {
            return FALSE;
        }
    }

    function tambah_data_internal($nama_instansi, $password, $no_tlp) {
        //generate id
        $jumlah = $this->panggil_jumlah_internal();
        if ($jumlah < 10) {
            $id = 'I0' . $jumlah;
        } else {
            $id = 'I' . $jumlah;
        }
        //input user
        $q = "INSERT INTO `user`(`id_user`, `nama_user`, `password`, `no_telepon`, `status_user`) "
                . "VALUES ('$id','$nama_instansi','$password','$no_tlp',2)";
        $this->db->query($q);

        $q = "SELECT * FROM user WHERE id_user = '$id'";
        $cek = $this->db->query($q);
        //jika berhasil
        if ($cek->num_rows() == 1) {
            return TRUE;
            //jika tidak berhasil
        } else {
            return FALSE;
        }
    }

    function tambah_data_eksternal($nama_instansi, $password, $no_tlp) {
        $q = "SELECT * FROM user WHERE `nama_user` = '$nama_instansi'";
        $cek = $this->db->query($q);
        //generate id
        if ($cek->num_rows() == 0) {
            $jumlah = $this->panggil_jumlah_eksternal();
            if ($jumlah < 1) {
                $id = 'E00';
            } else if ($jumlah > 0 && $jumlah < 10) {
                $id = 'E0' . $jumlah;
            } else {
                $id = 'E' . $jumlah;
            }

            //input user
            $q = "INSERT INTO `user`(`id_user`, `nama_user`, `password`, `no_telepon`, `status_user`) "
                    . "VALUES ('$id','$nama_instansi','$password','$no_tlp',3)";
            $this->db->query($q);

            $q = "SELECT * FROM user WHERE `id_user` = '$id'";
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

    public function ubah_password($username, $oldpassword, $newpassword, $confirmpassword) {
        //update password
        if ($newpassword == $confirmpassword) {
            $validasi = $this->login($username, $oldpassword);
            if ($validasi != null) {
                $query = "UPDATE `user` SET `password`='$newpassword' WHERE `id_user`='$username' AND `status_user` != 0";
                $this->db->query($query);
                //cek
                $q = "SELECT * FROM user WHERE id_user = '$username' AND password = '$newpassword'";
                $cek = $this->db->query($q);
                //jika berhasil
                if ($cek->num_rows() == 1) {
                    $this->db->query("commit");
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function hapus_data_pegawai($username) {
        //cek user
        $q = "SELECT * FROM user WHERE id_user = '$username'";
        $cek = $this->db->query($q);
        //jika user ada
        if ($cek->num_rows() == 1) {
            //delete user
            $sql = "DELETE FROM `user` WHERE nama_user = '$username' AND status_user = 1";
            $this->db->query($sql);
            //cek user berhasil di delete?
            $q = "SELECT * FROM user WHERE id_user = '$username'";
            $cek = $this->db->query($q);
            //jika 0
            if ($cek->num_rows() == 0) {
                return TRUE;
                //jika masih
            } else {
                return FALSE;
            }
            //jika user tidak ada
        } else {
            return FALSE;
        }
    }

    function hapus_data_internal($username) {
        //cek user
        $q = "SELECT * FROM user WHERE id_user = '$username'";
        $cek = $this->db->query($q);
        //jika user ada
        if ($cek->num_rows() == 1) {
            //delete user
            $sql = "DELETE FROM `user` WHERE nama_user = '$username' AND status_user = 2";
            $this->db->query($sql);
            //cek user berhasil di delete?
            $q = "SELECT * FROM user WHERE id_user = '$username'";
            $cek = $this->db->query($q);
            //jika 0
            if ($cek->num_rows() == 0) {
                return TRUE;
                //jika masih
            } else {
                return FALSE;
            }
            //jika user tidak ada
        } else {
            return FALSE;
        }
    }

    function hapus_data_eksternal($username) {
        //cek user
        $q = "SELECT * FROM user WHERE id_user = '$username'";
        $cek = $this->db->query($q);
        //jika user ada
        if ($cek->num_rows() == 1) {
            //delete user
            $sql = "DELETE FROM `user` WHERE nama_user = '$username' AND status_user = 3";
            $this->db->query($sql);
            //cek user berhasil di delete?
            $q = "SELECT * FROM user WHERE id_user = '$username'";
            $cek = $this->db->query($q);
            //jika 0
            if ($cek->num_rows() == 0) {
                return TRUE;
                //jika masih
            } else {
                return FALSE;
            }
            //jika user tidak ada
        } else {
            return FALSE;
        }
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM user WHERE id_user = '$username' and password = '$password'";
        $result = $this->db->query($sql);

        if ($result->num_rows() == 1) {
            return $result->row();
        } else {
            return null;
        }
    }

}
