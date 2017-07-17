<div class="w3-responsive w3-card-4 w3-padding-16" >
    <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
        <b class='w3-padding '>Laporan Tahunan</b>
    </div>
    <form method="post" action='<?php echo base_url('LaporanControl/tahunan'); ?>' onsubmit="return validasi_input(this)">
        <table  align="center" style="width:33%;margin-bottom:3%">
            <tr style='text-align: center'>
                <th style='text-align: center; width: 17%'>PILIH TAHUN</th>
                <th style='text-align: center; width: 10%' class='inputTanggal'>
                    <input type='text' id='tahun' name='thn' placeholder='Klik untuk isi' required=''></th>
                <th style='text-align: left; width: 3%'>
                    <button style='text-align: center' class="btn btn-success w3-hover-blue-gray" name="cari" value="CARI"><i class="fa fa-search">
                        </i>&nbsp;</button></th>
                </form>
                <?php
                $tampil = 0;
                if (isset($laporan_tahunan)) {
                    $tampil = count($laporan_tahunan);
                } elseif (isset($cari_laporan)) {
                    $tampil = count($cari_laporan);
                }
                if ($tampil != 0) {
                    echo "<form method='post' action='";
                    echo base_url('LaporanControl/cetakTahunan');
                    echo "' onsubmit='return validasi_input(this)'>
                    <th style='text-align: left; width: 3%'>
                    <button style='text-align: center;' class='buttonCetak w3-hover-red' name='print' value='PRINT'>
                    <i class='fa fa-print'></i>&nbsp;</button></th></form>";
                }
                ?>
            </tr>
        </table>
        <h4 style="text-align: center"><b>Hasil Menampilkan Laporan Tahun :<i style="color: red">
                    <?php
                    echo $tahun;
                    ?>
                </i></b></h4>
        <table style="width:90%;" align="center">
            <tr>
            <form action="<?php echo base_url('LaporanControl/inputTahunan/'); ?>" onsubmit="return validasi_input2(this)">
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
                    if ($ket == 'instrumen') {
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>JUMLAH PINJAM</th>
                                </tr>";
                        if (isset($laporan_tahunan)) {
                            foreach ($laporan_tahunan as $r):
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
                        if (isset($laporan_tahunan)) {
                            foreach ($laporan_tahunan as $r):
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
                                <th style='text-align: center;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>BAIK</th>
                                <th style='text-align: center;'>RUSAK</th>
                                <th style='text-align: center;'>HILANG</th>
                            </tr>";
                        if (isset($laporan_tahunan)) {
                            foreach ($laporan_tahunan as $r):
                                echo "
                                    <tr>
                                    <td style='text-align: center'>$r->nama_instrumen</td>
                                    <td style='text-align: center'>$r->baik</td>
                                    <td style='text-align: center'>$r->rusak</td>
                                    <td style='text-align: center'>$r->hilang</td>
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