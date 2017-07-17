<div class="w3-responsive w3-card-4 w3-padding-16" >
    <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
        <b class='w3-padding '>Laporan Harian</b>
    </div>
    <table  align="center" style="width:33%;margin-bottom:3%">
        <tr style='text-align: center'>
        <form method="post" action='<?php echo base_url('LaporanControl/harian'); ?>' onsubmit="return validasi_input(this)">
            <th style='text-align: center; width: 20%'>PILIH TANGGAL</th>
            <th style='text-align: center; width: 10%' class='inputTanggal'>
                <input type='text' id='tanggal' name='tgl' placeholder='Klik untuk isi' required=''></th>
            <th style='text-align: left; width: 3%'>
                <button style='text-align: center' class="btn btn-success w3-hover-blue-gray" name="cari" value="CARI"><i class="fa fa-search">
                    </i>&nbsp;</button></th>
        </form>
        <?php
        $tampil = 0;
        if (isset($laporan_harian)) {
            $tampil = count($laporan_harian);
        } elseif (isset($cari_laporan)) {
            $tampil = count($cari_laporan);
        }
        if ($tampil != 0) {
            echo "<form method='post' action='";
            echo base_url('LaporanControl/cetakHarian');
            echo "' onsubmit='return validasi_input(this)'>
            <th style='text-align: left; width: 3%'>
            <button style='text-align: center;' class='buttonCetak w3-hover-red' name='print' value='PRINT'>
        <i class='fa fa-print'></i>&nbsp;</button></th></form>";
        }
        ?>
        </tr>
    </table>
    <h4 style="text-align: center"><b>Hasil Menampilkan Laporan Tanggal :<i style="color: red">
                <?php
                $ex = explode('/', $tanggal);
                $dateObj = DateTime::createFromFormat('!m', $ex[0]);
                $bulan = $dateObj->format('F');
                echo $ex[1] . '-' . $bulan . '-' . $ex[2];
                ?>
            </i></b></h4>
    <table style="width:90%;" align="center">
        <tr>
        <form action="<?php echo base_url('LaporanControl/inputHarian/'); ?>" onsubmit="return validasi_input2(this)">
            <th style="margin-left:1px">
                <button class="btn btn-succes w3-deep-orange w3-large w3-hover-text-black" name="ket" value="distribusi">Distribusi</button>
            </th>
            <th style="margin-left:1px">
                <button class="btn btn-succes w3-blue-grey w3-large w3-hover-text-black" name="ket" value="instrumen">Instrumen</button>
            </th>
            <th style="margin-left:1px">
                <button class="btn btn-succes w3-green w3-large w3-hover-text-black" name="ket" value="peminjam">Peminjam</button>
            </th>
            <th style="margin-left:1px">
                <button class="btn btn-succes w3-blue w3-large w3-hover-text-black" name="ket" value="inventaris">Invetarisasi</button>
            </th>
            <th colspan="3" style="width:80%"></th>
        </form>
        </tr>
    </table>
    <table class="w3-table w3-striped w3-bordered w3-animate-opacity w3-card" align="center" style="width:90%;margin-bottom:5%">
        <thead>

        <tbody>
            <?php
            $index = 1;
            if ($tampil == 0) {
                echo "<tr><td style='text-align: center;' colspan='4'>"
                . "<h3 style='color: red' class='w3-padding-64'>TIDAK ADA LAPORAN</h3></td></tr>
                                  ";
            } else {
                if ($ket == 'distribusi') {
                    echo "<tr class='w3-theme'>
                                <th style='text-align: center;'>ID TRANSAKSI</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: left;'>JUMLAH PINJAM</th>
                                <th style='text-align: left;'>PEMINJAM</th>
                                <th style='text-align: left;'>TANGGAL PINJAM</th>
                                <th style='text-align: left;'>TANGGAL KEMBALI</th>
                                <th style='text-align: left;'>WAKTU APPROVE</th>
                                <th style='text-align: left;'>ID CSSD</th>
                            </tr>";
                    if (isset($laporan_harian)) {
                        foreach ($laporan_harian as $r):
                            echo "
                                    <tr>
                                    <td style='text-align: center'>$r->id_transaksi</td>
                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center'>$r->jumlah_pinjam</td>
                                    <td style='text-align: center'>$r->nama_user</td>
                                    <td style='text-align: center'>$r->tanggal_pinjam</td>
                                    <td style='text-align: center'>$r->tanggal_kembali</td>
                                    <td style='text-align: center'>$r->waktu_approve</td>
                                    <td style='text-align: center'>$r->id_cssd</td>
                                    </td>
                                    </tr>";
                        endforeach;
                    }
                }if ($ket == 'instrumen') {
                    echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>JUMLAH PINJAM</th>
                                </tr>";
                    if (isset($laporan_harian)) {
                        foreach ($laporan_harian as $r):
                            echo "
                                    <tr>
                                    <td style='text-align: left'><b>$index.</b></td>
                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center'>$r->JUMLAH_PINJAM</td>
                                    </tr>";
                            $index++;
                        endforeach;
                    }
                }if ($ket == 'peminjam') {
                    echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: center;'>PEMINJAM</th>
                                <th style='text-align: center;'>BANYAK PEMINJAMAN</th>
                                </tr>";
                    if (isset($laporan_harian)) {
                        foreach ($laporan_harian as $r):
                            echo "
                                    <tr>
                                    <td style='text-align: left'><b>$index.</b></td>
                                    <td style='text-align: center'>$r->nama_user</td>
                                    <td style='text-align: center'>$r->JUMLAH_PINJAM</td>
                                </tr>";
                            $index++;
                        endforeach;
                    }
                }if ($ket == 'inventaris') {
                    echo "<tr class='w3-theme'>
                                <th style='text-align: center;'>ID TRANSAKSI</th>
                                <th style='text-align: left;'>TANGGAL</th>
                                <th style='text-align: left;'>PUKUL</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: left;'>PEMINJAM</th>
                                <th style='text-align: left;'>KETERANGAN</th>
                            </tr>";
                    if (isset($laporan_harian)) {
                        foreach ($laporan_harian as $r):
                            echo "
                                    <tr>
                                    <td style='text-align: center'>$r->id_transaksi</td>
                                    <td style='text-align: left'><b>$r->tanggal</b></td>
                                    <td style='text-align: left'>$r->pukul</td>
                                    <td style='text-align: left'>$r->nama_instrumen</td>
                                    <td style='text-align: left'>$r->nama_user</td>
                                    <td style='text-align: left'>$r->keterangan</td>
                                    </td>
                                    </tr>";
                        endforeach;
                    }
                }
            }
            ?>

        </tbody>
    </table>
</div>