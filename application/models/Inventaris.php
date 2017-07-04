<?php

/**
 * Description of User
 *
 * @author budhidarmap
 */
class Inventaris extends CI_Model {

    public function panggil_semua_data_inventaris_instrumen() {
        $query = "select dayname(a.tanggal) AS 'hari', DATE_FORMAT(a.tanggal, '%d-%M-%Y %H:%i:%s') AS 'tanggal', "
                . "c.nama_user, a.keterangan, b.nama_instrumen "
                . "from inventaris a join instrumen b on (a.id_instrumen = b.id_instrumen) "
                . "join user c on (a.id_user = c.id_user) "
                . "where DATE_FORMAT(a.tanggal, '%d-%M-%Y') = DATE_FORMAT(sysdate(), '%d-%M-%Y') "
                . "order by tanggal desc";
        $result = $this->db->query($query);
        return $result->result();
    }
    
    public function panggil_semua_data_inventaris_peminjaman() {
        $query = "select dayname(a.waktu_approve) AS 'hari', DATE_FORMAT(a.waktu_approve, '%d-%M-%Y %H:%i:%s') AS 'tanggal', "
                . "b.nama_user, a.id_transaksi, c.nama_user AS 'peminjam'"
                . "from peminjaman a join user b on (a.id_cssd = b.id_user) "
                . "join user c on (a.id_peminjam = c.id_user) "
                . "where DATE_FORMAT(a.waktu_approve, '%d-%M-%Y') = DATE_FORMAT(sysdate(), '%d-%M-%Y') "
                . "group by a.id_transaksi order by tanggal desc ";
        $result = $this->db->query($query);
        return $result->result();
    }
}
