<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
        <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
        <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
        <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
        <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
        <title>Tambah Instrument</title>
    </head>
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
        .buttonTambah{
            display: inline-block;
            border-radius: 4px;
            background-color: #f44336;
            border: none;
            color: #fff;
            text-align: center;
            font-size: 22px;
            padding: 5px;
            width: 140px;
            /*height: 50px;*/
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .buttonTambah span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .buttonTambah span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .buttonTambah:hover span {
            padding-right: 25px;
        }

        .buttonAtur:hover span:after {
            opacity: 1;
            right: 0;
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

        <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
        </div>

        <?php
        if (isset($_SESSION["tambah_user"])) {
            $ubah = $_SESSION["tambah_user"];
            if ($ubah) {
                echo "<script>swal(\"Tambah Peminjam Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
            } else {
                echo "<script>swal(\"Tambah Peminjam Gagal\", \"Tekan OK untuk melanjutkan\", \"error\");</script>";
            }
            $this->session->unset_userdata('tambah_user');
        }
        ?>

        <div class="w3-content w3-container w3-center" id="about">
            <img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">
        </div>

        <div class="w3-container">
            <div class="w3-responsive w3-card-4 w3-padding-16" >
                <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
                    <b style="">TAMBAH PEMINJAM EKSTERNAL</b>
                </div>
                <table align="center" class="w3-animate-opacity"><tr><th>
                    <div class="w3-container w3-white w3-padding-16 w3-card w3-margin-bottom">
                        <form action="<?php echo base_url('/UserControl/tambahUser'); ?>">
                            <div class="w3-row-padding">
                                <div class=" w3-margin-bottom">
                                    <label>Masukkan Nama Peminjam</label>
                                    <input class="w3-input w3-border" type="text" value="" name="nama_user" required="" placeholder="Nama Peminjam / Nama Instansi Peminjam">
                                </div>

                                <div class=" w3-margin-bottom">
                                    <label>Masukkan No Telephone</label>
                                    <input class="w3-input w3-border" type="text" value="" name="no_telp" required="" placeholder="No Telepon" onkeypress="return isNumber(event)">
                                    <input type="hidden" name="status_user" value="3">
                                </div>
                                <div class="w3-margin-bottom w3-center">
                                    <button class="buttonTambah" type="submit" name="tambah" value="yes"><i class="fa fa-plus"></i> TAMBAH</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </th></tr></table>
            </div>
            <div class="w3-container w3-margin-bottom">
            </div>

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