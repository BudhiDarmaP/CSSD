<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Riwayat_Instrumen extends CI_Model {

    function insert_riwayat($id_instrumen, $id_transaksi, $keterangan) {
        $nomor_riwayat = $this->panggil_jumlah_riwayat_instrumen();
        $q = $this->db->query("INSERT INTO riwayat_instrumen values ('$nomor_riwayat', '$id_instrumen', '$id_transaksi', '$keterangan', sysdate())");
        return TRUE;
    }

    function panggil_jumlah_riwayat_instrumen() {
        $q = $this->db->query("SELECT * FROM riwayat_instrumen");
        return $q->num_rows();
    }

    function kurangi_stok_instrumen($id, $jumlah) {
        $this->db->query("UPDATE `instrumen` set jumlah = jumlah + $jumlah where id_instrumen = '$id'");
        return TRUE;
    }

    function laporan_harian($tgl) {
        $query = "SELECT a.id_transaksi, DATE_FORMAT(a.waktu_cek, '%d-%M-%Y') AS 'tanggal', "
                . "DATE_FORMAT(a.waktu_cek, '%H : %i') AS 'pukul', "
                . "c.nama_instrumen, a.keterangan, d.nama_user "
                . "FROM riwayat_instrumen a join peminjaman b "
                . "on (a.id_transaksi = b.id_transaksi) "
                . "join instrumen c on (a.id_instrumen = c.id_instrumen) "
                . "join user d on (b.id_peminjam = d.id_user) "
                . "where DATE_FORMAT(a.waktu_cek, '%m/%d/%Y')='$tgl' "
                . "group by a.nomor_riwayat";
        $hasil=$this->db->query($query);
        return $hasil->result();
    }

    function laporan_bulanan($bln) {
        $query = "SELECT c.nama_instrumen, c.jumlah AS 'baik', "
                . "SUM(IF(a.keterangan='Rusak',1,0)) AS 'rusak', "
                . "SUM(IF(a.keterangan='Hilang',1,0)) AS 'hilang' "
                . "FROM riwayat_instrumen a "
                . "join peminjaman b on (a.id_transaksi = b.id_transaksi) "
                . "join instrumen c on (a.id_instrumen = c.id_instrumen) "
                . "WHERE DATE_FORMAT(a.waktu_cek, '%m/%Y')='$bln' "
                . "group by a.nomor_riwayat";
        $hasil=$this->db->query($query);
        return $hasil->result();
    }

    function laporan_tahunan($thn) {
        $query = "SELECT c.nama_instrumen, c.jumlah AS 'baik', "
                . "SUM(IF(a.keterangan='Rusak',1,0)) AS 'rusak', "
                . "SUM(IF(a.keterangan='Hilang',1,0)) AS 'hilang' "
                . "FROM riwayat_instrumen a "
                . "join peminjaman b on (a.id_transaksi = b.id_transaksi) "
                . "join instrumen c on (a.id_instrumen = c.id_instrumen) "
                . "WHERE DATE_FORMAT(a.waktu_cek, '%Y')='$thn' "
                . "group by a.nomor_riwayat";
        $hasil=$this->db->query($query);
        return $hasil->result();
    }

}
