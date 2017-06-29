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

    function pinjam_pegawai($trans, $id_pem, $id_ins, $jum, $steril, $tgl_pin, $tgl_kem, $status) {
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
    function pinjam_user($trans, $id_pem, $id_ins, $jum, $tgl_pin, $status) {
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
                    . "`status_peminjaman`) "
                    . "VALUES "
                    . "('$trans',"
                    . "'$id_pem',"
                    . "'$id_ins', "
                    . "$jum, "
                    . "STR_TO_DATE('$tgl_pin', '%m/%d/%Y'), "
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
    function lihat_peminjaman($tgl){
        $select = "SELECT a.*, b.nama_instrumen FROM peminjaman a JOIN instrumen b "
                . "on (a.id_instrumen = b.id_instrumen) "
                . "WHERE a.tanggal_pinjam = STR_TO_DATE('$tgl', '%m/%d/%Y')";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }
    function panggil_peminjam(){
        $select = "SELECT a.id_transaksi, a.id_peminjam, b.nama_user, a.tanggal_pinjam "
                . "FROM peminjaman a join user b on (a.id_peminjam = b.id_user) "
                . "WHERE a.status_peminjaman = 0 "
                . "GROUP BY a.id_transaksi ORDER BY a.tanggal_pinjam";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }
    function panggil_peminjam_id($id){
        $select = "SELECT a.id_transaksi, a.id_peminjam, b.nama_user, a.tanggal_pinjam "
                . "FROM peminjaman a join user b on (a.id_peminjam = b.id_user) "
                . "WHERE a.status_peminjaman=0 AND id_peminjam='$id' "
                . "GROUP BY a.id_transaksi ORDER BY a.tanggal_pinjam";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }
    function panggil_konfirmasi_id($id, $transaksi){
        $select = "SELECT a.*, b.nama_instrumen, b.steril, c.nama_user FROM peminjaman a "
                . "JOIN instrumen b on (a.id_instrumen= b.id_instrumen) "
                . "JOIN user c on (a.id_peminjam = c.id_user) "
                . "WHERE a.status_peminjaman=0 AND id_peminjam='$id' AND id_transaksi='$transaksi'"
                . "GROUP BY a.id_peminjam ORDER BY a.tanggal_pinjam";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }
    function konfirmasi_update($id, $inst, $jumlah, $steril, $tgl_kembali){
        //kurangkan nilai steril dengan jumlah pinjam
        $val1=  intval($steril);
        $val2=  intval($jumlah);
        $total=$val1-$val2;
        //update jumlah steril
        $update_instrumen="UPDATE INSTRUMEN SET STERIL=$total WHERE ID_INSTRUMEN='$inst' AND STERIL>=$val2";
        $this->db->query($update_instrumen);
        
        $update_instrumen="UPDATE PEMINJAMAN SET JUMLAH_PINJAM=$jumlah, STATUS_PEMINJAMAN=1 , "
                . "TANGGAL_KEMBALI=STR_TO_DATE('$tgl_kembali', '%m/%d/%Y')"
                . "WHERE (ID_TRANSAKSI='$id' AND ID_INSTRUMEN='$inst')";
        $this->db->query($update_instrumen);
        return TRUE;
    }

}
