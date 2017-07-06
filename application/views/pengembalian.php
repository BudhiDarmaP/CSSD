
<!DOCTYPE html>
<html>
    <title>Pencarian ID Transaksi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
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
            min-height: 100%;
        }

        /* Second image (Portfolio) */
        .bgimg-2 {
            min-height: 1000%;
        }

        /* Third image (Contact) */
        .bgimg-3 {
            min-height: 400px;
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
        <div class="w3-top">
            <div class="w3-bar w3-card w3-white" id="myNavbar">
                <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i>
                </a>

                <a href="<?php echo base_url('/site/halamanUtama/'); ?>" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
                <?php
                if (isset($_SESSION["status_user"])) {
                    $status_user = $_SESSION["status_user"];
                    if ($status_user == 0) {
                        echo "
                            <a href=\"";
                        echo base_url('/site/tambah_user/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-users\"></i> USER</a>
                        ";
                    } elseif ($status_user == 1) {
                        echo "
                            <a href=\"";
                        echo base_url('/site/halamanInstrumen/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-scissors\"></i> INSTRUMEN</a>
                            <a href=\"";
                        echo base_url('/site/peminjaman/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-pencil\"></i> PEMINJAMAN</a>
                            <a href=\"";
                        echo base_url('/site/pengembalian/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-recycle\"></i> PENGEMBALIAN</a>
                            <a href=\"";
                        echo base_url('/site/laporan/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-paperclip\"></i> LAPORAN</a>
                        ";
                    } elseif ($status_user == 2) {
                        echo "
                            <a href=\"";
                        echo base_url('/site/tambah_peminjaman/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-pencil\"></i> PEMINJAMAN</a>
                        ";
                    } else {
                        redirect(base_url('/LoginControl/destroy_session/'));
                    }
                }
                ?>
                <a href="<?php echo base_url('/site/ubah_password_konfirmasi/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> UBAH PASSWORD</a>
                <a href="<?php echo base_url('/LoginControl/destroy_session'); ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"><i class="fa fa-sign-out"></i> KELUAR</a>
            </div>
        </div>
        <?php
        if (isset($_SESSION["konfirmasi"])) {
            $ubah = $_SESSION["konfirmasi"];
            if ($ubah) {
                echo "<script>swal(\"Konfirmasi Pengembalian Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
            } else {
                echo "<script>swal(\"Tak Ada Pengembalian\", \"Tekan OK untuk melanjutkan\", \"error\");</script>";
            }
        }
        ?>
        <div class="bgimg-2 w3-display-container w3-animate-top">
            <div  class="w3-display-topmiddle w3-col l6 m8">
                <form action="<?php echo base_url('/PengembalianControl/pengembalian') ?>">
                    <?php
                    if (isset($_SESSION["status_user"])) {
                        $status = $_SESSION["status_user"];
                        if ($status == 0 || $status == 1) {
                            echo "<div class=\"w3-container w3-theme w3-opacity-min\">
                                
                                <table class=\"w3-animate-opacity\" style='text-align:center;width:100%;margin-bottom:5%;margin-top:1%;'>
                                <tr><th style='text-align:center;'><img src=";
                            echo base_url('images/LogoCSSD.png');
                            echo " class='w3-center w3-opacity-min'></th></tr>
                                    <tr><th style='text-align:center;' class='w3-xxlarge w3-text-black w3-animate-fading'>Pengembalian Amprah</th></tr>
                                    <tr><th style='text-align:center;' class='w3-animate-zoom'>Halaman ini digunakan untuk melakukan <br>pengecekan terhadap instrumen yang dikembalikan oleh peminjam.<br>Silakan masukkan ID Transaksi pada field dibawah ini</th></tr>
                                </table>
                            </div>
                            <div class=\"w3-container w3-white w3-padding-16 w3-card\">
                                    <div class=\"w3-row-padding w3-padding\" style=\"margin:0 -16px;\">
                                    <div>
                                        <label><i class=\"fa fa-paperclip\"></i> ID Transaksi</label>
                                        <input class=\"w3-input w3-border\" type='text' name='id_transaksi' placeholder='Masukkan ID Transaksi' required='Silakan Masukkan ID Transaksi'>
                                    </div>
                                    </div>
                                    <div class=\"w3-row-padding w3-padding\" style=\"margin:0 -16px;\">
                                    <div>
                                    <table align='center' style='width:20%'><tr><th>
                                    <button class='btn btn-success w3-xlarge w3-hover-text-black' type=\"submit\" name=\"ubah\" value=\"yes\"><i class=\"fa fa-search w3-margin-right\"></i> Cari</button>
                                    </th></tr>
                                    </table>
                                    </div>
                                    </div>";
                            $this->session->unset_userdata('konfirmasi');
                        } else {
                            redirect(base_url('/site/halamanUtama/'));
                        }
                    }
                    ?>
                </form>
            </div>
        </div>

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
//            window.onclick = function(event) {
//                if (event.target == modal2) {
//                    modal2.style.display = "none";
//                }
//            }
        </script>
    </body>
</html>
