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

    function pinjam_pegawai($trans, $id_pem, $id_ins, $jum, $steril, $tgl_pin, $tgl_kem, $status, $pegawai_cssd) {
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
                    . "`status_peminjaman`, `id_cssd`, `waktu_approve`) "
                    . "VALUES "
                    . "('$trans',"
                    . "'$id_pem',"
                    . "'$id_ins', "
                    . "$jum, "
                    . "STR_TO_DATE('$tgl_pin', '%m/%d/%Y'), "
                    . "STR_TO_DATE('$tgl_kem', '%m/%d/%Y'), "
                    . "$status, '$pegawai_cssd', sysdate())";
            $this->db->query($insert);
            //kurangkan nilai steril dengan jumlah pinjam
            $total = $steril - $jum;
            //update jumlah steril
            $update_instrumen = "UPDATE INSTRUMEN SET STERIL=$total WHERE ID_INSTRUMEN='$id_ins' AND STERIL>=$jum";
            $this->db->query($update_instrumen);
            $update_instrumen = "UPDATE PEMINJAMAN SET JUMLAH_PINJAM=$jum, STATUS_PEMINJAMAN=1 , "
                    . "TANGGAL_KEMBALI=STR_TO_DATE('$tgl_kem', '%m/%d/%Y')"
                    . "WHERE (ID_TRANSAKSI='$trans 'AND ID_INSTRUMEN='$id_ins')";
            $this->db->query($update_instrumen);
            return TRUE;
        } else {
            return NULL;
        }
    }

    //belum tracking
    function pinjam_set_pegawai($trans, $id_pem, $set, $id_ins, $jum, $steril, $tgl_pin, $tgl_kem, $status, $pegawai_cssd) {
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
                    . "`setting_set`, "
                    . "`jumlah_pinjam`, "
                    . "`tanggal_pinjam`, "
                    . "`tanggal_kembali`, "
                    . "`status_peminjaman`, `id_cssd`, `waktu_approve`) "
                    . "VALUES "
                    . "('$trans',"
                    . "'$id_pem',"
                    . "'$id_ins', "
                    . "'$set', "
                    . "$jum, "
                    . "STR_TO_DATE('$tgl_pin', '%m/%d/%Y'), "
                    . "STR_TO_DATE('$tgl_kem', '%m/%d/%Y'), "
                    . "$status, '$pegawai_cssd', sysdate())";
            $this->db->query($insert);
            //kurangkan nilai steril dengan jumlah pinjam
            $total = $steril - $jum;
            //update jumlah steril
            $update_instrumen = "UPDATE INSTRUMEN SET STERIL=$total WHERE ID_INSTRUMEN='$id_ins' AND STERIL>=$jum";
            $this->db->query($update_instrumen);
            $update_instrumen = "UPDATE PEMINJAMAN SET JUMLAH_PINJAM=$jum, STATUS_PEMINJAMAN=1 , "
                    . "TANGGAL_KEMBALI=STR_TO_DATE('$tgl_kem', '%m/%d/%Y')"
                    . "WHERE (ID_TRANSAKSI='$trans 'AND ID_INSTRUMEN='$id_ins')";
            $this->db->query($update_instrumen);
            return TRUE;
        } else {
            return NULL;
        }
    }

    //belum tracking
    function pinjam_set_user($trans, $id_pem, $set, $id_ins, $jum, $tgl_pin, $status) {
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
                    . "`setting_set`, "
                    . "`jumlah_pinjam`, "
                    . "`tanggal_pinjam`, "
                    . "`status_peminjaman`) "
                    . "VALUES "
                    . "('$trans',"
                    . "'$id_pem',"
                    . "'$id_ins', "
                    . "'$set', "
                    . "$jum, "
                    . "STR_TO_DATE('$tgl_pin', '%m/%d/%Y'), "
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

    function lihat_peminjaman($tgl) {
        $select = "SELECT a.id_transaksi, a.id_peminjam, b.nama_user, "
                . "DATE_FORMAT(a.tanggal_pinjam, '%d-%m-%Y') AS 'tanggal_pinjam', DATE_FORMAT(a.tanggal_kembali, '%d-%m-%Y') AS 'tanggal_kembali' "
                . "FROM peminjaman a join user b on (a.id_peminjam = b.id_user) "
                . "WHERE a.tanggal_pinjam = STR_TO_DATE('$tgl', '%d/%m/%Y') "
                . "OR a.id_peminjam = '$tgl' "
                . "OR a.id_transaksi = '$tgl' "
                . "GROUP BY a.id_transaksi ORDER BY a.id_transaksi desc";
//        $select = "SELECT a.*, b.nama_instrumen FROM peminjaman a JOIN instrumen b "
//                . "on (a.id_instrumen = b.id_instrumen) "
//                . "WHERE a.tanggal_pinjam = STR_TO_DATE('$tgl', '%d/%m/%Y')";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function lihat_peminjaman_detail($id_transaksi) {
        $select = "SELECT a.*, b.nama_instrumen, DATE_FORMAT(a.tanggal_pinjam, '%d-%m-%Y') AS 'tanggal_pinjam', "
                . "DATE_FORMAT(a.tanggal_kembali, '%d-%m-%Y') AS 'tanggal_kembali' "
                . "FROM peminjaman a JOIN instrumen b "
                . "on (a.id_instrumen = b.id_instrumen) "
                . "WHERE a.id_transaksi = '$id_transaksi'";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function lihat_peminjaman_status($status) {
        $select = "SELECT a.id_transaksi, a.id_peminjam, b.nama_user, "
                . "DATE_FORMAT(a.tanggal_pinjam, '%d-%m-%Y') AS 'tanggal_pinjam', DATE_FORMAT(a.tanggal_kembali, '%d-%m-%Y') AS 'tanggal_kembali' "
                . "FROM peminjaman a join user b on (a.id_peminjam = b.id_user) ";
        if ($status == 0) {
            $select = $select . "WHERE a.status_peminjaman = 0 ";
        } else {
            $select = $select . "WHERE a.status_peminjaman != 0 ";
        }
        $select = $select . "GROUP BY a.id_transaksi ORDER BY a.id_transaksi desc";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function lihat_peminjaman_belum_kembali() {
        $select = "SELECT a.id_transaksi, a.id_peminjam, b.nama_user, DATE_FORMAT(a.tanggal_pinjam, '%d-%m-%Y') AS 'tanggal_pinjam', "
                . "DATE_FORMAT(a.tanggal_kembali, '%d-%m-%Y') AS 'tanggal_kembali' FROM peminjaman a join user b on (a.id_peminjam = b.id_user) "
                . "WHERE a.status_peminjaman = 1 GROUP by a.id_transaksi ";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function panggil_kode_setting_set($id_transaksi) {

        $select = "SELECT setting_set FROM peminjaman "
                . "WHERE id_transaksi = '$id_transaksi' "
                . "GROUP BY id_transaksi";
        $hasil = $this->db->query($select);
        return $hasil->row();
    }

    function panggil_peminjam() {
        $select = "SELECT a.id_transaksi, a.id_peminjam, b.nama_user, a.tanggal_pinjam "
                . "FROM peminjaman a join user b on (a.id_peminjam = b.id_user) "
                . "WHERE a.status_peminjaman = 0 "
                . "GROUP BY a.id_transaksi ORDER BY a.id_transaksi desc";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function panggil_peminjam_id($id) {
        $select = "SELECT a.id_transaksi, a.id_peminjam, b.nama_user, a.tanggal_pinjam "
                . "FROM peminjaman a join user b on (a.id_peminjam = b.id_user) "
                . "WHERE a.status_peminjaman=0 AND (a.id_peminjam='$id' "
                . "or a.id_transaksi = '$id') "
                . "GROUP BY a.id_transaksi ORDER BY a.id_transaksi desc";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function panggil_konfirmasi_id($id, $transaksi) {
        $select = "SELECT a.*, b.nama_instrumen, b.steril, c.nama_user, "
                . "DATE_FORMAT(a.tanggal_pinjam, '%d-%m-%Y') AS 'tanggal_pinjam', DATE_FORMAT(a.tanggal_kembali, '%d-%m-%Y') AS 'tanggal_kembali' "
                . "FROM peminjaman a "
                . "JOIN instrumen b on (a.id_instrumen= b.id_instrumen) "
                . "JOIN user c on (a.id_peminjam = c.id_user) "
                . "WHERE a.status_peminjaman=0 AND id_peminjam='$id' AND id_transaksi='$transaksi' "
                . "ORDER BY a.tanggal_pinjam";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function konfirmasi_update($id, $inst, $jumlah, $steril, $tgl_kembali, $pegawai_cssd) {
        //kurangkan nilai steril dengan jumlah pinjam
        $val1 = intval($steril);
        $val2 = intval($jumlah);
        $total = $val1 - $val2;
        //update jumlah steril
        $update_instrumen = "UPDATE INSTRUMEN SET STERIL=$total WHERE ID_INSTRUMEN='$inst' AND STERIL>=$val2";
        $this->db->query($update_instrumen);
        if ($jumlah == 0) {
            $update_instrumen = "UPDATE PEMINJAMAN SET JUMLAH_PINJAM=$jumlah, STATUS_PEMINJAMAN=3 , "
                    . "TANGGAL_KEMBALI=STR_TO_DATE('$tgl_kembali', '%m/%d/%Y'), ID_CSSD = '$pegawai_cssd', waktu_approve = sysdate()"
                    . "WHERE (ID_TRANSAKSI='$id' AND ID_INSTRUMEN='$inst')";
        } else {
            $update_instrumen = "UPDATE PEMINJAMAN SET JUMLAH_PINJAM=$jumlah, STATUS_PEMINJAMAN=1 , "
                    . "TANGGAL_KEMBALI=STR_TO_DATE('$tgl_kembali', '%m/%d/%Y'), ID_CSSD = '$pegawai_cssd', waktu_approve = sysdate()"
                    . "WHERE (ID_TRANSAKSI='$id' AND ID_INSTRUMEN='$inst')";
        }
        $this->db->query($update_instrumen);
        return TRUE;
    }

    function panggil_transaksi($transaksi) {
        $select = "SELECT a.*, b.nama_user, c.nama_instrumen FROM peminjaman a "
                . "JOIN USER b on (a.id_peminjam = b.id_user) "
                . "JOIN INSTRUMEN c on (a.id_instrumen= c.id_instrumen) "
                . "WHERE a.status_peminjaman=1 AND a.id_transaksi='$transaksi' "
                . "ORDER BY c.nama_instrumen";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function konfirmasi_pengembalian($id, $inst, $tgl_kembali/* , $ket */) {
        //update peminjaman
        $update_instrumen = "UPDATE PEMINJAMAN SET STATUS_PEMINJAMAN=2 , "
                . "TANGGAL_KEMBALI=STR_TO_DATE('$tgl_kembali', '%m/%d/%Y') "
                /* . ", KET='$ket' " */
                . "WHERE (ID_TRANSAKSI='$id' AND ID_INSTRUMEN='$inst')";
        $this->db->query($update_instrumen);
        return TRUE;
    }
    function notifikasi_pengembalian() {
        $tgl = date('d/m/Y');
        $update_instrumen = "select a.id_transaksi, a.id_peminjam, b.nama_user, b.no_telepon, b.status_user, "
                . "DATE_FORMAT(a.tanggal_pinjam, '%d %M %Y') as tanggal_pinjam, sum(a.jumlah_pinjam) AS jumlah_pinjam "
                . "from peminjaman a join user b on (a.id_peminjam = b.id_user) "
                . "where DATE_FORMAT(a.tanggal_kembali, '%d/%m/%Y') <= '$tgl' and a.status_peminjaman = 1 "
                . "GROUP by a.id_transaksi ORDER by tanggal_kembali DESC";
        $hasil = $this->db->query($update_instrumen);
        return $hasil->result();
    }
    
    //-----------------LAPORAN---------------------//
    function laporan_harian_peminjaman($tgl) {
        $select = "SELECT a.id_transaksi, b.nama_instrumen, a.jumlah_pinjam, "
                . "c.nama_user, DATE_FORMAT(a.tanggal_pinjam, '%d-%M-%Y') AS tanggal_pinjam, DATE_FORMAT(a.tanggal_kembali, '%d-%M-%Y') AS tanggal_kembali, "
                . "a.waktu_approve, d.nama_user AS 'id_cssd' "
                . "FROM peminjaman a JOIN instrumen b "
                . "ON (a.id_instrumen=b.id_instrumen) "
                . "JOIN user c ON (a.id_peminjam = c.id_user) "
                . "JOIN user d ON (a.id_cssd = d.id_user) "
                . "WHERE DATE_FORMAT(a.tanggal_pinjam,'%m/%d/%Y') = "
                . "'$tgl' AND a.jumlah_pinjam>0 AND a.waktu_approve is not null";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }
    
    function banyak_pinjam($id_transaksi) {
        $select = "SELECT * FROM peminjaman WHERE id_transaksi = '$id_transaksi'";
        $hasil = $this->db->query($select);
        return $hasil->num_rows();
    }
    
    function laporan_harian_peminjaman_sort_by_instrumen($tgl) {
        $select = "SELECT b.nama_instrumen, SUM(a.jumlah_pinjam) AS JUMLAH_PINJAM
            FROM peminjaman a 
            JOIN instrumen b ON a.id_instrumen=b.id_instrumen 
            WHERE DATE_FORMAT(a.tanggal_pinjam,'%m/%d/%Y') = '$tgl' AND a.jumlah_pinjam>0 AND a.waktu_approve is not null 
            GROUP BY a.id_instrumen ORDER BY JUMLAH_PINJAM DESC";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function laporan_harian_peminjaman_sort_by_setting($tgl) {
        $select = "SELECT a.id_transaksi, b.nama_set, "
                . "(SUBSTR(a.setting_set,5)) AS jumlah_set "
                . "FROM peminjaman a "
                . "JOIN setting_set b ON (b.id_set=LEFT(a.setting_set,3)) "
                . "WHERE DATE_FORMAT(a.tanggal_pinjam,'%m/%d/%Y') = '$tgl' AND a.jumlah_pinjam>0 AND a.waktu_approve is not null GROUP BY a.id_transaksi";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function laporan_harian_peminjaman_sort_by_peminjam($tgl) {
        $select = "SELECT b.nama_user, SUM(a.jumlah_pinjam) AS JUMLAH_PINJAM "
                . "FROM peminjaman a JOIN user b "
                . "ON a.id_peminjam=b.id_user "
                . "WHERE DATE_FORMAT(a.tanggal_pinjam,'%m/%d/%Y') = '$tgl' AND a.jumlah_pinjam>0 AND a.waktu_approve is not null "
                . "GROUP BY a.id_peminjam ORDER BY JUMLAH_PINJAM DESC";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function laporan_bulanan_peminjaman_sort_by_instrumen($bln) {
        $select = "SELECT b.nama_instrumen, SUM(a.jumlah_pinjam) AS JUMLAH_PINJAM
            FROM peminjaman a 
            JOIN instrumen b ON a.id_instrumen=b.id_instrumen 
            WHERE DATE_FORMAT(a.waktu_approve,'%m/%Y') = '$bln' AND a.jumlah_pinjam>0 
            GROUP BY a.id_instrumen ORDER BY JUMLAH_PINJAM DESC";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function laporan_bulanan_peminjaman_sort_by_setting($bln) {
        $select = "SELECT a.id_transaksi, b.nama_set, "
                . "(SUBSTR(a.setting_set,5)) AS jumlah_set "
                . "FROM peminjaman a "
                . "JOIN setting_set b ON (b.id_set=LEFT(a.setting_set,3)) "
                . "WHERE (DATE_FORMAT(waktu_approve,'%m/%Y') = '$bln') "
                . "AND jumlah_pinjam>0 GROUP BY a.id_transaksi";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function laporan_bulanan_peminjaman_sort_by_peminjam($bln) {
        $select = "SELECT b.nama_user, SUM(a.jumlah_pinjam) AS 'JUMLAH_PINJAM', a.id_peminjam "
                . "FROM peminjaman a JOIN user b "
                . "ON a.id_peminjam=b.id_user "
                . "WHERE DATE_FORMAT(a.waktu_approve,'%m/%Y') = '$bln' AND a.jumlah_pinjam>0 "
                . "GROUP BY a.id_peminjam ORDER BY JUMLAH_PINJAM DESC, b.nama_user";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }
    
    function laporan_bulanan_banyak_peminjaman($id_peminjam, $bln) {
        $select = "SELECT id_transaksi FROM peminjaman WHERE id_peminjam = '$id_peminjam' "
                . "AND DATE_FORMAT(waktu_approve,'%m/%Y') = '$bln' AND jumlah_pinjam>0 GROUP BY id_transaksi";
        $hasil = $this->db->query($select);
        return $hasil->num_rows();
    }
    
    function laporan_bulanan_banyak_rusak($id_peminjam, $bln) {
        $query = "SELECT a.nomor_riwayat FROM riwayat_instrumen a "
                . "join peminjaman b on (a.id_transaksi = b.id_transaksi) "
                . "join instrumen c on (a.id_instrumen = c.id_instrumen) "
                . "WHERE DATE_FORMAT(a.waktu_cek, '%m/%Y')='$bln' "
                . "AND b.id_peminjam = '$id_peminjam' AND a.keterangan = 'Rusak' GROUP by a.nomor_riwayat";
        $hasil=$this->db->query($query);
        return $hasil->num_rows();
    }
    function laporan_bulanan_banyak_hilang($id_peminjam, $bln) {
        $query = "SELECT a.nomor_riwayat FROM riwayat_instrumen a "
                . "join peminjaman b on (a.id_transaksi = b.id_transaksi) "
                . "join instrumen c on (a.id_instrumen = c.id_instrumen) "
                . "WHERE DATE_FORMAT(a.waktu_cek, '%m/%Y')='$bln' "
                . "AND b.id_peminjam = '$id_peminjam' AND a.keterangan = 'Hilang' GROUP by a.nomor_riwayat";
        $hasil=$this->db->query($query);
        return $hasil->num_rows();
    }

    function laporan_tahunan_peminjaman_sort_by_instrumen($thn) {
        $select = "SELECT b.nama_instrumen, SUM(a.jumlah_pinjam) AS JUMLAH_PINJAM
            FROM peminjaman a 
            JOIN instrumen b ON a.id_instrumen=b.id_instrumen 
            WHERE DATE_FORMAT(a.waktu_approve,'%Y') = '$thn' AND a.jumlah_pinjam>0 
            GROUP BY a.id_instrumen ORDER BY JUMLAH_PINJAM DESC";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }
    

    function laporan_tahunan_peminjaman_sort_by_setting($thn) {
        $select = "SELECT a.id_transaksi, b.nama_set, "
                . "(SUBSTR(a.setting_set,5)) AS jumlah_set "
                . "FROM peminjaman a "
                . "JOIN setting_set b ON (b.id_set=LEFT(a.setting_set,3)) "
                . "WHERE (DATE_FORMAT(waktu_approve,'%Y') = '$thn') "
                . "AND jumlah_pinjam>0 GROUP BY a.id_transaksi";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function laporan_tahunan_peminjaman_sort_by_peminjam($thn) {
        $select = "SELECT b.nama_user, SUM(a.jumlah_pinjam) AS JUMLAH_PINJAM, a.id_peminjam  "
                . "FROM peminjaman a JOIN user b "
                . "ON a.id_peminjam=b.id_user "
                . "WHERE DATE_FORMAT(a.waktu_approve,'%Y') = '$thn' AND a.jumlah_pinjam>0 "
                . "GROUP BY a.id_peminjam ORDER BY JUMLAH_PINJAM DESC, b.nama_user";
        $hasil = $this->db->query($select);
        return $hasil->result();
    }

    function laporan_tahunan_banyak_peminjaman($id_peminjam, $thn) {
        $select = "SELECT id_transaksi FROM peminjaman WHERE id_peminjam = '$id_peminjam' "
                . "AND DATE_FORMAT(waktu_approve,'%Y') = '$thn' AND jumlah_pinjam>0 GROUP BY id_transaksi";
        $hasil = $this->db->query($select);
        return $hasil->num_rows();
    }
    
    function laporan_tahunan_banyak_rusak($id_peminjam, $tahun) {
        $query = "SELECT a.nomor_riwayat FROM riwayat_instrumen a "
                . "join peminjaman b on (a.id_transaksi = b.id_transaksi) "
                . "join instrumen c on (a.id_instrumen = c.id_instrumen) "
                . "WHERE DATE_FORMAT(waktu_approve,'%Y') = '$tahun' "
                . "AND b.id_peminjam = '$id_peminjam' AND a.keterangan = 'Rusak' GROUP by a.nomor_riwayat";
        $hasil=$this->db->query($query);
        return $hasil->num_rows();
    }
    function laporan_tahunan_banyak_hilang($id_peminjam, $tahun) {
        $query = "SELECT a.nomor_riwayat FROM riwayat_instrumen a "
                . "join peminjaman b on (a.id_transaksi = b.id_transaksi) "
                . "join instrumen c on (a.id_instrumen = c.id_instrumen) "
                . "WHERE DATE_FORMAT(waktu_approve,'%Y') = '$tahun' "
                . "AND b.id_peminjam = '$id_peminjam' AND a.keterangan = 'Hilang' GROUP by a.nomor_riwayat";
        $hasil=$this->db->query($query);
        return $hasil->num_rows();
    }

}
