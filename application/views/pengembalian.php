
<!DOCTYPE html>
<html>
    <title>Pengembalian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/w3.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/lato.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
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
            <?php
            $this->load->view("header_footer/header_main");
            ?>
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

                <?php
                if (isset($_SESSION["status_user"])) {
                    $status = $_SESSION["status_user"];
                    if ($status == 0 || $status == 1) {
                        $pengembalian = $_SESSION['pengembalian'];
                        $total = count($pengembalian);

                        echo "<div class=\"w3-container w3-theme w3-opacity-min\">
                            <form action='";
                            echo base_url('/site/notifikasi_pengembalian/');
                            echo "'>
                                <table class=\"w3-animate-opacity\" style='text-align:center;width:100%;margin-bottom:5%;margin-top:1%;'>
                                <tr><th style='text-align:center;' class=''><img src=";
                        echo base_url('images/LogoCSSD.png');
                        echo " class='w3-center w3-opacity-min'></th></tr>
                                    <tr><th style='text-align:center;' class='w3-xxlarge w3-text-black w3-animate-fadding'>Pengembalian Amprah ";
                        if ($total > 0) {
                            echo ">> <button style='width:10%' class='btn btn-default w3-xlarge w3-hover-text-black w3-opacity-off' type=\"submit\" name=\"ubah\" value=\"yes\">$total</button>";
                        }
                        echo "</th></tr></form>
                                    <tr><th style='text-align:center;' class='w3-animate-zoom'>Halaman ini digunakan untuk melakukan <br>pengecekan terhadap instrumen yang dikembalikan oleh peminjam.<br>Silakan masukkan ID Transaksi pada field dibawah ini</th></tr>
                                </table>
                            </div>
                            <form action='";
                        echo base_url('/PengembalianControl/pengembalian');
                        echo "'>
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
                                    </form>
                                    </div>
                                    </div>";
                        $this->session->unset_userdata('konfirmasi');
                    } else {
                        redirect(base_url('/site/halamanUtama/'));
                    }
                }
                ?>

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
