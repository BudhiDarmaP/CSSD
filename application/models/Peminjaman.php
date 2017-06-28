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

    function pinjam($trans, $id_pem, $id_ins, $jum, $tgl_pin, $tgl_kem, $status) {
        //cek ketersedian barang
        $select = "SELECT * FROM `instrumen` WHERE id_instrumen='$id_ins' AND steril>=$jum";
        $cek = $this->db->query($select);
        //jika lebih dari permintaan
        if ($cek->num_rows() > 0) {
            //input peminjaman
            $insert = "INSERT INTO `peminjaman`"
                    . "(`id_transaksi`,"
                    . "`id_peminjam`, "
                    . "`id_instrumen`, "
                    . "`jumlah_pinjam`, "
                    . "`tanggal_pinjam`, "
                    . "`tanggal_kembali`, "
                    . "`status_peminjaman`) "
                    . "VALUES "
                    . "('$trans',"
                    . "'$id_pem',"
                    . "'$id_ins', "
                    . "$jum, "
                    . "STR_TO_DATE('$tgl_pin', '%m/%d/%Y'), "
                    . "STR_TO_DATE('$tgl_kem', '%m/%d/%Y'), "
                    . "$status)";
            $this->db->query($insert);
            return TRUE;
        } else {
            return NULL;
        }
    }

    function panggil_pinjam($id_transaksi) {
            $select = "SELECT a.*, b.nama_instrumen FROM peminjaman a JOIN instrumen b "
                    . "on (a.id_instrumen = b.id_instrumen) "
                    . "WHERE a.id_transaksi = '$id_transaksi'";
            $hasil = $this->db->query($select);
            return $hasil->result();
        }
}