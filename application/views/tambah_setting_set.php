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
        <link href="<?php echo base_url('bootstrap-3.3.6/css/scroll.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
        <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
        <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
        <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
        <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
        <title>Tambah Setting Set</title>
    </head>
    <script>
        function validate()
        {
            var chks = document.getElementsByName('id[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++)
            {
                if (chks[i].checked)
                {
                    hasChecked = true;
                    break;
                }
            }

            if (hasChecked == false)
            {
                swal("Pilih instrumen!", "", "warning");
                return false;
            }

            return true;
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
        .buttonTambah{
            display: inline-block;
            border-radius: 4px;
            background-color: green;
            border: none;
            color: #fff;
            text-align: center;
            font-size: 22px;
            padding: 5px;
            width: 140px;
            /*height: 50px;*/
            /*transition: all 0.5s;*/
            cursor: pointer;
            margin: 5px;
        }

        .buttonTambah span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            /*transition: 0.5s;*/
        }

        .buttonTambah span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            /*transition: 0.5s;*/
        }

        .buttonTambah:hover span {
            padding-right: 25px;
        }

        .buttonAtur:hover span:after {
            opacity: 1;
            right: 0;
        }

        .scroll {
            height: 450px;
        }
    </style>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <?php
            $this->load->view("header_footer/header_instrumen");
            ?>
        </div>

        <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
        </div>

        <?php
        if (isset($setting_set)) {

            if ($setting_set) {
                echo "<script>swal(\"Tambah Setting Set Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
            } else if ($setting_set==false) {
                echo "<script>swal(\"Tambah Setting Set Gagal\", \"Tekan OK untuk melanjutkan\", \"error\");</script>";
            }
        }
        ?>

        <div class="w3-content w3-container w3-center" id="about">
        </div>

        <div class="w3-container w3-margin-top">
            <form method="post" action='<?php echo base_url('/InstrumenControl/tambah_setting_set'); ?>' onSubmit="return validate()">
                <div class="w3-responsive w3-card-4 w3-padding-16" >
                    <div class="w3-container w3-responsive w3-margin-bottom w3-left w3-animate-left w3-xxlarge w3-center" style="width:100%">
                        <b style="color: green;">PENAMBAHAN SETTING SET BARU</b>
                    </div>
                    <div class="w3-container w3-white w3-padding-16" style="width:100%">

                        <div class="w3-row-padding w3-card w3-padding-16" style="margin:0 -16px;margin-bottom:5%">
                            <table align="center" style="width:80%;"><tr><td>
                                        <div class="w3-half w3-margin-bottom" style="width:40%">
                                            <label>Nama Setting Set :</label>
                                            <input class="w3-input w3-border" type="text" placeholder="Masukkan nama setting set baru" name="setting_set" required>
                                            <label>Jenis Setting Set : </label>
                                            <input class="w3-input w3-border" type="text" placeholder="Masukkan jenis setting set baru" name="untuk" value="">
                                            <div class="w3-margin-bottom w3-margin-top">
                                                <button class="buttonTambah w3-hover-text-black w3-green" type="submit" name="ubah" value="yes"><i class="fa fa-plus"></i> TAMBAH</button>
                                            </div>

                                        </div>
                                        <div class="w3-half w3-margin-bottom w3-margin-left w3-left">
                                            <label>Pilih Daftar Instrumen : </label>
                                            <div class="scroll w3-card">
                                                <table class="w3-table w3-striped w3-bordered w3-animate-opacity w3-card" align="center" style="">
                                                    <tbody>
                                                        <?php
                                                        $tampil = count($ada_instrumen);
                                                        if ($tampil == 0) {
                                                            echo "<tr><td style='text-align: center;' colspan='4'>
                                                    <h3 style='color: red' class='w3-padding-64'>TIDAK ADA INSTRUMEN</h3></td></tr>";
                                                        } else {
                                                            echo "<tr class='w3-theme'>
                                                    <th style='width:5%'></th>
                                                    <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                                    <th style='text-align: center;'>JUMLAH</th>
                                                    <th style='text-align: center;'>INPUT</th>
                                                    <th style='text-align: center;'>PILIH</th>
                                                    </tr>";

                                                            if (isset($ada_instrumen)) {
                                                                $nomor = 1;
                                                                foreach ($ada_instrumen as $r):
                                                                    echo "
                                                    <tr>
                                                    <td>$nomor.</td>
                                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                                    <td style='text-align: center'>$r->jumlah</td>
                                                    <td style='text-align: center'>
                                                    <input type='number' name='input[]' min='0' max='$r->jumlah' placeholder='0'></td>
                                                    <td style='text-align: center'>
                                                    <input type='checkbox' name='id[]' value='$r->id_instrumen'>
                                                    </td></tr>";
                                                                    $nomor++;
                                                                endforeach;
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="w3-half w3-margin-bottom">
                                            </div>
                                        </div>
                                    </td></tr></table>

                        </div>
                    </div>
                </div>
            </form>
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