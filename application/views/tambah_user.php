
<!DOCTYPE html>
<html>
    <title>Tambah User</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
    <script>
        function validasi_input(form) {
            if (form.status_user.value == "") {
                swal("Anda belum memilih Status User!", "", "warning");
                return (false);
            }
            return (true);
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

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <?php
            $this->load->view("header_footer/header_main");
            ?>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <?php
        if (isset($_SESSION["tambah_user"])) {
            $ubah = $_SESSION["tambah_user"];
            if ($ubah) {
                echo "<script>swal(\"Tambah User Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
            } else {
                echo "<script>swal(\"Tambah User Gagal\", \"Nama User Tidak Boleh Sama\", \"error\");</script>";
            }
            $this->session->unset_userdata('tambah_user');
        }

        if (isset($_SESSION["edit_user"])) {
            $nama = $_SESSION["nama_user_edit"];
            $id = $_SESSION["id_user_edit"];
            $ubah = $_SESSION["edit_user"];
            if ($ubah) {
                echo "<script>swal(\"Data Berhasil Diubah\", \"Ubah Data : $nama ($id)\", \"success\");</script>";
            } else {
                echo "<script>swal(\"Data Gagal Diubah\", \"Ubah Data : $nama ($id)\", \"error\");</script>";
            }
            $this->session->unset_userdata('edit_user');
            $this->session->unset_userdata('nama_user_edit');
            $this->session->unset_userdata('id_user_edit');
        }
        ?>

        <div class="bgimg-2 w3-display-container">
            <div  class="w3-display-topmiddle w3-padding" style="width: 100%">
                <table style="width: 100%;vertical-align:text-top;margin-bottom:10%">
                    <tr>
                        <th class="w3-animate-top w3-top w3-opacity-min w3-hover-opacity-off" style="width:30%">
                    <form action="<?php echo base_url('UserControl/tambahUser') ?>" onsubmit="return validasi_input(this)">
                        <div class="w3-container w3-theme">
                            <h3><i class="fa fa-user-circle-o w3-margin-right w3-margin-top"></i>TAMBAHKAN USER INTERNAL</h3>
                            <table class="w3-xxlarge w3-text-white w3-wide w3-animate-opacity">
                                <tr><td>CSSD</td></tr>
                            </table>
                        </div>
                        <div class="w3-container w3-white w3-padding-16 w3-card">

                            <div class="w3-row-padding w3-padding" style="margin:0 -16px;">
                                <div>
                                    <label><i class="fa fa-id-card"></i> Nama User</label>
                                    <input class="w3-input w3-border" type="text" value="" name="nama_user" title="Masukkan nama pegawai (pegawai CSSD atau SIM) / nama ruangan (peminjam internal)" required="" placeholder="Masukkan nama pegawai (pegawai CSSD atau SIM) / nama ruangan (peminjam internal)">
                                </div>
                            </div>
                            <div class="w3-row-padding w3-padding" style="margin:0 -16px;">
                                <div>
                                    <label><i class="fa fa-phone-square"></i> Nomor Telepon</label>
                                    <input class="w3-input w3-border" type="text" value="" name="no_telp" required="" onkeypress="return isNumber(event)" placeholder="Masukkan kontak user yang bisa dihubungi" maxlength="13">
                                </div>
                            </div>
                            <div class="w3-row-padding w3-padding w3-margin-bottom" style="margin:0 -16px;">
                                <div>
                                    <label><i class="fa fa-check"></i> Status User</label>
                                    <select class="w3-input w3-border w3-padding-16" name="status_user" style="color:red">
                                        <option value="" disabled='disabled' selected>-- Pilih Status User --</option>
                                        <option value="0">Super Administrator</option>
                                        <option value="1">Administrator CSSD</option>
                                        <option value="2">Peminjam Internal</option>
                                    </select> 
                                </div>
                            </div>
                            <button class="w3-button w3-green" type="submit" name="ubah" value="yes"><h2><i class="fa fa-plus-square w3-margin-right"></i> TAMBAH</h2></button>
                        </div>
                    </form>
                    </th>
                    <th class="w3-top w3-opacity-min w3-hover-opacity-off">
                    <table class="w3-table w3-striped w3-bordered w3-card w3-margin-left w3-margin-top w3-margin-right" align="center" style="width:67%">
                        <thead class="w3-margin-top">
                            <tr>
                                <th colspan="6" class="w3-green">
                        <h3 class="w3-right w3-xxlarge"><i class="fa fa-users w3-margin-right"></i>DAFTAR USER</h3>
                        </th>

                        </tr>
                        <tr class="w3-theme w3-margin-top ">
                            <th style="text-align: right;">USERNAME</th>
                            <th style="text-align: left;">NAMA</th>
                            <th style="text-align: left;">NOMOR TELEPON</th>
                            <th style="text-align: center;">STATUS</th>
                            <th style="text-align: center;color:" colspan="2">AKSI</th>
                        </tr>
                        </thead>
                        <tbody class="w3-animate-opacity">
                            <?php

                            function cekStatus($stat) {
                                if ($stat == 0) {
                                    return 'Super Administrator';
                                } elseif ($stat == 1) {
                                    return 'Administrator CSSD';
                                } elseif ($stat == 2) {
                                    return 'Peminjam Internal';
                                } else {
                                    return 'Peminjam Eksternal';
                                }
                            }

                            function cekWarna($stat) {
                                if ($stat == 3) {
                                    return '#006699';
                                } else {
                                    return 'green';
                                }
                            }

                            if (isset($data_user)) {
                                $data_status_user;
                                $warna;
                                foreach ($data_user as $r):
                                    $data_status_user = cekStatus($r->status_user);
                                    $warna = cekWarna($r->status_user);
                                    echo "
                                    <tr>
                                    <td style='text-align: right'>$r->id_user</td>
                                    <td style='text-align: left'><b>$r->nama_user</b></td>
                                    <td style='text-align: left'>$r->no_telepon</td>
                                    <td style='text-align: center;color:$warna'>$data_status_user</td>
                                        <form method='post' action=";
                                    echo base_url('/site/edit_user');
                                    echo ">
                                        <td style='text-align: center;'><button title='Ubah Data' class=\"btn btn-success\" name=\"id\" value=\"$r->id_user\" style='width:60%'><i class=\"fa fa-edit w3-text-black w3-large\"></i></button></td>
                                        </form>";
//                                    echo "<form action=";
//                                    echo base_url('/site/hapus_user');
//                                    echo ">
//                                        <td style='text-align: left;'><button title='Hapus Data' class=\"btn btn-warning\" name=\"id\" value=\"$r->id_user\" style='width:60%'><i class=\"fa fa-trash w3-text-black w3-large\"></i></button></td>
//                                            <input type='hidden' name='namauser' value='$r->nama_user'>
//                                        </form>";
                                    echo "</tr>";
                                endforeach;
                            }
                            ?>

                        </tbody>
                    </table>

                    </th>
                    </tr>
                </table>
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
        </script>
    </body>
</html>
