
<!DOCTYPE html>
<html>
    <title>Edit User</title>
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
                        echo base_url('/site/instrumen/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-scissors\"></i> INSTRUMEN</a>
                            <a href=\"";
                        echo base_url('/site/peminjaman/');
                        echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-pencil\"></i> PEMINJAMAN</a>
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

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <div class="bgimg-2 w3-display-container w3-opacity-min w3-animate-top">
            <div  class="w3-display-topmiddle w3-padding" style="width:40%">
                <form action="<?php echo base_url('UserControl/editUser') ?>">
                    <div class="w3-container w3-theme">
                        <h3><i class="fa fa-user-circle-o w3-margin-right w3-margin-top"></i>UBAH DATA USER INTERNAL</h3>
                        <table class="w3-xxlarge w3-text-white w3-wide w3-animate-opacity">
                            <tr><td>CSSD</td></tr>
                        </table>
                    </div>
                    <?php
                    $id_user_edit;
                    $nama_user_edit;
                    $no_telp_user_edit;
                    $status_user_edit;
                    if (isset($edit_user)) {
                        foreach ($edit_user as $r):
                            $id_user_edit = $r->id_user;
                            $nama_user_edit = $r->nama_user;
                            $no_telp_user_edit = $r->no_telepon;
                            $status_user_edit = $r->status_user;
                        endforeach;
                    }

//                    $nama_user_edit = 'Imam';

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
                    ?>
                    <div class="w3-container w3-white w3-padding-16 w3-card">
                        <div class="w3-row-padding w3-padding" style="margin:0 -16px;">
                            <div>
                                <label><i class="fa fa-id-card"></i> Nama User</label>
                                <input class="w3-input w3-border" type="text" value="<?php echo $nama_user_edit ?>" name="nama_user" required="" placeholder="Masukkan nama pegawai (pegawai CSSD atau SIM) / nama ruangan (peminjam internal)">
                            </div>
                        </div>
                        <div class="w3-row-padding w3-padding" style="margin:0 -16px;">
                            <div>
                                <label><i class="fa fa-phone-square"></i> Nomor Telepon</label>
                                <input class="w3-input w3-border" type="text" value="<?php echo $no_telp_user_edit ?>" name="no_telp" required="" onkeypress="return isNumber(event)" placeholder="Masukkan kontak user yang bisa dihubungi" maxlength="13">
                            </div>
                        </div>
                        <div class="w3-row-padding w3-padding w3-margin-bottom" style="margin:0 -16px;">
                            <div>
                                <label><i class="fa fa-check"></i> Status User</label>
                                <input class="w3-input w3-border" style="color:green" type="text" name="status_user" value="<?php echo cekStatus($status_user_edit) ?>" disabled="disable">
                                <input type="hidden" value="<?php echo $id_user_edit ?>" name="id_user">
                            </div>
                        </div>
                        <button class="w3-button w3-green" type="submit" name="ubah" value="yes"><h2><i class="fa fa-check-circle-o w3-margin-right"></i> UBAH</h2></button>

                    </div>
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

            // When the user clicks anywhere outside of the modal, close it      modal2.style.display = "block";
        </script>
    </body>
</html>