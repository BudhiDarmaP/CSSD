
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({ dateFormat: 'dd/mm/yy' });
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

            <table style="width:70%" align='center'>
                <tr>
                    <th>
                <div class="w3-container w3-responsive w3-padding-24">
                    <form action="<?php echo base_url('/PeminjamanControl/lihat_pinjaman'); ?>">
                        <div class="col-xs-12">
                            <table style="width:30%">
                                <tr>
                                    <th style="width: 90%">
                                        <input class='inputTanggal' style="height: 40px;width:95%;margin-top:15px" type="text" id='datepicker' class="form-control" name="tgl" placeholder="Pilih Tanggal Pinjam" required="">
                                    </th>
                                    <th style="width: 10%;margin-left:1px">
                                        <button class="btn btn-success" name="cari" value="CARI"><i class="fa fa-search"></i>&nbsp;</button>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </th>
        </tr>
        <tr><th>
        <div class="w3-responsive w3-card-4 w3-padding-16 w3-center">
            <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left">
                <?php
                if ($pinjam_instrumen == NULL) {
                    echo "<h4 style='text-align: center;margin-bottom:10%' class='w3-theme w3-padding w3-large'><b class='w3-padding-16 w3-xxlarge'>Halaman Untuk Melihat Peminjaman</b><br>Pilih Tanggal Untuk Melihat Daftar Peminjaman"
                    . "<br><img src='";
                    echo base_url('images/note.png');
                    echo "' class='w3-center w3-margin-top w3-margin-bottom w3-animate-top'></h4></div>";
                    echo "<script>swal(\"Peminjaman Kosong\", \"\", \"error\");</script>";
                } else {
                    echo "<b style='color: green' class='w3-xxlarge w3-text-green w3-animate-opacity'>Daftar Amprah Tanggal $tanggal</b></div>
                <table class = 'w3-table w3-striped w3-bordered w3-animate-opacity w3-card' align = 'center' style='margin-bottom:10%'>
                <thead><tr class = 'w3-theme'>
                <th style = 'text-align: center;'>ID PEMINJAM</th>
                <th style = 'text-align: center;'>NAMA INSTRUMEN</th>
                <th style = 'text-align: center;'>TANGGAL PINJAM</th>
                <th style = 'text-align: center;'>TANGGAL KEMBALI</th>
                <th style = 'text-align: center;'>JUMLAH</th>
                <th style = 'text-align: center;'>STATUS</th>
                </tr>
                <tbody>";
                    foreach ($pinjam_instrumen as $r):
                        echo "
                <tr>
                <td style='text-align: center'>$r->id_peminjam</td>
                <td style='text-align: center'><b>$r->nama_instrumen</b></td>
                <td style='text-align: center'>$r->tanggal_pinjam</td>
                <td style='text-align: center'>$r->tanggal_kembali</td>
                <td style='text-align: center'>$r->jumlah_pinjam</td>";
                        if ($r->status_peminjaman == 0) {
                            echo "
                <td style='text-align: center'><h5 style='color:orange'>Menunggu Approve</h5></td>
                </tr>";
                        } else if ($r->status_peminjaman == 1) {
                            echo "
                <td style='text-align: center'><h5 style='color:red'><b>Belum Dikembalikan</b></h5></td>
                </tr>";
                        } else if ($r->status_peminjaman == 2) {
                            echo "
                <td style='text-align: center'><h5 style='color:green'>Sudah Dikembalikan</h5></td>
                </tr>";
                        }
                    endforeach;
                    $this->session->unset_userdata('pinjam_instrumen');
                }
                ?>
                </tbody>
                </table>
            </div>
        </th></tr></table>

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
    </footer>
</body>
</html>
