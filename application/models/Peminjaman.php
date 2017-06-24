<?php

/**
 * Description of Peminjaman
 *
 * @author budhidarmap
 */
class Peminjaman extends CI_Model{
    function pinjam($id_peminjam, $id_instrumen, $jumlah, $tgl_pinjam, $tgl_kembali){
        //cek ketersedian barang
        $q = "SELECT * FROM `instrumen` WHERE nama_instrumen='$id_instrumen' AND steril>'$jumlah'";
        $cek = $this->db->query($q);
        //jika lebih dari permintaan
        if ($cek->num_rows()> 0) {
            //input peminjaman
            $q = "INSERT INTO `peminjaman`"
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
            $this->db->query($q);
            $this->db->commit();
            
            //panggil data peminjaman
            $q = "SELECT * FROM `peminjaman`"
                    . "WHERE id_user = '$id_peminjam' AND id_instrumen='$id_instrumen' "
                    . "AND tanggal_pinjam='$tgl_pinjam' AND tanggal_kembali='$tgl_kembali'"
                    . "AND jumlah='$jumlah' AND status_peminjaman=0";
            $data = $this->db->query($q);
            return $data->result();
        } else {
            return NULL;
        }
    }
}
