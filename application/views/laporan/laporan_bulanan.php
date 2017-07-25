<div class="w3-responsive w3-card-4 w3-padding-16" >
    <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
        <b class='w3-padding '>Laporan Bulanan</b>
    </div>
    <table style="width:60%" align='center'>
        <tr>
            <th>
        <h4 style="text-align: center"><b>Hasil Menampilkan Laporan Bulan :<i style="color: red">
                    <?php
                    $ex = explode('/', $bulan);
                    $dateObj = DateTime::createFromFormat('!m', $ex[0]);
                    $monthName = $dateObj->format('F'); // March
                    echo $monthName . " " . $ex[1];
                    ?>
                </i></b></h4>
        </th>

        </tr>
        <tr>
        <form method="post" action='<?php echo base_url('LaporanControl/bulanan'); ?>' onsubmit="return validasi_input(this)">
            <th style="text-align: center;width: 50%">
            <div>
                <input style="height: 40px;width:30%;margin-top:15px" type='text' id='bulan' name='bln' class="form-control" title="Pilih bulan pada tahun tertentu untuk melihat laporan dibulan tersebut" placeholder="Pencarian Bulan" required="">
                <button class="btn btn-success w3-hover-text-black" name="cari" value="CARI" style="height:40px;width: 50px;margin-left:5px;margin-bottom:10px"><i class="fa fa-search"></i>&nbsp;</button>
            </div>
            </th>
        </form>
        <?php
        $tampil = 0;
        if (isset($laporan_bulanan)) {
            $tampil = count($laporan_bulanan);
        } elseif (isset($cari_laporan)) {
            $tampil = count($cari_laporan);
        }
