
<!DOCTYPE html>
<html>
    <title>Lihat Peminjaman</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png'); ?>" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/jquery-ui.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('/resources/demos/style.css')?>">
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-1.12.4.js')?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-ui.js')?>"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({dateFormat: 'dd/mm/yy'});
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
                <?php
                $this->load->view("header_footer/header_peminjaman");
                $status_user = $_SESSION["status_user"];
                ?>
            </div>

            <!-- First Parallax Image with Logo Text -->
            <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
            </div>

            <!-- Container (About Section) -->

            <table style="width:70%;margin-bottom:10%" align='center'>
                <tr><th>
                <div class="w3-content w3-container w3-center w3-margin-top" id="about">
                    <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left">
                        <?php
                        if ($pinjam_instrumen == NULL) {
                            echo "<h4 style='text-align: center;margin-bottom:10%' class='w3-theme w3-padding w3-large'><b class='w3-padding-16 w3-xxlarge'>Halaman Untuk Melihat Peminjaman</b><br>Pilih Tanggal Untuk Melihat Daftar Peminjaman"
                            . "<br><img src='";
                            echo base_url('images/note.png');
                            echo "' class='w3-center w3-margin-top w3-margin-bottom w3-animate-top'></h4></div>";
                            echo "<script>swal(\"Peminjaman Kosong\", \"\", \"error\");</script>";
                        } else {
                            echo "<b style='color: green' class='w3-xxlarge w3-text-green w3-animate-opacity w3-left'>Daftar Peminjaman <u>$peminjam->nama_user</u></b>
                                    <br> 
                                    <table style='text-align:left;width:50%'>
                                    <tr><td>ID Transaksi</td> 
                                    <td>: </td>
                                    <td>$id_transaksi</td>
                                    <tr><td>No. Telepon </td>
                                    <td>: </td>
                                    <td>$peminjam->no_telepon</td></tr></table>
                                    </div>
                <table class = 'w3-table w3-striped w3-bordered w3-card' align = 'center' style='margin-bottom:10%'>
                <thead><tr class = 'w3-theme'>
                <th style = 'text-align: left;'></th>
                <th style = 'text-align: left;'>NAMA INSTRUMEN</th>
                <th style = 'text-align: center;'>TANGGAL PINJAM</th>
                <th style = 'text-align: center;'>TANGGAL KEMBALI</th>
                <th style = 'text-align: center;'>JUMLAH</th>
                <th style = 'text-align: center;'>STATUS</th>
                </tr>
                <tbody>";
                            $tanggal;
                            $nomor = 1;
                            foreach ($pinjam_instrumen as $r):
                                echo "
                <tr>
                <td style='text-align: left'><b>$nomor</b></td>
                <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                <td style='text-align: center'>$r->tanggal_pinjam</td>
                <td style='text-align: center'>$r->tanggal_kembali</td>
                <td style='text-align: center'>$r->jumlah_pinjam</td>";
                                if ($r->status_peminjaman == 0) {
                                    echo "
                <td style='text-align: center'><span style='color:orange'>Menunggu Approve</span></td>
                </tr>";
                                } else if ($r->status_peminjaman == 1) {
                                    echo "
                <td style='text-align: center'><span style='color:red'><b>Belum Dikembalikan</b></span></td>
                </tr>";
                                } else if ($r->status_peminjaman == 2) {
                                    echo "
                <td style='text-align: center'><span style='color:green'>Sudah Dikembalikan</span></td>
                </tr>";
                                } else if ($r->status_peminjaman == 3) {
                                    echo "
                <td style='text-align: center'><span style='color:blue'><b>Tidak Approve<b></span></td>
                </tr>";
                                }
                                $tanggal = $r->tanggal_pinjam;
                                $nomor++;
                            endforeach;
                            echo "
                            <form action='";
                            if ($_SESSION['status_user'] == 1 || $_SESSION['status_user'] == 0) {
                                echo base_url('site/lihat_peminjaman');
                            } else if ($_SESSION['status_user'] == 2) {
                                echo base_url('site/riwayat_pinjam');
                            }
                            echo "' method='POST'>
                            <tr>
                            <td colspan='6' style='text-align: center'>
                                <button class='btn btn-success w3-xlarge w3-hover-text-black' style='width:15%'><i class='fa fa-backward'></i> Kembali</button>
                                <input type='hidden' name='kembali' value='yes'>
                                <input type='hidden' name='tgl_pinjam' value='$tanggal'>
                            </td>
                        </tr>";
                            $this->session->unset_userdata('pinjam_instrumen');
                        }
                        ?>
                        </tbody>
                        </table>
                    </div>
                </th></tr></table>

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
