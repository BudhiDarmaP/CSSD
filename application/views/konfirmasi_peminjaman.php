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
    <link href="<?php echo base_url('images/Logo.png');?>" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker({dateformat: 'dd-MM-yy HH:mi'});
        });
        $(function () {
            $("#datepicker2").datepicker({dateformat: 'dd-MM-yy HH:mi'});
        });
    </script>
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
            padding: 3px;
            width: 140px;
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
                            echo base_url('/site/ubah_password/');
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
            <div class="w3-content w3-container w3-center" id="about">
                <img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">
            </div>

            <div class="w3-responsive w3-card-4 w3-padding-16 w3-animate-bottom" >
                <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left">
                    <b style="color: green">Konfirmasi Peminjaman</b>
                </div>

                <form action='<?php echo base_url('/PeminjamanControl/konfirmasi'); ?>'>
                    <table><tr style='text-align: center'>
                            <?php
                            if ($status_user == 1) {
                            echo "<th>ID PEMINJAM</th>
                            <td><select name='peminjam'>";
                            foreach ($id_peminjam as $r):
                                echo "
                                    <option value='$r->id_user'>$r->nama_user</option>
                                    ";
                            endforeach;
                            echo "</select></td>
                            <th>TANGGAL PINJAM</th>
                            <td class='inputTanggal'><input type='text' id='datepicker' name='tgl_pinjam' placeholder='Klik untuk isi'></td>
                            </tr>
                            <tr style='text-align: center'>
                            <th></th>
                            <td></td>
                            <th>TANGGAL KEMBALI</th>
                            <td class='inputTanggal'><input type='text' id='datepicker2' name='tgl_kembali' placeholder='Klik untuk isi'></td>";
                            }else {
                                echo "<input type='hidden' name='peminjam' value=''>
                                    <th>TANGGAL PINJAM</th>
                            <td class='inputTanggal'><input type='text' id='datepicker' name='tgl_pinjam' placeholder='Klik untuk isi'></td>
                            </tr>";
                            }
                            ?>
                        </tr></table>
                    <table class="w3-table w3-striped w3-bordered" align="center">
                        <thead>
                            <tr class="w3-theme">
                                <th style="text-align: center;">ID INSTRUMEN</th>
                                <th style="text-align: left;">NAMA INSTRUMEN</th>
                                <th style="text-align: center;">JUMLAH INSTRUMEN STERIL</th>
                                <th style="text-align: center;">JUMLAH PINJAM</th>
                            </tr>
                        <tbody>
                            <?php
                            foreach ($cari_instrumen as $r):
                                echo "
                                    <tr>
                                    <td style='text-align: center'>$r->id_instrumen</td>
                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center'>$r->steril</td>
                                    <td style='text-align: center'>
                                    <input type='number' name='jumlah[]' value='' max='$r->steril' min='0' placeholder='0'>
                                    <input type='hidden' value='$r->id_instrumen' name='id_instrumen[]'>    
                                    <input type='hidden' value='$r->steril' name='steril[]'>    
                                    </td>
                                    </tr>";
                            endforeach;
                            $this->session->unset_userdata('nama_instrumen');
                            $this->session->unset_userdata('cari_instrumen');
                            ?>
                        </tbody>
                    </table>
                    <button class="buttonPinjam w3-goldyellow"><i class="fa fa-briefcase"></i>PINJAM</button>
                </form>
            </div>
        </div>

        <footer class="w3-center w3-green w3-margin-bottom">
            <div class="w3-section w3-padding-small"></div>
            <div class="w3-xlarge w3-section">
                <i class="fa fa-facebook-official w3-hover-opacity"></i>

            </div>
            <p>Powered by <a title="" target="_blank" class="w3-hover-text-black">CSSD RSUD Karangasem</a></p>
            <div class="w3-section w3-padding-small"></div>
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
            </script>
            <script>
                // Get the modal
                var modal = document.getElementById('id01');
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
                var modal2 = document.getElementById('id02');
                // When the user clicks anywhere outside of the modal, close it
                modal2.style.display = "block";
                window.onclick = function (event) {
                    if (event.target == modal2) {
                        modal2.style.display = "none";
                    }
                }
            </script>
        </footer>
    </body>
</html>