//        if ($tampil != 0) {
//            echo "<form method='post' action='";
//            echo base_url('LaporanControl/cetakHarian');
//            echo "' onsubmit='return validasi_input(this)'>
//            <th style='text-align: left; width: 3%'>
//            <button style='text-align: center;' class='buttonCetak w3-hover-red' name='print' value='PRINT'>
//        <i class='fa fa-print'></i>&nbsp;</button></th></form>";
//        }
        ?>
        </tr>
    </table>
    <table style="width:90%;" align="center">
        <tr>
        <form action="<?php echo base_url('LaporanControl/inputBulanan/'); ?>" onsubmit="return validasi_input2(this)">
            <th style="margin-left:1px">
                <button class="btn <?php
                if ($ket == 'instrumen') {
                    echo "btn-default ";
                } else {
                    echo "w3-grey ";
                }
                ?>w3-large w3-hover-text-red" name="ket" value="instrumen">Instrumen</button>
            </th>
            <th style="margin-left:1px">
                <button class="btn <?php
                if ($ket == 'setting') {
                    echo "btn-default ";
                } else {
                    echo "w3-grey ";
                }
                ?>w3-large w3-hover-text-red" name="ket" value="setting">Setting Set</button>
            </th>
            <th style="margin-left:1px">
                <button class="btn <?php
                if ($ket == 'peminjam') {
                    echo "btn-default ";
                } else {
                    echo "w3-grey ";
                }
                ?>w3-large w3-hover-text-red" name="ket" value="peminjam">Peminjam</button>
            </th>
            <th style="margin-left:1px">
                <button class="btn <?php
                if ($ket == 'inventaris') {
                    echo "btn-default ";
                } else {
                    echo "w3-grey ";
                }
                ?>w3-large w3-hover-text-red" name="ket" value="inventaris">Invetarisasi</button>
            </th>
            <th colspan="3" style="width:80%"></th>
        </form>
        </tr>
    </table>
    <form class="scroll">
        <table class="w3-table" align="center" style="width:90%;">
            <thead>

            <tbody>
                <?php
                $index = 1;
                if ($tampil == 0) {
                    echo "<tr class='w3-card'><td style='text-align: center;' colspan='4'>"
                    . "<h3 style='color: red' class='w3-padding-64'>TIDAK ADA LAPORAN</h3></td></tr>
                                  ";
                } else {
                    if ($ket == 'instrumen') {
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>JUMLAH PINJAM</th>
                                <th style='width:60%;background-color:grey' class='w3-card'></th>
                                </tr>";
                        if (isset($laporan_bulanan)) {
                            foreach ($laporan_bulanan as $r):
                                echo "
                                    <tr>
                                    <td style='text-align: left' class='w3-card'><b>$index.</b></td>
                                    <td style='text-align: left' class='w3-card'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center' class='w3-card'>$r->JUMLAH_PINJAM</td>
                                        <td class='w3-card'></td>
                                    </tr>";
                                $index++;
                            endforeach;
                        }
                    }if ($ket == 'setting') {
                        $nama_setting = NULL;
                        $hasil = 0;
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>NAMA SET</th>
                                <th style='text-align: center;'>JUMLAH PINJAM</th>
                                <th style='width:60%;background-color:grey' class='w3-card'></th>
                                </tr>";
                        if (isset($laporan_bulanan)) {
                            foreach ($laporan_bulanan as $value => $r):
                                $setting = $r->nama_set;
                                $jumlah = $r->jumlah_set;
                                if ($nama_setting == $setting || $nama_setting == NULL) {
                                    if ($nama_setting == NULL && $hasil == 0) {
                                        $nama_setting = $setting;
                                        $hasil = $jumlah;
                                    } else if ($nama_setting == $setting) {
                                        $nama_setting = $setting;
                                        $hasil = $hasil + $jumlah;
                                    }
                                } else {
                                    echo "
                                    <tr>
                                    <td style='text-align: left' class='w3-card'><b>$index.</b></td>
                                    <td style='text-align: left' class='w3-card'><b>$nama_setting</b></td>
                                    <td style='text-align: center' class='w3-card'>$hasil</td>
                                        <td class='w3-card'></td>
                                    </tr>";
                                    $nama_setting = $setting;
                                    $hasil = 0 + $jumlah;
                                    $index++;
                                }
                            endforeach;
                            echo "
                                    <tr>
                                    <td style='text-align: left' class='w3-card'><b>$index.</b></td>
                                    <td style='text-align: left' class='w3-card'><b>$nama_setting</b></td>
                                    <td style='text-align: center' class='w3-card'>$hasil</td>
                                        <td class='w3-card'></td>
                                    </tr>";
                        }
                    }if ($ket == 'peminjam') {
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;width:30%'>PEMINJAM</th>
                                <th style='text-align: center;'>BANYAK PEMINJAMAN</th>
                                <th style='text-align: center;'>TOTAL PINJAM INSTRUMEN</th>
                                <th style='text-align: center;'>INSTRUMEN RUSAK</th>
                                <th style='text-align: center;'>INSTRUMEN HILANG</th>
                                <th style='width:20%;background-color:grey' class='w3-card'></th>
                                </tr>";
                        if (isset($laporan_bulanan)) {
                            $this->load->model('Peminjaman');
                            foreach ($laporan_bulanan as $r):
                                $banyak_pinjam = $this->Peminjaman->laporan_bulanan_banyak_peminjaman($r->id_peminjam, $bulan);
                                $banyak_rusak = $this->Peminjaman->laporan_bulanan_banyak_rusak($r->id_peminjam, $bulan);
                                if($banyak_rusak == 0){
                                    $banyak_rusak = 'Tidak Ada';
                                }
                                
                                $banyak_hilang = $this->Peminjaman->laporan_bulanan_banyak_hilang($r->id_peminjam, $bulan);
                                if($banyak_hilang == 0){
                                    $banyak_hilang = 'Tidak Ada';
                                }
                                echo "
                                    <tr>
                                    <td style='text-align: left' class='w3-card'><b>$index.</b></td>
                                    <td style='text-align: left' class='w3-card'>$r->nama_user</td>
                                    <td style='text-align: center' class='w3-card'>$banyak_pinjam</td>
                                    <td style='text-align: center' class='w3-card'>$r->JUMLAH_PINJAM</td>
                                    <td style='text-align: center' class='w3-card'>$banyak_rusak</td>
                                    <td style='text-align: center' class='w3-card'>$banyak_hilang</td>
                                        <td class='w3-card'></td>
                                </tr>";
                                $index++;
                            endforeach;
                        }
                    }if ($ket == 'inventaris') {
                        $nama = NULL;
                        $baik = 0;
                        $rusak = 0;
                        $hilang = 0;
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>BAIK</th>
                                <th style='text-align: center;'>RUSAK</th>
                                <th style='text-align: center;'>HILANG</th>
                                <th style='width:60%;background-color:grey' class='w3-card'></th>
                            </tr>";
                        if (isset($laporan_bulanan)) {
                            foreach ($laporan_bulanan as $r):
                                $instrumen = $r->nama_instrumen;
                                $keterangan = $r->keterangan;
                                if ($nama == NULL || $nama == $instrumen) {
                                    $nama = $instrumen;
                                    if ($keterangan == "Rusak") {
                                        $rusak = $rusak + 1;
                                    }
                                    if ($keterangan == "Hilang") {
                                        $hilang = $hilang + 1;
                                    }
                                    $baik = $r->baik;
                                } else {
                                    echo "
                                    <tr>
                                    <td style='text-align: left;background-color:white' class='w3-card'>$index.</td>
                                    <td style='text-align: left' class='w3-card'>$nama</td>
                                    <td style='text-align: center' class='w3-card'>$baik</td>
                                    <td style='text-align: center' class='w3-card'>$rusak</td>
                                    <td style='text-align: center' class='w3-card'>$hilang</td>
                                        <td class='w3-card'></td>
                                </tr>";
                                    $index++;
                                    $nama = $instrumen;
                                    if ($keterangan == "Rusak") {
                                        $rusak = 1;
                                        $hilang = 0;
                                    }
                                    if ($keterangan == "Hilang") {
                                        $rusak = 0;
                                        $hilang = 1;
                                    }
                                    $baik = $r->baik;
                                }
                            endforeach;
                            echo "
                                    <tr>
                                    <td style='text-align: left;background-color:white' class='w3-card'>$index.</td>
                                    <td style='text-align: left' class='w3-card'>$nama</td>
                                    <td style='text-align: center' class='w3-card'>$baik</td>
                                    <td style='text-align: center' class='w3-card'>$rusak</td>
                                    <td style='text-align: center' class='w3-card'>$hilang</td>
                                        <td class='w3-card'></td>
                                    </td>
                                </tr>";
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </form>
</div>