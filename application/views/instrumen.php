
<!DOCTYPE html>
<html>
    <title>Halaman Instrumen</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/w3.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/lato.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png'); ?>" rel="icon" type="image/png"/>
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
            background-image: url('images/Rute TransJogja.png');
            min-height: 100%;
        }

        /* Second image (Portfolio) */
        .bgimg-2 {
            min-height: 1000%;
        }

        /* Third image (Contact) */
        .bgimg-3 {
            background-image: url("");
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
    </style>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <div class="w3-bar w3-card w3-white" id="myNavbar">
                <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="<?php echo base_url('/site/halamanUtama/'); ?>" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
                <a href="<?php echo base_url('/site/tambah_instrument/'); ?>" class="w3-bar-item w3-button w3-hide-small w3-animate-opacity"><i class="fa fa-plus"></i> TAMBAH</a>
                <a href="<?php echo base_url('/site/instrumen/'); ?>" class="w3-bar-item w3-button w3-hide-small w3-animate-opacity"><i class="fa fa-search"></i> CARI</a>
                <a href="<?php echo base_url('/site/perbarui_instrument/'); ?>" class="w3-bar-item w3-button w3-hide-small w3-animate-opacity"><i class="fa fa-edit"></i> PERBARUI</a>
                <a href="<?php echo base_url('/site/hapus_instrument/'); ?>" class="w3-bar-item w3-button w3-hide-small w3-animate-opacity"><i class="fa fa-eraser"></i> HAPUS</a>
                <a href="<?php echo base_url('/site/setting_set/'); ?>" class="w3-bar-item w3-button w3-hide-small w3-animate-opacity"><i class="fa fa-list-ol"></i> SETTING SET</a>
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



        <!-- Second Parallax Image with Portfolio Text -->
        <div class="bgimg-2 w3-display-container w3-opacity-min">
            <div class="w3-display-topmiddle w3-center w3-black w3-opacity w3-animate-fading w3-padding-small">
                <span class="w3-xxlarge w3-text-white w3-wide w3-animate-opacity w3-margin-left"> Halaman Instrumen</span>
            </div>

        </div>
        <div class="bgimg-3 w3-display-container w3-opacity-min">
            <div class="w3-container w3-display-bottommiddle w3-margin-bottom">
                <p class="w3-center">     
                    <br>Halaman ini berisikan informasi tentang semua daftar instrumen yang terdapat di CSSD RSUD Karangasem.<br>
                    Data yang terdapat pada halaman ini adalah data yang valid.<br>
                    <br>Halaman ini bertujuan untuk memudahkan pengguna dalam melakukan pencarian ataupun melihat daftar instrumen yang tersedia.
                    <br>Fitur yang terdapat dihalaman ini juga berguna untuk menambahkan data instrumen yang ada di CSSD kedalam sistem, melakukan penghapusan, pembaruan data instrumen serta penambahan setting set baru.
                    <br>
                </p>
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
