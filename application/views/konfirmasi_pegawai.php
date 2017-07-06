<!DOCTYPE html>
<html>
    <title>Peminjaman</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png'); ?>" rel="icon" type="image/png"/>
    <script>
        function validasi_input(form) {
            if (form.peminjam.value == "") {
                alert("Anda belum memilih peminjam!");
                form.peminjam.focus();
                return (false);
            }

            return (true);
        }

        function validasi_input2(form) {
            if (form.id_transaksi.value == "") {
                swal("Anda belum memasukkan ID Transaksi!", "", "error");
                form.id_transaksi.focus();
                return (false);
            }
        }
    </script>
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
        .buttonKonfirmasi{
            display: inlin-block;
            border-radius: 4px;
            background-color: #f44336;
            border: none;
            color: #fff;
            text-align: center;
            font-size: 18px;
            padding: 4px;
            width: 170px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }
        .buttonKonfirmasi span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }
        .buttonKonfirmasi span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: 25px;
            transition: 0.5s;
        }
        .buttonKonfirmasi:hover span {
            padding-right: 25px;
        }
        .inputTanggal input{
            width:200px; border:1px dotted #CI_Unit_test; 
            border-radius:4px; -moz-border-radius:4px; 
            height:38px; margin-left:3px;'
            }
        </style>
        <body>

            <!-- Navbar (sit on top) -->
            <div class="w3-top">
                <div class="w3-bar w3-card w3-white" id="myNavbar">
                    <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
                        <i class="fa fa-bars"></i>
                    </a>

                    <a href="<?php echo base_url('/site/halamanUtama/'); ?>" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
                    <?php
                    if (isset($_SESSION["status_user"])) {
                        $status_user = $_SESSION["status_user"];
                        if ($status_user == 0 || $status_user == 1) {
                            echo "
                        <a href=\"";
                            echo base_url('/site/tambah_peminjam/');
                            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-user\"></i> TAMBAH PEMINJAM</a>
                        <a href=\"";
                            echo base_url('/site/tambah_peminjaman/');
                            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-plus\"></i> TAMBAH PEMINJAMAN</a>
                        <a href=\"";
                            echo base_url('/site/cek_peminjaman/');
                            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-check\"></i> CEK PEMINJAMAN</a>
                        ";
                        } else {
                            echo "
                        <a href=\"";
                            echo base_url('/site/tambah_peminjaman/');
                            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-pencil\"></i> PEMINJAMAN</a>
                        <a href=\"";
                            echo base_url('/site/ubah_password_konfirmasi/');
                            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-user\"></i> UBAH PASSWORD</a>
                        ";
                        }
                    }
                    ?>

                    <a href="<?php echo base_url('/LoginControl/destroy_session'); ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"><i class="fa fa-sign-out"></i> KELUAR</a>
                </div>
            </div>

            <!-- First Parallax Image with Logo Text -->
            <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
            </div>

            <!-- Container (About Section) -->
            <!--            <div class="w3-content w3-container w3-center" id="about">
                            <img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">
                        </div>-->

            <div class="w3-responsive w3-card-4 w3-padding-16" >
                <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
                    <b class='w3-padding '>Konfirmasi Peminjaman </b>
                </div>


                <table align="center" style="width:70%;margin-bottom:3%">
                    <tr>
                        <th colspan="4" class="w3-small">
                            Pilih Peminjam Untuk Melihat Daftar Peminjaman Berdasarkan Peminjam
                        </th>
                        <th colspan="2" class="w3-small" style="text-align:right">
                            Peminjaman Berdasarkan ID Transaksi
                        </th>
                    </tr>
                    <tr style='text-align:'>
                        <?php
                        if ($status_user == 0 || $status_user == 1) {
                            echo "
                                    <form action='";
                            echo base_url('PeminjamanControl/peminjam_belum_konfirmasi');
                            echo "' onsubmit='return validasi_input(this)'>
                                    <th></th>
                                    <td style='text-align:center;color:red;width:30%'>
                                    <select class='w3-input w3-border w3-padding' name='peminjam' style='width:95%;text-align:center;margin-top:2%' placeholder='Masukkan'>";
                            echo "
                                    <option value='' required='' disabled='disabled' selected>-- Pilih Peminjam --</option>
                                    ";
//                                <td><select name='peminjam'>";
                            foreach ($id_peminjam as $r):
                                echo "
                                    <option value='$r->id_user' style='color:black'>$r->nama_user</option>
                                    ";
                            endforeach;
                            echo "</select></td>
                            <th><button class='btn btn-success w3-hover-text-black' name='cari' value='CARI' style=''>
                            <i class='fa fa-search'></i>&nbsp;</button></th>
                            </form>
                            <td style='width:40%'></td>
                            <form action='";
                            echo base_url('PeminjamanControl/peminjam_belum_konfirmasi');
                            echo "' onsubmit='return validasi_input2(this)'>
                            <td style='width:30%'>
                                <input class='inputTanggal form-control' style='height: 40px;width:95%;margin-top:15px' type='text' name='id_transaksi' placeholder='Masukkan ID Transaksi'>
                            </td>
                            <td>
                                <button class='btn btn-success w3-hover-text-black' name='cari' value='CARI'><i class='fa fa-search'></i>&nbsp;</button>
                            </td>
                            </form>";
                        }else {
                            redirect(base_url('/site/home/'));
                        }
                        ?>
                    </tr>></table>

                <table class="w3-table w3-striped w3-bordered w3-animate-opacity w3-card" align="center" style="width:70%;<?php if ($peminjam == NULL or count($peminjam) == 1) {
                            echo "margin-bottom:20%";
                        } else {
                            echo "margin-bottom:10%";
                        } ?>">
                    <?php
                    if ($peminjam == NULL) {
                        echo "<td style='text-align: center'>"
                        . "<h3 style='color: red'>TIDAK ADA DATA YANG BELUM DIKONFIRMASI</h3></td>";
                    } else {
                        echo "<thead>
                                    <tr class='w3-theme'>
                                    <th style='text-align: left;'>ID TRANSAKSI</th>
                                    <th style='text-align: left;'>PEMINJAM</th>
                                    <th style='text-align: center;'></th>
                                    </tr>";
                        foreach ($peminjam as $r):
                            echo "<form action='";
                            echo base_url('PeminjamanControl/konfirmasi_peminjaman');
                            echo "' method='POST'><tbody><tr>
                                    <td style='text-align: left;width:30%;'>$r->id_transaksi</td>
                                    <input type='hidden' name='id' value='$r->id_peminjam'>
                                    <input type='hidden' name='transaksi' value='$r->id_transaksi'>
                                    <td style='text-align: left;width:60%;'><b>$r->nama_user</b></td>
                                    <td style='text-align: center;width:10%;'>
                                    <button class='btn btn-warning w3-large w3-hover-text-black'>
                                    <i class='fa fa-check-circle'></i> KONFIRMASI</button>
                                    </td>
                                    </tr></tbody></form>";
                        endforeach;
                    }
                    $this->session->unset_userdata('konfirmasi_pegawai');

                    if (isset($cari)) {
                        echo "
                            <form action='";
                        echo base_url('site/konfirmasi_pegawai');
                        echo "'>
                            <tr>
                            <td colspan='3' style='text-align: center'>
                                <button class='btn btn-success w3-xlarge w3-hover-text-black' style='width:15%'><i class='fa fa-backward'></i> Kembali</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <footer class="w3-padding-16 w3-green w3-center w3-margin-top w3-margin-bottom">
            <a href="https://www.usd.ac.id/" target="_blank" class="w3-opacity-min w3-hover-opacity-off"><img src="<?php echo base_url('images/USD.png') ?>"></a>
            <br><b class="w3-text-black">Universitas Sanata Dharma, DI Yogyakarta</b>
            <br>Powered by : <a title="" target="_blank" class="w3-hover-text-black">Imam Dwicahya & I Putu Budi Dharma P.</a>
            <br class="w3-large"><b>© 2017</b>
        </footer>
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
            // When the user clicks anywhere outside of the modal, close it
            modal2.style.display = "block";
            window.onclick = function(event) {
                if (event.target == modal2) {
                    modal2.style.display = "none";
                }
            }
        </script>
    </body>
</html>