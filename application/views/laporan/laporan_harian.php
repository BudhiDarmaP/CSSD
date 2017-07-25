<div class="w3-responsive w3-card-4 w3-padding-16" >
    <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
        <b class='w3-padding '>Laporan Harian</b>
    </div>
    <table style="width:60%" align='center'>
        <tr>
            <th>
        <h4 style="text-align: center"><b>Hasil Menampilkan Laporan Tanggal :<i style="color: red">
                    <?php
                    $ex = explode('/', $tanggal);
                    $dateObj = DateTime::createFromFormat('!m', $ex[0]);
                    $bulan = $dateObj->format('F');
                    echo $ex[1] . '-' . $bulan . '-' . $ex[2];
                    ?>
                </i></b></h4>
        </th>

        </tr>
        <tr>
        <form method="post" action='<?php echo base_url('LaporanControl/harian'); ?>' onsubmit="return validasi_input(this)">
            <th style="text-align: center;width: 50%">
            <div>
                <input style="height: 40px;width:30%;margin-top:15px" type='text' id='tanggal' name='tgl' class="form-control" title="Pilih tanggal untuk melihat laporan ditangal tersebut" placeholder="Pencarian Tanggal" required="">
                <button class="btn btn-success w3-hover-text-black" name="cari" value="CARI" style="height:40px;width: 50px;margin-left:5px;margin-bottom:10px"><i class="fa fa-search"></i>&nbsp;</button>
            </div>
            </th>
        </form>
        <?php
        $tampil = 0;
        if (isset($laporan_harian)) {
            $tampil = count($laporan_harian);
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
        <form action="<?php echo base_url('LaporanControl/inputHarian/'); ?>" onsubmit="return validasi_input2(this)">
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
            <th style="margin-left:1px">
                <button class="btn <?php
                if ($ket == 'distribusi') {
                    echo "btn-default ";
                } else {
                    echo "w3-grey ";
                }
                ?>w3-large w3-hover-text-red" name="ket" value="distribusi">Distribusi</button>
            </th>
            <th colspan="3" style="width:80%"></th>
        </form>
        </tr>
    </table>
    <form class="scroll">
        <table class="w3-table" align="center" style="width:90%;margin-bottom:5%">
            <thead>

            <tbody>
                <?php
                $index = 1;
                if ($tampil == 0) {
                    echo "<tr class='w3-card'><td style='text-align: center;' colspan='4'>"
                    . "<h3 style='color: red' class='w3-padding-64'>TIDAK ADA LAPORAN</h3></td></tr>
                                  ";
                } else {
                    if ($ket == 'distribusi') {
                        echo "<tr class='w3-theme'>
                                <th style='text-align: center;'>ID TRANSAKSI</th>
                                <th style='text-align: center;'>PEMINJAM</th>
                                <th style='text-align: center;'>WAKTU APPROVE</th>
                                <th style='text-align: center;'>APPROVE BY</th>
                                <th style='text-align: center;'>TANGGAL PINJAM</th>
                                <th style='text-align: center;'>TANGGAL KEMBALI</th>
                                <th style='text-align: center;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>JUMLAH PINJAM</th>
                            </tr>";
                        if (isset($laporan_harian)) {
                            $this->load->model('Peminjaman');
                            $id_transaksi_cetak = '';
                            $peminjam = '';
                            $banyak_cetak = 0;
                            foreach ($laporan_harian as $r):
                                echo "<tr>";
                                if ($id_transaksi_cetak != $r->id_transaksi) {
                                    $id_transaksi_cetak = $r->id_transaksi;
                                    $banyak_cetak = $this->Peminjaman->banyak_pinjam($id_transaksi_cetak);
                                    echo "<td style='text-align: center' class='w3-card' rowspan='$banyak_cetak'>$r->id_transaksi</td>";
                                    echo "<td style='text-align: center' class='w3-card' rowspan='$banyak_cetak'>$r->nama_user</td>";
                                    echo "<td style='text-align: center' class='w3-card' rowspan='$banyak_cetak'>$r->waktu_approve</td>";
                                    echo "<td style='text-align: center' class='w3-card' rowspan='$banyak_cetak'>$r->id_cssd</td>";
                                    echo "<td style='text-align: center' class='w3-card' rowspan='$banyak_cetak'>$r->tanggal_pinjam</td>";
                                }

                                echo "
                                    <td style='text-align: center' class='w3-card'>$r->tanggal_kembali</td>
                                    <td style='text-align: left' class='w3-card'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center' class='w3-card'>$r->jumlah_pinjam</td>
                                    </tr>";
                            endforeach;
                        }
                    }if ($ket == 'instrumen') {
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>JUMLAH PINJAM</th>
                                <th style='width:60%;background-color:grey' class='w3-card'></th>
                                </tr>";
                        if (isset($laporan_harian)) {
                            foreach ($laporan_harian as $r):
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
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>ID TRANSAKSI</th>
                                <th style='text-align: left;'>NAMA SET</th>
                                <th style='text-align: center;'>JUMLAH PINJAM</th>
                                <th style='width:50%;background-color:grey' class='w3-card'></th>
                                </tr>";
                        if (isset($laporan_harian)) {
                            foreach ($laporan_harian as $r):
                                echo "
                                    <tr>
                                    <td style='text-align: left' class='w3-card'><b>$index.</b></td>
                                    <td style='text-align: left' class='w3-card'><b>$r->id_transaksi</b></td>
                                    <td style='text-align: left' class='w3-card'><b>$r->nama_set</b></td>
                                    <td style='text-align: center' class='w3-card'>$r->jumlah_set</td>
                                    <td class='w3-card'></td>
                                    </tr>";
                                $index++;
                            endforeach;
                        }
                    }if ($ket == 'peminjam') {
                        echo "<tr class='w3-theme'>
                                <th style='text-align: left;'>NO.</th>
                                <th style='text-align: left;'>PEMINJAM</th>
                                <th style='text-align: center;'>BANYAK PINJAM INSTRUMEN</th>
                                <th style='width:60%;background-color:grey' class='w3-card'></th>
                                </tr>";
                        if (isset($laporan_harian)) {
                            foreach ($laporan_harian as $r):
                                echo "
                                    <tr>
                                    <td style='text-align: left' class='w3-card'><b>$index.</b></td>
                                    <td style='text-align: left' class='w3-card'>$r->nama_user</td>
                                    <td style='text-align: center' class='w3-card'>$r->JUMLAH_PINJAM</td>
                                    <td class='w3-card'></td>
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
                                    <td style='text-align: center' class='w3-card'>$r->id_transaksi</td>
                                    <td style='text-align: left' class='w3-card'><b>$r->tanggal</b></td>
                                    <td style='text-align: left' class='w3-card'>$r->pukul</td>
                                    <td style='text-align: left' class='w3-card'>$r->nama_instrumen</td>
                                    <td style='text-align: left' class='w3-card'>$r->nama_user</td>
                                    <td style='text-align: left' class='w3-card'>$r->keterangan</td>
                                    </tr>";
                            endforeach;
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </form>
</div>