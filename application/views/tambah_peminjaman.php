
<!DOCTYPE html>
<html>
    <title>Tambahkan Peminjaman</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/scroll.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('/images/Logo.png'); ?>" rel="icon" type="image/png"/>
    <script src="JavaScript.js"></script>
    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
        body, html {
            height: 20%;
            color: #777;
            line-height: 1.8;
        }

        /* Create a Parallax Effect */
        .bgimg-1, .bgimg-2, .bgimg-3 {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* First image (Logo. Full height) */
        .bgimg-1 {
            background-image: url('Gambar/Rute2.png');
            min-height: 100%;
        }

        .w3-wide {letter-spacing: 10px;}
        .w3-hover-opacity {cursor: pointer;}

        /* Turn off parallax scrolling for tablets and phones */
        @media only screen and (max-device-width: 1024px) {
            .bgimg-1, .bgimg-2, .bgimg-3 {
                background-attachment: scroll;
            }
        }
        .buttonPinjam{
            display: inlin-block;
            border-radius: 4px;
            background-color: #f44336;
            border: none;
            color: #fff;
            text-align: center;
            font-size: 22px;
            padding: 2px;
            width: 170px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .buttonPinjam span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .buttonPinjam span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: 20px;
            transition: 0.5s;
        }

        .buttonPinjam:hover span {
            padding-right: 25px;
        }

    </style>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <?php
            $this->load->view("header_footer/header_peminjaman");
            $status_user = $_SESSION["status_user"];
            ?>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <!-- Container (About Section) -->
        <!--        <div class="w3-content w3-container w3-center" id="about">
                    <img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">
                </div>-->

        <div class="w3-container">
            <div class="w3-container w3-responsive w3-padding-24">
                <div class="col-xs-12">
                    <table style="width:60%" align='center'>
                        <tr>
                            <th>
                                <?php
                                if ($status_user == 2) {
                                    echo "<a href = '";
                                    echo base_url('/site/riwayat_pinjam');
                                    echo "' class = 'btn btn-success w3-green w3-card-2 w3-hover-text-black w3-large' name = 'cari' value = 'CARI' style = 'width:60%;'><i class = 'fa fa-search'></i> Riwayat Peminjaman</a>";
                                }
                                ?>
                            </th>
                            <th colspan="3" style="text-align:left" class="w3-small">
                                <b style="color:red" class="w3-large">Peminjaman untuk setting set: </b><br>1. Pilih setting set yang sudah tersedia<br>2. Masukkan jumlah setting set yang akan dipinjam
                            </th>
                        </tr>
                        <tr>
                        <form action="<?php echo base_url('/PeminjamanControl/cari'); ?>">
                            <th style="width: 50%">
                            <div>
                                <input style="height: 40px;width:50%;margin-top:15px" type="text" class="form-control" name="namainstrumen" title="Masukkan Nama / ID instrumen yang dicari" placeholder="Pencarian Instrumen" required="">
                                <button class="btn btn-success w3-hover-text-black" name="cari" value="CARI" style="height:40px;width: 50px;margin-left:5px;margin-bottom:10px"><i class="fa fa-search"></i>&nbsp;</button>
                            </div>
                            </th>
                        </form>
                        <form action="<?php echo base_url('/PeminjamanControl/pinjam_setting'); ?>">
                            <th style="width: 35%;text-align:right">
                                <select class='form-control w3-input w3-border w3-padding w3-bordered' name='set' required="" style="height:40px;width:98%;text-align: center">
                                    <option value='' required='' disabled='disabled' selected>-- Pilih Setting Set --</option>
                                    <?php
                                    foreach ($set as $s):
                                        echo "
                                            <option value='$s->id_set' style='color:black'>$s->nama_set</option>";
                                    endforeach;
                                    ?>
                                </select>
                            </th>
                            <th style="text-align:right;width:10%;">
                                <input type='number' name='banyak_set' min="1" required='' placeholder="0" title="Jumlah Set" class="form-control w3-input w3-border w3-border-grey" style="height:40px;">
                            </th>
                            <th style="text-align:right;width:5%;">
                                <button class="btn btn-success  w3-hover-text-black" value="CARI" style="width:50px;margin-left:5px;margin-bottom:10px;height:40px;"><i class="fa fa-check"></i>&nbsp;</button>
                            </th>
                        </form>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="w3-responsive w3-card-4 w3-padding-16" >
                <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-xlarge w3-green">
                    <table style="width:100%">
                        <tr>
                            <th style="text-align:center">
                                <b style="">Daftar Instrumen <?php if (isset($nama_instrumen)) echo "<a style='color:red'>$nama_instrumen</a>"; ?> Di CSSD</b>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align:center">
                                <b class="w3-small w3-hover-text-black">Total Instrumen 
                                    <?php
                                    if (isset($ada_instrumen) || isset($cari_instrumen)) {
                                        $total = 0;
                                        if (isset($cari_instrumen)) {
                                            $total = count($cari_instrumen);
                                        } else {
                                            $total = count($ada_instrumen);
                                        }
                                        echo ": <b class='w3-large'>$total</b></b>";
                                    }
                                    ?>
                                    <span class="w3-small"><b>|| Peminjaman Instrumen di CSSD : Centang baris instrumen lalu klik tombol <u class="w3-hover-text-black">"Konfirmasi"</u></b></span>

                            </th>
                        </tr>
                    </table>
                </div>
                <?php
                if (isset($_SESSION["pinjam_instrumen"])) {
                    $ubah = $_SESSION["pinjam_instrumen"];
                    if ($ubah) {
                        echo "<script>swal(\"Pinjam Instrumen Berhasil\", \"\", \"success\");</script>";
                    } else {
                        echo "<script>swal(\"Centang Checkbox Untuk Meminjam Instrumen\", \"\", \"warning\");</script>";
                    }
                }
                $this->session->unset_userdata('pinjam_instrumen');

                if (isset($ada_instrumen) || isset($cari_instrumen)) {
                    $total = 0;
                    if (isset($cari_instrumen)) {
                        $total = count($cari_instrumen);
                        if ($total == 0) {
                            echo "<div id='id02' class='modal w3-responsive'>
                                    <div class='modal-content w3-animate-opacity w3-black' style='margin-top:15%;width:100%'>
                                        <div class='container'>
                                            <h3 class='w3-center'>Instrumen <a style='color:red'>$nama_instrumen</a> Tidak Ditemukan</h3>
                                        </div>
                                        <div class='w3-center w3-margin-bottom'>
                                    <a class='w3-xxlarge' href='";
                            echo base_url('/site/tambah_peminjaman/');
                            echo "' style='vertical-align:middle;'><span><i class=\"fa fa-backward w3-margin w3-hover-text-green\"></i></span></a>
                                        </div>
                                    </div>
                                  </div>";
                        }
                    }
                }
                ?>

                <form action="<?php echo base_url('/PeminjamanControl/pinjam'); ?>" class="scroll">
                    <table class="w3-table w3-striped w3-bordered w3-animate-opacity w3-card" align="center" style="width:60%;margin-bottom:10%">
                        <tbody>
                            <?php
                            $tampil = 0;
                            if (isset($ada_instrumen)) {
                                $tampil = count($ada_instrumen);
                            } elseif (isset($cari_instrumen)) {
                                $tampil = count($cari_instrumen);
                            }

                            if ($tampil == 0) {
                                echo "<tr><td style='text-align: center;' colspan='4'>"
                                . "<h3 style='color: red' class='w3-padding-64'>TIDAK ADA INSTRUMEN</h3></td></tr>
                                  ";
                            } else {
                                echo "<tr class='w3-theme'>
                                <th style='text-align: center;'>ID INSTRUMEN</th>
                                <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                <th style='text-align: center;'>JUMLAH INSTRUMEN STERIL</th>
                                <th style='text-align: center;'>PILIH</th>
                            </tr>";
                                if (isset($cari_instrumen)) {
                                    foreach ($cari_instrumen as $r):
                                        echo "
                                    <tr>
                                    <td style='text-align: center'>$r->id_instrumen</td>
                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center'>$r->steril</td>
                                    <td style='text-align: center'>
                                    <input type='checkbox' name='id[]' value='$r->id_instrumen'>
                                    </td>
                                    </tr>";
                                    endforeach;
                                    $this->session->unset_userdata('nama_instrumen');
                                    $this->session->unset_userdata('cari_instrumen');
                                } else {
                                    if (isset($ada_instrumen)) {
                                        foreach ($ada_instrumen as $r):
                                            echo "
                                    <tr>
                                    <td style='text-align: center'>$r->id_instrumen</td>
                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center'>$r->steril</td>
                                    <td style='text-align: center'>
                                    <input type='checkbox' name='id[]' value='$r->id_instrumen'>
                                    </td>
                                    </tr>";
                                        endforeach;
                                    }
                                }
                                echo "<tr>
                                <td colspan='4' style='text-align: center'>
                                    <button class='btn btn-warning w3-xlarge w3-hover-text-black' style='width:40%'><i class='fa fa-briefcase'></i> KONFIRMASI</button>
                                    </form>";
                                if (isset($cari_instrumen)) {
                                    echo "
                            <form action='";
                                    echo base_url('site/tambah_peminjaman/');
                                    echo "'>
                                <button class='btn btn-succes w3-xlarge w3-hover-text-black' style='width:40%'><i class='fa fa-backward'></i> Kembali</button>
                                </form>";
                                }
                                echo "</td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>

        <?php
        $this->load->view("header_footer/footer");
        ?>

        <script>
            function myFunction() {
                var navbar = document.getElementById("myNavbar");
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    navbar.className = "w3-bar" + " w3-card-2" + " w3-animate-top" + " w3-white";
                } else {
                    navbar.className = navbar.className.replace(" w3-card-2 w3-animate-top w3-white", "");
                }
            }
            function toggleFunction() {
                var x = document.getElementById("navDemo");
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }

            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            var modal2 = document.getElementById('id02');

            // When the user clicks anywhere outside of the modal, not close it
            modal2.style.display = "block";
        </script>
    </body>
</html>
