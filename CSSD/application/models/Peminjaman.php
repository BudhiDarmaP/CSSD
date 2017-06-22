<?php

/**
 * Description of Peminjaman
 *
 * @author budhidarmap
 */
class Peminjaman {
    function lihat_peminjaman(){
        $q = $this->db->query("SELECT * FROM `peminjaman` WHERE `status_peminjaman` = 0");
        return $q;
    }
    function ubah_status_peminjaman($id, $tanggal_pinjam){
        $q = $this->db->query("UPDATE `peminjaman` SET `status_peminjaman` = 1 "
                . "WHERE `id_user`='$id' AND `tangggal_pinjam`='$tanggal_pinjam'");
        return $q;
    }
    function print_pdf(){
        $pdf = new PDF();
        
    }
}