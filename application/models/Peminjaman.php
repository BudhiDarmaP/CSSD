<?php

/**
 * Description of Peminjaman
 *
 * @author budhidarmap
 */
class Peminjaman extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function pinjam($id_peminjam, $id_instrumen, $jumlah, $tgl_pinjam, $tgl_kembali) {
        //cek ketersedian barang
        $select = "SELECT * FROM `instrumen` WHERE id_instrumen='$id_instrumen' AND steril>=$jumlah";
        $cek = $this->db->query($select);
        //jika lebih dari permintaan
        if ($cek->num_rows() > 0) {
            //input peminjaman
            $insert = "INSERT INTO `peminjaman`"
                    . "(`id_peminjam`, "
                    . "`id_instrumen`, "
                    . "`jumlah_pinjam`, "
                    . "`tanggal_pinjam`, "
                    . "`tanggal_kembali`, "
                    . "`status_peminjaman`) "
                    . "VALUES "
                    . "('$id_peminjam',"
                    . "'$id_instrumen', "
                    . "$jumlah, "
                    . "STR_TO_DATE('$tgl_pinjam', '%m/%d/%Y'), "
                    . "STR_TO_DATE('$tgl_kembali', '%m/%d/%Y'), "
                    . "0)";
            $this->db->query($insert);
            
            //panggil data peminjaman
            $select2 = "SELECT * FROM `peminjaman`"
                    . "WHERE (id_peminjam = '$id_peminjam' AND id_instrumen='$id_instrumen' "
                    . "AND tanggal_pinjam=STR_TO_DATE('$tgl_pinjam', '%m/%d/%Y') "
                    . "AND tanggal_kembali=STR_TO_DATE('$tgl_kembali', '%m/%d/%Y') "
                    . "AND jumlah_pinjam=$jumlah AND status_peminjaman=0)";
            $hasil = $this->db->query($select2);
            return $hasil->result();
        } else {
            return NULL;
        }
    }

    function panggil_pinjam($user, $id_inst, $jumlah, $tgl_pinjam, $tgl_kembali) {
        if ($user == NULL || $id_inst == NULL) {
            $q = "SELECT * FROM `peminjaman` WHERE status_peminjaman=0";
            $data = $this->db->query($q);
            return $data->result();
        }
    }
}